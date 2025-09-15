<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiController extends Controller
{
    public function respond(Request $request)
    {
        $data = $request->validate(['q' => 'required|string|min:1|max:2000']);
        $q = trim($data['q']);

        $fullPath = storage_path('app/ai/dossier.txt');
        if (!is_file($fullPath)) {
            \Log::warning('Dossier not found', ['path' => $fullPath]);
            return response()->json(['ok' => false, 'error' => "Dossier file missing at $fullPath"], 400);
        }
        $dossier = @file_get_contents($fullPath) ?: '';
        if ($dossier === '') {
            return response()->json(['ok' => false, 'error' => 'Empty or unreadable dossier'], 400);
        }

        // Same language as the user's message (any language), plain text only
        $system = <<<SYS
You are a personal assistant that MUST answer ONLY using the DOSSIER information.

Language rule:
- IMPORTANT: Always respond in exactly the same language as the user's question. Match their language perfectly.

Format:
- Plain text only. No Markdown or code fences. Do not use these characters: ` # * _ [ ] | ~ < > { }.
- Use short sections with uppercase labels when useful (CONTACT, EXPERIENCE, EDUCATION, SKILLS).
- Use dash lists "- " for enumerations.

Content policy:
- Be clear and detailed. Include key facts, dates, tools, and technologies from the DOSSIER.
- If asked about CONTACT, EDUCATION, EXPERIENCE, or SKILLS, extract the relevant items.
- Only say "I don't have that information" (in the user's language) if the DOSSIER truly lacks any relevant detail.
- Never invent data beyond the DOSSIER.

DOSSIER:
{$dossier}
SYS;

        try {
            $resp = \Http::withHeaders([
                'Authorization' => 'Bearer '.env('OPENROUTER_API_KEY'),
                'HTTP-Referer'  => config('app.url', $request->getSchemeAndHttpHost()),
                'X-Title'       => 'Personal QA',
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
            ])->post(env('OPENROUTER_API_URL', 'https://openrouter.ai/api/v1/chat/completions'), [
                'model'       => env('OPENROUTER_MODEL', 'google/gemini-2.0-flash-001'),
                'temperature' => 0.1,
                'messages'    => [
                    ['role' => 'system', 'content' => $system],
                    ['role' => 'user',   'content' => $q],
                ],
            ])->throw();

            $content = trim((string) data_get($resp->json(), 'choices.0.message.content', ''));
            if (str_starts_with($content, '```')) {
                $content = preg_replace('/^```[a-zA-Z0-9_-]*\s*/', '', $content);
                $content = preg_replace('/\s*```$/', '', $content);
                $content = trim($content);
            }
            // Force plain text
            $content = $this->toPlainText($content);

            return response()->json(['ok' => true, 'answer' => $content]);
        } catch (\Throwable $e) {
            \Log::error('AI respond failed', ['err' => $e->getMessage()]);
            return response()->json(['ok' => false, 'error' => 'AI service error'], 500);
        }
    }


    private function toPlainText(string $t): string
    {
        // Remove fenced code blocks but keep inner text
        $t = preg_replace('/```(?:\w+)?\s*([\s\S]*?)```/m', '$1', $t) ?? $t;
        // Remove inline backticks
        $t = str_replace('`', '', $t);
        // Strip bold/italic markers
        $t = preg_replace('/(\*\*|__)(.*?)\1/s', '$2', $t) ?? $t;
        $t = preg_replace('/(\*|_)(.*?)\1/s', '$2', $t) ?? $t;
        // Remove markdown headings
        $t = preg_replace('/^\s{0,3}#{1,6}\s*/m', '', $t) ?? $t;
        // Normalize list markers (*, +, •) -> "- "
        $t = preg_replace('/^\s*[\*\+\•]\s+/m', '- ', $t) ?? $t;
        // Links/images: keep text
        $t = preg_replace('/!\[.*?\]\(.*?\)/', '', $t) ?? $t;
        $t = preg_replace('/\[(.*?)\]\((?:[^)]+)\)/', '$1', $t) ?? $t;
        // Tables/pipes and odd symbols
        $t = preg_replace('/^\s*\|.*\|\s*$/m', '', $t) ?? $t;
        $t = str_replace(['|','~','<','>','{','}'], ' ', $t);
        // Strip HTML just in case
        $t = strip_tags($t);
        // Whitespace cleanup
        $t = preg_replace("/[ \t]+\n/", "\n", $t) ?? $t;
        $t = preg_replace("/\n{3,}/", "\n\n", $t) ?? $t;

        return trim($t);
    }

}
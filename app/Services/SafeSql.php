<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use InvalidArgumentException;

class SafeSql
{
    private const ALLOWED_TABLES = [
        'Profiles','Education','Experience','Certifications',
        'Skills','Education_Skills','Experience_Skills','Certification_Skills',
    ];

    public static function run(string $sql, array $params = [], int $maxLimit = 100)
    {
        $original = $sql;
        $sql = trim($sql);

        // 1) Solo SELECT, una sola sentencia
        if (!preg_match('/^\s*select\b/i', $sql)) {
            throw new InvalidArgumentException('Solo se permiten sentencias SELECT.');
        }
        if (str_contains($sql, ';')) {
            throw new InvalidArgumentException('No se permiten múltiples sentencias.');
        }

        // 2) Bloquear palabras peligrosas
        if (preg_match('/\b(drop|delete|update|insert|alter|truncate|grant|revoke|create|replace|call|lock|unlock|handler|load|outfile|infile|into\s+outfile|dumpfile|sleep\s*\(|benchmark\s*\(|information_schema|performance_schema|sys\.)\b/i', $sql)) {
            throw new InvalidArgumentException('SQL contiene operaciones no permitidas.');
        }

        // 3) Tablas permitidas (FROM/JOIN)
        $tables = [];
        if (preg_match_all('/\bfrom\s+`?([A-Za-z_]+)`?/i', $sql, $m)) $tables = array_merge($tables, array_filter($m[1]));
        if (preg_match_all('/\b(join|left\s+join|right\s+join|inner\s+join)\s+`?([A-Za-z_]+)`?/i', $sql, $j)) $tables = array_merge($tables, array_filter($j[2]));
        foreach (array_unique($tables) as $t) {
            if (!in_array($t, self::ALLOWED_TABLES, true)) {
                throw new InvalidArgumentException("Tabla no permitida: {$t}");
            }
        }

        // 4) Forzar LIMIT <= maxLimit
        if (preg_match('/\blimit\s+(\d+)/i', $sql, $lm)) {
            $n = (int) $lm[1];
            if ($n <= 0 || $n > $maxLimit) {
                $sql = preg_replace('/\blimit\s+\d+/i', 'LIMIT '.$maxLimit, $sql);
            }
        } else {
            $sql .= ' LIMIT '.$maxLimit;
        }

        // 5) Ejecutar en modo lectura (mejor con usuario MySQL read-only)
        return collect(DB::select($sql, $params));
    }
}
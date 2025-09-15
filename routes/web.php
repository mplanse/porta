<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AiController;

Route::view('/', 'index')->name('home');
Route::post('/ai-search', [AiController::class, 'respond'])->name('ai.search');

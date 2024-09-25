<?php

use App\Http\Controllers\ShortenUrlController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShortenUrlController::class, 'index'])->name('url.index');
Route::post('/', [ShortenUrlController::class, 'store'])->name('url.store');
Route::get('{url:short_url}', [ShortenUrlController::class, 'show'])->name('url.show');

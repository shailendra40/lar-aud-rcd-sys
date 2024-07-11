<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AudioController;

Route::get('/', function () {
    return view('welcome');
});

//Upload Aud/Files
Route::get('/', [AudioController::class, 'index']);
Route::get('/audio', [AudioController::class, 'index']);
// Route::post('/audio/upload', [AudioController::class, 'upload'])->name('audio.upload');

//Upload Aud-Recd.
Route::get('/audio/create', [AudioController::class, 'create'])->name('audio.create');
Route::post('/audio/upload', [AudioController::class, 'upload'])->name('audio.upload');

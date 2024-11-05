<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmissionController;

Route::get('/', function () {
    return view('welcome');
});




Route::middleware('auth')->group(function () {
    Route::get('/home', [SubmissionController::class, 'create'])->name('home');
    Route::post('/submit', [SubmissionController::class, 'store'])->name('submit');
    Route::get('/submission/{id}', [SubmissionController::class, 'show'])->name('submission.show');
    Route::get('/submission/{id}/edit', [SubmissionController::class, 'edit'])->name('submission.edit');
    Route::put('/submission/{id}', [SubmissionController::class, 'update'])->name('submission.update');
    Route::delete('/submission/{id}', [SubmissionController::class, 'destroy'])->name('submission.destroy');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

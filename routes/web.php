<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\QuestionController;

Route::get('/', function () {
    return view('Home');
});
Route::get('/', [QuestionController::class, 'index']);
// Guest routes (login/register)
Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store'])->name('login.store');

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
});

// Authenticated routes (logout/profile)
Route::middleware('auth')->group(function () {
    Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');

    Route::get('/profile', [RegisteredUserController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [RegisteredUserController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [RegisteredUserController::class, 'destroy'])->name('profile.destroy');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CommentController;

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

// Authenticated routes (questions, answers, comments)
Route::middleware('auth')->group(function () {
    // Questions
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::get('/questions/{question}', [QuestionController::class, 'show'])->name('questions.show');
    Route::patch('/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');
    Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
    Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');

    // Answers
    Route::post('/questions/{question}/answers', [AnswerController::class, 'store'])->name('answers.store');
    Route::post('/questions/{question}/answers/{answer}/best', [AnswerController::class, 'markBest'])->name('answers.best');

    // Comments (replies)
    Route::post('/answers/{answer}/comments', [CommentController::class, 'store'])->name('comments.store');
});

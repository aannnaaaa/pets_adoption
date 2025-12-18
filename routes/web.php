<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create')->middleware('auth');
Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store')->middleware('auth');
Route::get('/announcements/{id}', [AnnouncementController::class, 'show'])->name('announcements.show');
Route::get('/announcements/{id}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit')->middleware('auth');
Route::put('/announcements/{id}', [AnnouncementController::class, 'update'])->name('announcements.update')->middleware('auth');
Route::delete('/announcements/{id}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy')->middleware('auth');

Route::get('/error', function () {
    return view('error');
})->name('error');

Route::get('/messages', [MessageController::class, 'index'])->name('messages.index')->middleware('auth');
Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show')->middleware('auth');

Route::post('/users/{user}/reviews', [ReviewController::class, 'store']) ->name('reviews.store') ->middleware('auth');

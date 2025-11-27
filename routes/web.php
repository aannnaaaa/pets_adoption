<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello', ['title' => 'Hello World!']);
});

Route::get('/announcements', [AnnouncementController::class, 'index']);
Route::post('/announcement', [AnnouncementController::class, 'store']);
Route::get('/announcements/{id}', [AnnouncementController::class, 'show']);
Route::get( '/announcement/create', [AnnouncementController::class, 'create'])->middleware( 'auth');
Route::get( '/announcement/destroy/{id}', [AnnouncementController::class, 'destroy'])->middleware( 'auth');
Route::post( '/announcement/update/{id}', [AnnouncementController::class, 'update'])->middleware('auth');
Route::get( '/announcement/edit/{id}', [AnnouncementController::class, 'edit'])->middleware( 'auth');

Route::get('/messages', [MessageController::class, 'index']);
Route::get('/messages/{id}', [MessageController::class, 'show']);

Route::get('/users/{id}/reviews/received', [ReviewController::class, 'showReceived']);
Route::get('/users/{id}/reviews/given', [ReviewController::class, 'showGiven']);



Route::get( '/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/auth', [LoginController::class, 'authenticate']);

Route::get( '/error', function () {
    return view( 'error', ['message' => session( 'message')]);
});


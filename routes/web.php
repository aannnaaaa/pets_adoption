<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello', ['title' => 'Hello World!']);
});

Route::get('/announcements', [AnnouncementController::class, 'index']);
Route::get('/announcement/create', [AnnouncementController::class, 'create']);
Route::post('/announcement', [AnnouncementController::class, 'store']);
Route::get('/announcements/{id}', [AnnouncementController::class, 'show']);
Route::get('/announcement/edit/{id}', [AnnouncementController::class, 'edit']);
Route::post('/announcement/update/{id}', [AnnouncementController::class, 'update']);
Route::get('/announcement/destroy/{id}', [AnnouncementController::class, 'destroy']);

Route::get('/messages', [MessageController::class, 'index']);
Route::get('/messages/{id}', [MessageController::class, 'show']);

Route::get('/users/{id}/reviews/received', [ReviewController::class, 'showReceived']);
Route::get('/users/{id}/reviews/given', [ReviewController::class, 'showGiven']);

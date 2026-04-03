<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

Route::post('/profile/upload-photo', [ProfileController::class, 'uploadPhoto'])->name('profile.upload-photo');
Route::post('/profile/delete-photo', [ProfileController::class, 'deletePhoto'])->name('profile.delete-photo');

Route::post('/projects/store', [ProjectController::class, 'store'])->name('projects.store');
Route::put('/projects/update/{id}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/delete/{id}', [ProjectController::class, 'destroy'])->name('projects.delete');

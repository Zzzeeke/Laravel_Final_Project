<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Create_ToDoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// CRUD routes

Route::get('/todos/create', [Create_ToDoController::class, 'create'])->name('create_todo');
Route::post('/todos', [Create_ToDoController::class, 'store'])->name('todos.store');
Route::get('/dashboard', [Create_ToDoController::class, 'dashboard'])->name('dashboard');
Route::post('/todos/{id}/complete', [Create_ToDoController::class, 'markCompleted'])->name('todos.complete');

require __DIR__.'/auth.php';

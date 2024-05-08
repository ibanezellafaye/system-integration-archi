<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index'])->name('task.index');
Route::POST('/', [TaskController::class, 'store']);
Route::GET('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('task.edit');
Route::PUT('/{task}', [TaskController::class, 'update'])->name('task.update');
Route::DELETE('/{task}', [TaskController::class, 'destroy']);
Route::POST('/update{id}', [TaskController::class, 'updates'])->name('task.updates');



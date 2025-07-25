<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware(['role:superadmin,admin'])->prefix('users')->group(function () {

    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::post('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    
});


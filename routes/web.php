<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::put('/users/{user}',[UserController::class,'update'])->name('users.update');
Route::get('/users/{user}/edit',[UserController::class,'edit'])->name('users.edit');
Route::post('/users/store',[UserController::class,'store'])->name('users.store');
Route::get('/users/create',[UserController::class,'create'])->name('users.create');
Route::get('/users4',[UserController::class,'index4'])->name('users.index4');
Route::get('/users3',[UserController::class,'index3'])->name('users.index3');
Route::get('/users2',[UserController::class,'index2'])->name('users.index2');
Route::get('/users',[UserController::class,'index'])->name('users.index');
/*
Route::get('/users', function () {
    return 'QualquerCoisa';
});
*/

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

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TodoItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TodoCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', fn () => redirect()->route('login.index'));

Route::get('login', [LoginController::class, 'index'])->name('login.index');
Route::post('login', [LoginController::class, 'store'])->name('login.store');

Route::get('register', [RegisterController::class, 'index'])->name('register.index');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');

Route::middleware('auth')->group(function() {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    // Todo items
    Route::resource('todo-items', TodoItemController::class);
    Route::post('todo-item/restore', [TodoItemController::class, 'restore'])->name('todo-item.restore');
    Route::post('todo-item/share', [TodoItemController::class, 'share'])->name('todo-item.share');

    // Todo item categories
    Route::resource('todo-categories', TodoCategoryController::class);


    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});



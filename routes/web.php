<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('/', '/blog');


Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/blog/create', [BlogController::class, 'post_create'])->name('blog.create');
    Route::post('/blog/create_store', [BlogController::class, 'post_store'])->name('blog.store');

    Route::get('/blog/{post}/edit', [BlogController::class, 'post_edit'])->name('blog.edit');
    Route::put('/blog/{post}', [BlogController::class, 'post_update'])->name('blog.update');

    Route::delete('/blog/delete/{post}', [BlogController::class, 'post_destroy'])->name('blog.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/{id}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/{id}', [DashboardController::class, 'update'])->name('dashboard.update');

    Route::delete('/dashboard/delete/{id}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login_store'])->name('login.store');
    
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'register_store'])->name('register.store');
});

Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/order/{post}', [BlogController::class, 'order'])->name('blog.order');
Route::post('/blog', [BlogController::class, 'order_store'])->name('blog.order.store');








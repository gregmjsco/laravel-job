<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs/{id}/save', [JobController::class, 'save'])->name(
    'jobs.save'
);
Route::resource('jobs', JobController::class);
Route::get('/register', [RegisterController::class, 'register'])->name(
    'register'
);
Route::post('/register', [RegisterController::class, 'store'])->name(
    'register.store'
);
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name(
    'login.authenticate'
);

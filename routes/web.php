<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth','isUser'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/message', [HomeController::class, 'message'])->name('message');
    Route::post('/send-message', [HomeController::class, 'sendMessage'])->name('send-message');
});


Route::get('/admin', [AuthController::class, 'index'])->name('admin');
Route::post('/admin-login', [AuthController::class, 'login'])->name('admin-login');
Route::post('/admin-register', [AuthController::class, 'register'])->name('admin-register');

Route::middleware(['isAdmin'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/history', [PageController::class, 'getHistory'])->name('history');
    Route::resource('chats', ChatController::class);
    Route::resource('users', UserController::class);

});

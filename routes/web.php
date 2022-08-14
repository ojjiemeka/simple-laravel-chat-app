<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\ChatController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/message', [MessageController::class, 'index'])->name('message');
Route::get('/admin', [AuthController::class, 'index'])->name('admin-login');
Route::post('/admin-login', [AuthController::class, 'login'])->name('admin');
// Route::get('/message', [MessageController::class, 'index'])->name('me');
// Route::resource('admins', App\Http\Controllers\Admin\adminLoginController::class);

Route::middleware(['isAdmin'])->group(function () {
    // Route::get('/chat', [ChatController::class, 'chat'])->name('chat');
    // Route::get('/users', [ChatController::class, 'getUser'])->name('user');
Route::resource('chats', ChatController::class);

});

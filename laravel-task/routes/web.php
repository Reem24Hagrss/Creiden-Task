<?php

use App\Http\Controllers\AdminContoller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});

Auth::routes();


Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [AdminContoller::class, 'index']);
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/post/add', [App\Http\Controllers\PostController::class, 'add']);
Route::get('/post/edit/{id}', [App\Http\Controllers\PostController::class, 'edit']);
Route::post('/post/edit/{id}', [App\Http\Controllers\PostController::class, 'update']);
Route::get('/post/delete/{id}', [App\Http\Controllers\PostController::class, 'delete']);

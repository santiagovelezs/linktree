<?php

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
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/links', App\Http\Controllers\LinkController::class);
    Route::resource('/user', App\Http\Controllers\UserController::class);
    Route::resource('/social-networks', App\Http\Controllers\SocialNetworkController::class);
});

//Route::get('/{user}', [App\Http\Controllers\UserController::class, 'mylinktree'])->name('mylinktree');

Route::resource('/{username}', App\Http\Controllers\MyLinktreeController::class);
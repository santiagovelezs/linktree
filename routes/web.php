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
    Route::resource('/social-networks', App\Http\Controllers\SocialNetworkController::class);
    Route::put('mylinktree/{myLinktree}', [App\Http\Controllers\MyLinktreeController::class, 'update'])->name('mylinktree.update');
});
Route::get('/user/{user}/edit/', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::put('/user/profile/', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::post('/user/profile/photo', [App\Http\Controllers\UserController::class, 'upProfilePhoto'])->name('user.upProfilePhoto');
Route::get('/{username}', [App\Http\Controllers\MyLinktreeController::class, 'index'])->name('mylinktree');
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){
    Route::apiResource('links', App\Http\Controllers\api\v1\LinkController::class);
    Route::apiResource('social-networks', App\Http\Controllers\api\v1\SocialNetworkController::class);
    Route::apiResource('users', App\Http\Controllers\api\v1\UserController::class);
    Route::get('users/{id}/links', [App\Http\Controllers\api\v1\UserController::class, 'links'])->name('linksUser');
    Route::get('users/{id}/social-networks', [App\Http\Controllers\api\v1\UserController::class, 'socialNetworks'])->name('socialNetworksUser');    
});



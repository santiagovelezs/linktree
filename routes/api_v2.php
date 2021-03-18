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



Route::apiResource('links', App\Http\Controllers\api\v2\LinkController::class, [
    'as' => 'apiv2'
]);
Route::apiResource('social-networks', App\Http\Controllers\api\v2\SocialNetworkController::class, [
    'as' => 'apiv2'
]);
Route::apiResource('users', App\Http\Controllers\api\v2\UserController::class, [
    'as' => 'apiv2'
]);
Route::get('users/{id}/links', [App\Http\Controllers\api\v2\UserController::class, 'links'])->name('apiv2.linksUser');
Route::get('users/{id}/social-networks', [App\Http\Controllers\api\v2\UserController::class, 'apiv2.socialNetworks'])->name('socialNetworksUser');    

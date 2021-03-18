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


Route::apiResource('links', App\Http\Controllers\api\v1\LinkController::class, [
    'as' => 'apiv1'
]);
Route::apiResource('social-networks', App\Http\Controllers\api\v1\SocialNetworkController::class, [
    'as' => 'apiv1'
]);
Route::apiResource('users', App\Http\Controllers\api\v1\UserController::class, [
    'as' => 'apiv1'
]);
Route::get('users/{id}/links', [App\Http\Controllers\api\v1\UserController::class, 'links'])->name('apiv1.linksUser');
Route::get('users/{id}/social-networks', [App\Http\Controllers\api\v1\UserController::class, 'apiv1.socialNetworks'])->name('socialNetworksUser');    



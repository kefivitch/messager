<?php

use Illuminate\Http\Request;

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

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('details', 'API\UserController@details');
});

Route::post('/users', 'API\msgController@allUsers');
Route::post('/conversations/{user_id}', 'API\msgController@getConversations');
Route::post('/messages/{user_id}/{conversation_id}', 'API\msgController@getMessages');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

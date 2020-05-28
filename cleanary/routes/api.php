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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::post('login', function (Request $request) {return $request;});
Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');



Route::middleware('auth:api')->group(function() {
     Route::post('/auth', 'Api\UserController@auth');
    Route::post('/updateuser', 'Api\UserController@accountupdate');
    Route::post('/updatefav', 'Api\UserController@addfavorite');
     Route::post('/requestlaundry', 'Api\LaundryController@makerequest');
    Route::get('user/{userId}/detail', 'Api\UserController@show');
    Route::post('/logout', 'Api\UserController@logout');
    Route::get('/payment/callback', [
    'uses' => 'PaymentController@handleGatewayCallback'
]);

    Route::get('/requestpl', 'Api\LaundryController@RequestPLaundry');
    Route::get('/requestdl', 'Api\LaundryController@RequestDLaundry');
    Route::post('/laundrydetail', 'Api\LaundryController@viewlaundry');
    
});
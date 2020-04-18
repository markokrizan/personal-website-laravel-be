<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group whichh
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([ 'namespace' => 'Api' ], function () {
    Route::group([ 'prefix' => 'auth' ], function ($router) {
        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('me', 'AuthController@me');
    });

    Route::group([
        'prefix' => 'accounts'
    ], function () {
        Route::post('/forgot-password', 'ForgotPasswordController@forgotPassword');
        Route::post('/reset-password', 'ForgotPasswordController@resetPassword');
        Route::get('/forgot-password-token/{forgotPasswordToken}', [
            'as' => 'userForgotPasswordEmail',
            'uses' => 'ForgotPasswordController@resetPasswordLink'
        ]);
        Route::post('/verify/resend', 'UserController@sendVerifyEmail');

        Route::group(['middleware' => [ 'auth:api' ]], function () {
            Route::post('/change-password', 'UserController@changePassword');
            Route::delete('/deactivate-account', 'UserController@deactivate');
        });
    });

    Route::group([
        'prefix' => 'users',
        'middleware' => ['auth:api']
    ], function () {
        Route::get('/', 'UserController@index');
        Route::get('/{user}', 'UserController@show');
        Route::post('/{user}', 'UserController@update');
        Route::delete('/{user}', 'UserController@destroy');
    });

    Route::group([
        'prefix' => 'posts',
        'middleware' => ['auth:api']
    ], function () {
        Route::get('/', 'PostController@index');
        Route::get('/{post}', 'PostController@show');
        Route::post('/{post}', 'PostController@update');
        Route::delete('/{post}', 'PostController@destroy');
    });
});

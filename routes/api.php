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
Route::post('/register', 'AuthController@register')->name('Register');
Route::post('/login', 'AuthController@login')->name('Login');

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/groups', 'GroupController@index');

    Route::get('/certifications', 'CertificationController@index');

    Route::post('/certifications', 'CertificationController@create');

    Route::post('/logout', 'AuthController@logout');
});
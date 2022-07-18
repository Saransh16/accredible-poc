<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', 'AuthController@register')->name('Register');
Route::post('/login', 'AuthController@login')->name('Login');

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/groups', 'GroupController@index');

    Route::get('/groups/{group_id}', 'GroupController@getGroup');

    Route::get('/designs/{design_id}', 'GroupController@getDesign');

    Route::get('/certifications', 'CertificationController@index');

    Route::post('/certifications', 'CertificationController@create');

    Route::post('/certifications/expire', 'CertificationController@expireCredential');

    Route::post('/logout', 'AuthController@logout');
});
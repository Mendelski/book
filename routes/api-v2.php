<?php

use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;

Route::get('health', function () {
    return response()->json(['status' => 'ok']);
});

Route::group(['middleware' => CheckClientCredentials::class], static function () {
    Route::get('auth/health', function () {
        return response()->json(['status' => 'Api version 2 securely ok']);
    });
});

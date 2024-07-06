<?php

use Illuminate\Support\Facades\Route;

Route::get('health', function () {
    return response()->json(['status' => 'ok v2']);
});

//Route::group(['middleware' => 'client'], static function () {
//    Route::get('auth/health', function () {
//        return response()->json(['status' => 'securely ok v2']);
//    });
//});

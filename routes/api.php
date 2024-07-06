<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;

Route::get('health', function () {
    return response()->json(['status' => 'ok']);
});

Route::group(['middleware' => CheckClientCredentials::class], static function () {
    Route::get('auth/health', function () {
        return response()->json(['status' => 'Api version 1 securely ok']);
    });

    Route::group(['prefix' => 'livros'], function () {
        Route::get('/', [BookController::class, 'index'])->name('book.index');
        Route::post('/', [BookController::class, 'store'])->name('book.store');
        Route::get('{book}', [BookController::class, 'show'])->name('book.show');
        Route::put('{book}', [BookController::class, 'update'])->name('book.update');
        Route::delete('{book}', [BookController::class, 'destroy'])->name('book.destroy');

        Route::post('{book}/importar-indices-xml', [BookController::class, 'xmlImport'])->name('book.import.xml');
    });
});



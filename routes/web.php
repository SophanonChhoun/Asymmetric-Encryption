<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'middleware' => ['cors'],
], function () {
    Route::get('/encrypt', [EncryptionController::class, 'encrypt']);
    Route::post('/decrypt', [EncryptionController::class, 'decrypt']);
    Route::get('/encrypt-file', [EncryptionController::class, 'encryptFile']);
    Route::post('/decrypt-file', [EncryptionController::class, 'decryptFile']);
});


Route::get('/', function () {
    return view('welcome');
});

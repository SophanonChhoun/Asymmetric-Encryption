<?php

use App\Http\Controllers\EncryptionController;
use App\Http\Controllers\EndToEndController;
use App\Http\Controllers\RSAController;
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

Route::group([
    'middleware' => ['cors'],
], function () {
    Route::get('/encrypt', [EncryptionController::class, 'encrypt']);
    Route::post('/decrypt', [EncryptionController::class, 'decrypt']);
    Route::get('/encrypt-file', [EncryptionController::class, 'encryptFile']);
    Route::post('/decrypt-file', [EncryptionController::class, 'decryptFile']);
    Route::group(['prefix' => 'rsa'], function () {
        Route::get('/generate-keys-pairs', [RSAController::class, 'generateKeysPairs']);
        Route::get('/encrypt', [RSAController::class, 'encrypt']);
        Route::get('/encrypt-public', [RSAController::class, 'encryptPublic']);
        Route::post('/decrypt', [RSAController::class, 'decrypt']);
        Route::post('/decrypt-public', [RSAController::class, 'decryptPublic']);
    });
    Route::group(['prefix' => 'end-to-end'], function () {
        Route::get('/encrypt', [EndToEndController::class, 'encrypt']);
        Route::post('/decrypt', [EndToEndController::class, 'decrypt']);
    });
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

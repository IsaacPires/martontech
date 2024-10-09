<?php

use App\Http\Controllers\Api\PendingController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('via-cep/{cep}', [\App\Http\Controllers\Api\ViaCepController::class, 'retornaEndereco']);

Route::get('/pending/{id}/accept', [PendingController::class, 'accept'])->name('pending.accept');

Route::get('/pending/{id}/deny', [PendingController::class, 'deny'])->name('pending.deny');


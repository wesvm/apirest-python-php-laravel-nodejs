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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('estudiante', 'App\Http\Controllers\estudiantecontroller@getStudent');
Route::get('estudiante/{id}', 'App\Http\Controllers\estudiantecontroller@getStudentbyId');
Route::post('setestudiante', 'App\Http\Controllers\estudiantecontroller@setStudent');
Route::put('updestudiante/{id}', 'App\Http\Controllers\estudiantecontroller@updStudent');
Route::delete('delestudiante/{id}', 'App\Http\Controllers\estudiantecontroller@delStudent');
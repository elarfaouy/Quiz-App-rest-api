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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResource("question", \App\Http\Controllers\QuestionController::class);
Route::get('question/{question}/answers', [\App\Http\Controllers\QuestionController::class, 'show_answers']);
Route::apiResource("option", \App\Http\Controllers\OptionController::class)->only(['store', 'update', 'destroy']);
Route::apiResource("answer", \App\Http\Controllers\AnswerController::class)->only(['store', 'update', 'destroy']);

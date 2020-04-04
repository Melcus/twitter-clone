<?php

use App\Http\Controllers\Api\Timeline\TimelineController;
use App\Http\Controllers\Api\Tweets\TweetController;
use App\Http\Controllers\Api\Tweets\TweetLikeController;

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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/timeline', [TimelineController::class, 'index']);
    Route::post('/tweets', [TweetController::class, 'store']);
    Route::post('/tweets/{tweet}/likes', [TweetLikeController::class, 'store']);
    Route::delete('/tweets/{tweet}/likes', [TweetLikeController::class, 'destroy']);
});




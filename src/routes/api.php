<?php

use App\Http\Controllers\Api\Media\MediaTypesController;
use App\Http\Controllers\Api\Timeline\TimelineController;
use App\Http\Controllers\Api\Tweets\TweetController;
use App\Http\Controllers\Api\Tweets\TweetLikeController;
use App\Http\Controllers\Api\Tweets\TweetRetweetController;

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

    Route::post('/tweets/{tweet}/retweets', [TweetRetweetController::class, 'store']);
    Route::delete('/tweets/{tweet}/retweets', [TweetRetweetController::class, 'destroy']);

    Route::get('/media/types', [MediaTypesController::class, 'index']);
});




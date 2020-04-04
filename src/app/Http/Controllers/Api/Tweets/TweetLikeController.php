<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class TweetLikeController
 * @package App\Http\Controllers\Api\Tweets
 */
class TweetLikeController extends Controller
{

    /**
     * @param Request $request
     * @param Tweet $tweet
     * @return ResponseFactory|Response
     */
    public function store(Request $request, Tweet $tweet)
    {
        if ($request->user()->hasLiked($tweet)) {
            return response(null, 409);
        }

        $request->user()->likes()->create([
            'tweet_id' => $tweet->id
        ]);

        return response(null, 204);
    }

    /**
     * @param Request $request
     * @param Tweet $tweet
     * @return ResponseFactory|Response
     */
    public function destroy(Request $request, Tweet $tweet)
    {
        $request->user()->likes()->where('tweet_id', $tweet->id)->first()->delete();

        return response(null, 204);
    }
}

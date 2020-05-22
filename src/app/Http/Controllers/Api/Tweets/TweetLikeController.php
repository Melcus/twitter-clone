<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetLikesWereUpdated;
use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Notifications\Tweets\TweetLiked;
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

        broadcast(new TweetLikesWereUpdated($request->user(), $tweet));

        if ($request->user()->id !== $tweet->user_id) {
            $tweet->user->notify(new TweetLiked($request->user(), $tweet));
        }

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

        broadcast(new TweetLikesWereUpdated($request->user(), $tweet));

        return response(null, 204);
    }
}

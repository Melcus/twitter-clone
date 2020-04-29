<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetRetweetsWereUpdated;
use App\Events\Tweets\TweetWasCreated;
use App\Events\Tweets\TweetWasDeleted;
use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Prototypes\Tweets\TweetType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class TweetRetweetController
 * @package App\Http\Controllers\Api\Tweets
 */
class TweetRetweetController extends Controller
{
    /**
     * @param Request $request
     * @param Tweet $tweet
     * @return Application|ResponseFactory|Response
     */
    public function store(Request $request, Tweet $tweet)
    {
        $retweet = $request->user()->tweets()->create([
            'type'              => TweetType::RETWEET,
            'original_tweet_id' => $tweet->id
        ]);

        broadcast(new TweetWasCreated($retweet));
        broadcast(new TweetRetweetsWereUpdated($request->user(), $tweet));

        return response(null, 204);
    }

    /**
     * @param Request $request
     * @param Tweet $tweet
     * @return Application|ResponseFactory|Response
     */
    public function destroy(Request $request, Tweet $tweet)
    {
        broadcast(new TweetWasDeleted($tweet->retweetedTweet));

        $tweet->retweetedTweet()->where('user_id', $request->user()->id)->delete();

        broadcast(new TweetRetweetsWereUpdated($request->user(), $tweet));

        return response(null, 204);
    }
}

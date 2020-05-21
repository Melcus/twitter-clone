<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\{Tweets\TweetRetweetsWereUpdated, Tweets\TweetWasCreated};
use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Prototypes\Tweets\TweetType;
use Illuminate\{Contracts\Foundation\Application, Contracts\Routing\ResponseFactory, Http\Request, Http\Response};

/**
 * Class TweetQuoteController
 * @package App\Http\Controllers\Api\Tweets
 */
class TweetQuoteController extends Controller
{
    /**
     * @param Request $request
     * @param Tweet $tweet
     * @return Application|ResponseFactory|Response
     */
    public function store(Request $request, Tweet $tweet)
    {
        $retweet = $request->user()->tweets()->create([
            'type'              => TweetType::QUOTE,
            'body'              => $request->body,
            'original_tweet_id' => $tweet->id
        ]);

        broadcast(new TweetWasCreated($retweet));
        broadcast(new TweetRetweetsWereUpdated($request->user(), $tweet));

        return response(null, 204);
    }
}

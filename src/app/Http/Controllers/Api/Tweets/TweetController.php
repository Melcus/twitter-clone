<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tweets\TweetStoreRequest;
use App\Prototypes\Tweets\TweetType;

/**
 * Class TweetController
 * @package App\Http\Controllers\Api\Tweets
 */
class TweetController extends Controller
{
    /**
     * @param TweetStoreRequest $request
     */
    public function store(TweetStoreRequest $request)
    {
        $tweet = $request->user()->tweets()->create(array_merge($request->only('body'), [
            'type' => TweetType::TWEET
        ]));

        broadcast(new TweetWasCreated($tweet));
    }
}

<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tweets\TweetStoreRequest;

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
        $tweet = $request->user()->tweets()->create($request->only('body'));

        broadcast(new TweetWasCreated($tweet));
    }
}

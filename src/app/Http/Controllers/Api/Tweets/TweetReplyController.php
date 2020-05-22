<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetRepliesWereUpdated;
use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Models\TweetMedia;
use App\Notifications\Tweets\TweetRepliedTo;
use App\Prototypes\Tweets\TweetType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class TweetReplyController
 * @package App\Http\Controllers\Api\Tweets
 */
class TweetReplyController extends Controller
{
    /**
     * @param Tweet $tweet
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function store(Tweet $tweet, Request $request)
    {
        $reply = $request->user()->tweets()->create(array_merge(
            $request->only('body'), [
                'type'      => TweetType::TWEET,
                'parent_id' => $tweet->id
            ]
        ));

        foreach ($request->media as $id) {
            $reply->media()->save(TweetMedia::find($id));
        }

        if ($request->user()->id !== $tweet->user_id) {
            $tweet->user->notify(new TweetRepliedTo($request->user(), $reply));
        }

        broadcast(new TweetRepliesWereUpdated($tweet));

        return response(null, 204);
    }
}

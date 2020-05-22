<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tweets\TweetStoreRequest;
use App\Http\Resources\TweetCollection;
use App\Models\Tweet;
use App\Models\TweetMedia;
use App\Prototypes\Tweets\TweetType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


/**
 * Class TweetController
 * @package App\Http\Controllers\Api\Tweets
 */
class TweetController extends Controller
{
    public function index(Request $request)
    {
        return new TweetCollection(
            Tweet::whereIn('id', explode(',', $request->ids))
                ->with([
                    'user',
                    'media.baseMedia',
                    'originalTweet' => function ($query) {
                        $query
                            ->withCount('likes', 'retweets', 'replies')
                            ->with([
                                'user',
                                'media.baseMedia',
                                'originalTweet' => function ($query) {
                                    $query->withCount('likes', 'retweets', 'replies');
                                }
                            ]);
                    }
                ])
                ->withCount('likes', 'retweets', 'replies')->get()
        );
    }

    /**
     * @param TweetStoreRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function store(TweetStoreRequest $request)
    {
        $tweet = $request->user()->tweets()->create(array_merge($request->only('body'), [
            'type' => TweetType::TWEET
        ]));

        foreach ($request->media as $id) {
            $tweet->media()->save(TweetMedia::find($id));
        }

        broadcast(new TweetWasCreated($tweet));

        return response(null, 204);
    }
}

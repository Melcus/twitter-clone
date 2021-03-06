<?php

namespace App\Http\Controllers\Api\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Resources\TweetCollection;
use Illuminate\Http\Request;

/**
 * Class TimelineController
 * @package App\Http\Controllers\Api\Timeline
 */
class TimelineController extends Controller
{
    public function index(Request $request)
    {
        $tweets = $request->user()
            ->tweetsFromFollowing()
            ->parent()
            ->latest()
            ->with([
                'user',
                'entities',
                'media.baseMedia',
                'originalTweet' => function ($query) {
                    $query
                        ->withCount('likes', 'retweets', 'replies')
                        ->with([
                            'user',
                            'entities',
                            'media.baseMedia',
                            'originalTweet' => function ($query) {
                                $query->withCount('likes', 'retweets', 'replies');
                            }
                        ]);
                }
            ])
            ->withCount('likes', 'retweets', 'replies')
            ->paginate(12);

        return new TweetCollection($tweets);
    }
}

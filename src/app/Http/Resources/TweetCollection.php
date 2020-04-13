<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class TweetCollection
 * @package App\Http\Resources
 */
class TweetCollection extends ResourceCollection
{
    public $collects = TweetResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function with($request)
    {
        return [
            'meta' => [
                'likes'    => $this->likes($request),
                'retweets' => $this->retweets($request),
            ]
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    private function likes(Request $request)
    {
        if (!$user = $request->user()) {
            return [];
        }

        return $user->likes()
            ->whereIn(
                'tweet_id',
                $this->collection->pluck('id')->merge($this->collection->pluck('original_tweet_id'))
            )
            ->pluck('tweet_id')
            ->toArray();
    }

    public function retweets(Request $request)
    {
        if (!$user = $request->user()) {
            return [];
        }

        return $user->retweets()
            ->whereIn(
                'original_tweet_id',
                $this->collection->pluck('id')->merge($this->collection->pluck('original_tweet_id'))
            )
            ->pluck('original_tweet_id')
            ->toArray();
    }
}

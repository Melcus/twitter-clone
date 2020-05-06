<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class TweetResource
 * @package App\Http\Resources
 */
class TweetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'body'           => $this->body,
            'type'           => $this->type,
            'original_tweet' => new TweetResource($this->originalTweet),
            'likes_count'    => $this->likes_count,
            'retweets_count' => $this->retweets_count,
            'user'           => new UserResource($this->user),
            'media'          => new MediaCollection($this->media),
            'created_at'     => $this->created_at->timestamp
        ];
    }
}

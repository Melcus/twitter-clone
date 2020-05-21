<?php

namespace App\Events\Tweets;

use App\Models\Tweet;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class TweetRepliesWereUpdated
 * @package App\Events\Tweets
 */
class TweetRepliesWereUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected Tweet $tweet;

    /**
     * Create a new event instance.
     *
     * @param Tweet $tweet
     */
    public function __construct(Tweet $tweet)
    {
        $this->tweet = $tweet;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('tweets');
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'id'    => $this->tweet->id,
            'count' => $this->tweet->replies()->count()
        ];
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'TweetRepliesWereUpdated';
    }
}

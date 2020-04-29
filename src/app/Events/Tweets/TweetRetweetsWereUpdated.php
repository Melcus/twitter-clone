<?php

namespace App\Events\Tweets;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class TweetRetweetsWereUpdated
 * @package App\Events\Tweets
 */
class TweetRetweetsWereUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected User $user;

    protected Tweet $tweet;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Tweet $tweet
     */
    public function __construct(User $user, Tweet $tweet)
    {
        $this->user = $user;
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
            'id'      => $this->tweet->id,
            'user_id' => $this->user->id,
            'count'   => $this->tweet->retweets()->count()
        ];
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'TweetRetweetsWereUpdated';
    }
}

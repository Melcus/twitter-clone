<?php

namespace App\Events\Tweets;

use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class TweetWasCreated
 * @package App\Events\Tweets
 */
class TweetWasCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Tweet
     */
    protected $tweet;

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
     * @return array
     */
    public function broadcastWith()
    {
        return (new TweetResource($this->tweet))->jsonSerialize();
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'TweetWasCreated';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return $this->tweet->user->followers->map(function (User $user) {
            return new PrivateChannel("timeline.{$user->id}");
        })->toArray();
    }
}

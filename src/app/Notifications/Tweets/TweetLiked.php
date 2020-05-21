<?php

namespace App\Notifications\Tweets;

use App\Http\Resources\TweetResource;
use App\Http\Resources\UserResource;
use App\Models\Tweet;
use App\Models\User;
use App\Notifications\Channels\DatabaseNotificationChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TweetLiked extends Notification
{
    use Queueable;

    protected User $user;
    protected Tweet $tweet;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param Tweet $tweet
     */
    public function __construct(User $user, Tweet $tweet)
    {
        //
        $this->user = $user;
        $this->tweet = $tweet;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            DatabaseNotificationChannel::class
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user'  => new UserResource($this->user),
            'tweet' => new TweetResource($this->tweet)
        ];
    }
}

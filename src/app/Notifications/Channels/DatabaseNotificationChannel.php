<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use ReflectionClass;
use ReflectionException;

/**
 * Class DatabaseNotificationChannel
 * @package App\Notifications\Channels
 */
class DatabaseNotificationChannel
{
    /**
     * @param $notifiable
     * @param Notification $notification
     * @return mixed
     * @throws ReflectionException
     */
    public function send($notifiable, Notification $notification)
    {
        $data = $notification->toArray($notifiable);

        return $notifiable->routeNotificationFor('database')->create([
            'id'      => $notification->id,
            'type'    => (new ReflectionClass($notification))->getShortName(),
            'data'    => $data,
            'read_at' => null,
        ]);
    }
}

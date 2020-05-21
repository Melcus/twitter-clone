<?php

namespace App\Http\Controllers\Api\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationCollection;
use Illuminate\Http\Request;

/**
 * Class NotificationController
 * @package App\Http\Controllers\Api\Notifications
 */
class NotificationController extends Controller
{
    /**
     * @param Request $request
     * @return NotificationCollection
     */
    public function index(Request $request)
    {
        $notifications = $request
            ->user()
            ->notifications()
            ->paginate(5);

        return new NotificationCollection($notifications);
    }
}

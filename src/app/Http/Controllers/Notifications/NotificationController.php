<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class NotificationController
 * @package App\Http\Controllers\Notifications
 */
class NotificationController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        return view('notifications.index');
    }
}

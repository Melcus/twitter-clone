<?php

namespace App\Observers;

use App\Models\User;

/**
 * Class UserObserver
 * @package App\Observers
 */
class UserObserver
{
    public function created(User $user)
    {
        $user->following()->attach($user);
    }
}

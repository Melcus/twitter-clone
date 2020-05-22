<?php

namespace App\Prototypes\Entity;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class EntityDatabaseCollection
 * @package App\Prototypes\Entity
 */
class EntityDatabaseCollection extends Collection
{
    public function users()
    {
        return User::whereIn('username', $this->pluck('body_plain'))->get();
    }
}

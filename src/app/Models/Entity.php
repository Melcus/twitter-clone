<?php

namespace App\Models;

use App\Prototypes\Entity\EntityDatabaseCollection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Entity
 * @package App\Models
 */
class Entity extends Model
{
    protected $guarded = [];

    public function newCollection(array $models = [])
    {
        return new EntityDatabaseCollection($models);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * Class TweetMedia
 * @package App\Models
 */
class TweetMedia extends Model implements HasMedia
{
    use HasMediaTrait;

    public function baseMedia(): belongsTo
    {
        return $this->belongsTo(Media::class, 'media_id');
    }
}

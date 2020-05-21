<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Tweet
 * @package App\Models
 */
class Tweet extends Model
{
    protected $guarded = [];

    public function scopeParent(Builder $builder)
    {
        return $builder->whereNull('parent_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function originalTweet(): HasOne
    {
        return $this->hasOne(Tweet::class, 'id', 'original_tweet_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function retweets(): HasMany
    {
        return $this->hasMany(Tweet::class, 'original_tweet_id');
    }

    public function retweetedTweet(): hasOne
    {
        return $this->hasOne(Tweet::class, 'original_tweet_id', 'id');
    }

    public function media(): hasMany
    {
        return $this->hasMany(TweetMedia::class);
    }

    public function replies(): hasMany
    {
        return $this->hasMany(Tweet::class, 'parent_id');
    }
}

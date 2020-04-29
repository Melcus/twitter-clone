<?php

namespace App\Models;

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

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasOne
     */
    public function originalTweet(): HasOne
    {
        return $this->hasOne(Tweet::class, 'id', 'original_tweet_id');
    }

    /**
     * @return HasMany
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * @return HasMany
     */
    public function retweets(): HasMany
    {
        return $this->hasMany(Tweet::class, 'original_tweet_id');
    }

    /**
     * @return HasOne
     */
    public function retweetedTweet(): hasOne
    {
        return $this->hasOne(Tweet::class, 'original_tweet_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function media(): hasMany
    {
        return $this->hasMany(TweetMedia::class);
    }
}

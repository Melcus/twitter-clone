<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tweet;
use App\Models\User;
use App\Prototypes\Tweets\TweetType;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Tweet::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'body'    => $faker->sentence,
        'type'    => TweetType::TWEET
    ];
});

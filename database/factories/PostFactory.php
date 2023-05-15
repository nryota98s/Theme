<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $user = User::inRandomOrder()->first();
    return [
        'user_name' => $user->name,
        'contents' => $faker->realText($maxNbChars = 50),
    ];
});

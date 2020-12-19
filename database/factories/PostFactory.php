<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->text(100),
        'body' => $faker->text,
        'user_id' => App\User::inRandomOrder()->first()->id,
        'page_id' => App\Page::inRandomOrder()->first()->id
    ];
});

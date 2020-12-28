<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $body = $faker->text;


    return [
        'title' => $faker->text(100),
        'body' => $body,
        'synopsis' => substr($body, 0, 150) . '...',
        'user_id' => App\User::inRandomOrder()->first()->id,
        'page_id' => App\Page::inRandomOrder()->first()->id
    ];
});

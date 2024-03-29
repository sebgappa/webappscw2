<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'title' => $faker->text(100),
        'description' => $faker->text(200),
        'user_id' => factory(App\User::class),
    ];
});

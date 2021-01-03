<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    $taggables = [
        App\Page::class,
        App\Post::class,
    ];

    $taggableType = $faker->randomElement($taggables);
    $taggable = factory($taggableType)->create();

    return [
        'name' => $faker->text(20),
        'taggable_type' => $taggableType,
        'taggable_id' => $taggable->id
    ];
});

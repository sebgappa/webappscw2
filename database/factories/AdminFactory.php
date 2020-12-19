<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {

    $userCount = App\User::count();

    return [
        'user_id'=> $faker->unique()->numberBetween(1, $userCount)
    ];
});

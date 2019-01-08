<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(User::class, function (Faker $faker) {
    return [
        'fire_base_user_id' => $faker->md5,
        'email' => $faker->email,
    ];
});

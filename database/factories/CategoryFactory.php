<?php

use Faker\Generator as Faker;
use App\Category;
use App\User;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'name' => $faker->colorName,
        'colour' => $faker->hexColor
    ];
});

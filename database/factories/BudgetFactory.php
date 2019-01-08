<?php

use Faker\Generator as Faker;
use App\Budget;
use App\Category;

$factory->define(Budget::class, function (Faker $faker) {

    $category = factory(Category::class)->create();

    return [
        'user_id' => $category->user_id,
        'category_id' => $category->id,
        'amount' => $faker->numberBetween(1000, 100000),
        'time_frame' => array_rand(Budget::timeFrames())
    ];
});

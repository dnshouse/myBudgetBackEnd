<?php

use Faker\Generator as Faker;
use App\Account;
use App\User;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'opening_balance' => $faker->numberBetween(1000, 100000),
        'name' => $faker->colorName,
        'icon' => 'superCoolIcon.png',
        'colour' => $faker->hexColor
    ];
});

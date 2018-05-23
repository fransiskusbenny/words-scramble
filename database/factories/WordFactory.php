<?php

use Faker\Generator as Faker;
use App\Channel;

$factory->define(App\Word::class, function (Faker $faker) {
    return [
        'channel_id' => Channel::first()->id,
        'text' => $faker->unique()->country,
        'hint' => $faker->sentence
    ];
});

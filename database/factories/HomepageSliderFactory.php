<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\HomepageSlider;
use Faker\Generator as Faker;

$factory->define(HomepageSlider::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence('2', 'true'),
        'image' => 'default.jpg',
    ];
});

<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Evaluation;
use Faker\Generator as Faker;

$factory->define(Evaluation::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->sentence('3', 'true'),
        'attendance' => $faker->boolean('50'),
        'recuperation' => $faker->boolean('50'),
    ];
});

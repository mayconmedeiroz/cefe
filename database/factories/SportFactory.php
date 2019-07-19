<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use CEFE\Sport;
use Faker\Generator as Faker;

$factory->define(Sport::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'acronym' => mb_strtoupper($faker->unique()->word, 'UTF-8'),
    ];
});

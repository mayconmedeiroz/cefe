<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use CEFE\School;
use Faker\Generator as Faker;

$factory->define(School::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->company,
        'acronym' => mb_strtoupper($faker->unique()->word, 'UTF-8'),
    ];
});

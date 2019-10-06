<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\SchoolYear;
use Faker\Generator as Faker;

$factory->define(SchoolYear::class, function (Faker $faker) {
    return [
        'school_year' => $faker->unique()->year,
    ];
});

<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use CEFE\SportClass;
use CEFE\Sport;
use Faker\Generator as Faker;

$factory->define(SportClass::class, function (Faker $faker) {
    return [
        'sport_id' => function() use ($faker) {
            if (Sport::count())
                return $faker->randomElement(Sport::pluck('id')->toArray());
            else return factory(Sport::class)->create()->id;
        },
        'name' => $faker->unique()->word,
        'weekday' => $faker->numberBetween('0', '6'),
        'start_time' => $faker->time(),
        'end_time' => $faker->time(),
        'vacancies' => $faker->numberBetween('1', '100'),
    ];
});

<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\SchoolClass;
use App\School;
use Faker\Generator as Faker;

$factory->define(SchoolClass::class, function (Faker $faker) {
    return [
        'school_id' => function() use ($faker) {
            if (School::count())
                return $faker->randomElement(School::pluck('id')->toArray());
            else return factory(School::class)->create()->id;
        },
        'class' => $faker->numerify('####'),
    ];
});

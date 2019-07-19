<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use CEFE\ClassTeacher;
use CEFE\User;
use CEFE\SportClass;
use Faker\Generator as Faker;

$factory->define(ClassTeacher::class, function (Faker $faker) {
    return [
        'teacher_id' => function() use ($faker) {
            if (User::where('level', '2')->count())
                return $faker->randomElement(User::where('level', '2')->pluck('id')->toArray());
            else return factory(User::class)->states('teacher')->create()->id;
        },
        'class_id' => function() use ($faker) {
            if (SportClass::count())
                return $faker->randomElement(SportClass::pluck('id')->toArray());
            else return factory(SportClass::class)->create()->id;
        }
    ];
});

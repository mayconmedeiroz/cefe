<?php

use CEFE\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'enrollment' => $faker->unique()->numerify('######.##.####'),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('123'),
        'level' => $faker->numberBetween('1', '4'),
    ];
});

$factory->state(User::class, 'student', [
    'level' => '1'
]);

$factory->state(User::class, 'teacher', [
    'level' => '2'
]);

$factory->state(User::class, 'secretary', [
    'level' => '3'
]);

$factory->state(User::class, 'employee', [
    'level' => '4'
]);
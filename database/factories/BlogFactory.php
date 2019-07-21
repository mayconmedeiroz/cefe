<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use CEFE\BlogPost;
use CEFE\User;
use Faker\Generator as Faker;

$factory->define(BlogPost::class, function (Faker $faker) {
    return [
        'user_id' => function() use ($faker) {
            if (User::where('level', '4')->count())
                return $faker->randomElement(User::where('level', '4')->pluck('id')->toArray());
            else return factory(User::class)->states('employee')->create()->id;
        },
        'image' => 'default.jpg',
        'title' => $faker->sentence('5'),
        'body' => $faker->text(),
    ];
});

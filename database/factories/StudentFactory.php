<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'cne' =>  $faker->unique(true)->numberBetween(1, 60),
        'name' => $faker->name
    ];
});

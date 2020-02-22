<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Entity\Exercise;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Exercise::class, function (Faker $faker) {
    $active = $faker->boolean;
    $muscles = Exercise::MUSCLE;
    return [
        'name' => $faker->name,
        'text' => $faker->text,
        'image'=>null,
        //'muscle'=>$muscles[rand(0, count($muscles) - 1],
    ];  
});

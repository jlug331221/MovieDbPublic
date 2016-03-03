<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->email,
        'password'       => bcrypt('testtest'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Image::class, function (Faker\Generator $faker) {

    $extensions = App\Image::getValidExtensions();

    return [
        'extension' => $extensions[array_rand($extensions, 1)],
        'description' => $faker->sentence
    ];
});

$factory->define(App\Album::class, function (Faker\Generator $faker) {
    return [];
});
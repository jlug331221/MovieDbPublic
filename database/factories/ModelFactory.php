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
        'avatar'         => null,
    ];
});

$factory->define(App\Movie::class, function (Faker\Generator $faker) {
    return [
        'title'             => $faker->word,
        'country'           => $faker->country,
        'release_date'      => $faker->date('Y-m-d'),
        'genre'             => 'action',
        'parental_rating'   => 'PG-13',
        'runtime'           => $faker->numberBetween(40, 150),
        'synopsis'          => $faker->paragraph
    ];
});

$factory->define(App\Person::class, function (Faker\Generator $faker) {
    return [
        'first_name'        => $faker->name,
        'middle_name'       => $faker->name,
        'last_name'         => $faker->name,
        'first_alias'       => $faker->name,
        'middle_alias'      => $faker->name,
        'last_alias'        => $faker->name,
        'country_of_origin' => $faker->country,
        'date_of_birth'     => $faker->date('Y-m-d'),
        'date_of_death'     => $faker->date('Y-m-d'),
        'biography'         => $faker->paragraph
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
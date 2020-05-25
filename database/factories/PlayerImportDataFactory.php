<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PlayerImportData;
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

$factory->define(PlayerImportData::class, function (Faker $faker) {
    static $counter = 0;
    $counter++;
    return [
        'reference_id' => $counter,
        'data' => json_encode([
            'id' => $counter,
            'first_name' => $faker->firstName(),
            'second_name' => $faker->lastName(),
            'photo' => $faker->imageUrl(),
            'special' => $faker->boolean(),
            'creativity' => $faker->randomFloat(1, 0, 10),
        ])
    ];
});

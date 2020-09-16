<?php

/** @var Factory $factory */

use App\Models\Cars\CarMake;
use App\Models\Cars\CarModel;
use App\Models\StolenCars\Car;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;


$factory->define(
    User::class,
    function (Faker $faker) {
        return [
            'name' => $faker->name,
            'email' => $faker->email,
        ];
    }
);

$factory->define(
    CarMake::class,
    function (Faker $faker) {
        return [
            'name' => $faker->unique()->name,
            'remote_id' => $faker->numberBetween(1, 1000),
        ];
    }
);

$factory->define(
    CarModel::class,
    function (Faker $faker) {
        return [
            'name' => $faker->unique()->name,
            'remote_id' => $faker->numberBetween(1, 1000),
            'make_id' => function () {
                return factory(CarMake::class)->create()->id;
            }
        ];
    }
);


$factory->define(
    Car::class,
    function (Faker $faker) {
        return [
            'name' => $faker->unique()->name,
            'vin' => $faker->unique()->word,
            'registration_plate' => $faker->unique()->word,
            'color' => $faker->colorName,
            'year' => $faker->year,
            'model_id' => function () {
                return factory(CarModel::class)->create()->id;
            },
        ];
    }
);

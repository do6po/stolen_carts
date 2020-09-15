<?php

/** @var Factory $factory */

use App\Models\Cars\CarMake;
use App\Models\Cars\CarModel;
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
        ];
    }
);

$factory->define(
    CarModel::class,
    function (Faker $faker) {
        return [
            'name' => $faker->unique()->name,
            'make_id' => function () {
                return factory(CarMake::class)->create()->id;
            }
        ];
    }
);

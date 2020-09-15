<?php

/** @var Factory $factory */

use App\Models\Make;
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
    Make::class,
    function (Faker $faker) {
        return [
            'name' => $faker->unique()->name,
        ];
    }
);

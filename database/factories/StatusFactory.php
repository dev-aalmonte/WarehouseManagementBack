<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Status;
use Faker\Generator as Faker;

$factory->define(Status::class, function (Faker $faker) {
    return [
        "property" => $faker->randomElement([1,2]),
        'name' => $faker->unique()->randomElement(["Hold", "Picked", "Packed", "Shipped", "Completed", "Available", "Not Available"])
    ];
});

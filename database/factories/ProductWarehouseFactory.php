<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ProductWarehouse;
use Faker\Generator as Faker;

$factory->define(ProductWarehouse::class, function (Faker $faker) {
    return [
        'productID' => $faker->unique()->numberBetween(1, 30),
        'warehouseID' => $faker->numberBetween(1, 2),
        'stock' => $faker->numberBetween(0, 200),
        'statusID' => $faker->randomElement([2, 5])
    ];
});

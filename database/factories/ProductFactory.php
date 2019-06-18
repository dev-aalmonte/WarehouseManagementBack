<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'price' => $faker->randomFloat(2, 5, 500),
        'description' => $faker->text(250),
        'metric_weight' => 'lb',
        'weight' => $faker->randomFloat(2, 0, 100),
        'metric_longitude' => 'ft',
        'width' => $faker->randomFloat(2, 0, 6),
        'height' => $faker->randomFloat(2, 0, 6),
        'length' => $faker->randomFloat(2, 0, 6)
    ];
});

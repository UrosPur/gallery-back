<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
        'url' => $faker->imageUrl($width = 220, $height = 180),
        'gallery_id'=> rand(1,30),
    ];
});

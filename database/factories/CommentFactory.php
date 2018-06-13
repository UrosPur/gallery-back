<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [

        'text' => $faker->text(50),
        'gallery_id' => rand(1 , 10),
        'user_id' => rand(1, 5)
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(App\Gallery::class, function (Faker $faker) {
    return [
        'name' =>$faker->sentence(1,true),
        'description' => $faker->text(250),
        'user_id' => rand(1,10)
    ];
});

<?php

$factory->define(App\Parcel::class, function (Faker\Generator $faker) {
    return [
        "state" => collect(["Processing","Sent","Received",])->random(),
        "height" => $faker->randomFloat(2, 1, 100),
        "width" => $faker->randomFloat(2, 1, 100),
        "length" => $faker->randomFloat(2, 1, 100),
        "weight" => $faker->randomFloat(2, 1, 100),
        "delivery_type" => collect(["0","1","2","3",])->random(),
        "cost" => $faker->randomFloat(2, 1, 100),
        "insurance" => 0,
        "priority" => $faker->randomNumber(2),
        "delivery_time" => $faker->date("d.m.Y H:i:s", $max = 'now'),
    ];
});

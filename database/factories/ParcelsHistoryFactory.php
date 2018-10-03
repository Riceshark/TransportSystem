<?php

$factory->define(App\ParcelsHistory::class, function (Faker\Generator $faker) {
    return [
        "enter_time" => $faker->date("d.m.Y H:i:s", $max = 'now'),
        "leave_time" => $faker->date("d.m.Y H:i:s", $max = 'now'),
        "parcel_id" => factory('App\Parcel')->create(),
    ];
});

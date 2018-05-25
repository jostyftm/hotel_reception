<?php

use Faker\Generator as Faker;

$factory->define(App\RoomPhoto::class, function (Faker $faker) {
    return [
        'room_id'	=>	factory(App\Room::class)->create()->id, 
        'src'		=>	$faker->imageUrl($width = 500, $height = 500, $category = "room"),
    ];
});

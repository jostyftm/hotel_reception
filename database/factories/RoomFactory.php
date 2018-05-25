<?php

use Faker\Generator as Faker;
use App\RoomType;

$factory->define(App\Room::class, function (Faker $faker) {

	$roomTypes = RoomType::pluck('id')->all();
	// $states = array('busy', 'no_busy', 'pending', 'canceled', 'cleaning');

    return [
        'room_type_id'	=>	$faker->randomElement($roomTypes), 
        'name'			=>	$faker->unique()->numberBetween(1,100), 
        'description'	=>	$faker->text(50),
        'state'			=>	'no_busy',
    ];
});

<?php

use Faker\Generator as Faker;
use Carbon\Carbon;
use App\Room;
use App\User;

$factory->define(App\Reservation::class, function (Faker $faker) {
    

    $states = array('busy', 'no_busy');
    $rooms = Room::whereHas('photos')->get()->pluck('id')->toArray();
    $users = User::role('user')->pluck('id')->toArray();

    $state = $faker->randomElement($states);
    $date_entry = Carbon::yesterday();
    $date_exit = Carbon::yesterday()->addHours(8);

    return [
        'client_id'		=>	$faker->randomElement($users),
        'room_id'		=>	$faker->randomElement($rooms), 
        'state'			=>	$state,
        'date_entry'	=>	$date_entry, 
        'date_exit'		=> 	$date_exit,
    ];

});

<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->defineAs(App\User::class, 'user', function (Faker $faker) {

	$identification = $faker->unique()->randomNumber(9);

    return [
        'name' 						=> $faker->name,
        'last_name'					=> $faker->lastName,
        'identification_number' 	=> $identification,
        'address'					=> $faker->address,
        'phone'						=> $faker->phoneNumber,
        'email' 					=> $faker->unique()->safeEmail,
        'username'					=> $identification,
        'password' 					=> bcrypt('secret'),
        'avatar'					=> $faker->imageUrl($width = 500, $height = 500, $category = "people"),
        'remember_token' 			=> str_random(10),
    ];
});

$factory->defineAs(App\User::class, 'admin', function (Faker $faker) {
    
    return [
        'name'                      =>  "Admin",
        'last_name'                 =>  ".",
        'identification_number'     =>  "11111111111",
        'address'                   =>  $faker->address,
        'email'                     =>  "admin@hotel.com",
        'username'                  =>  "admin@hotel.com",
        'password'                  =>  bcrypt("admin"),
        'avatar'                   =>  $faker->imageUrl($width = 500, $height = 500, 'people'),
        'remember_token'            =>  str_random(10),
    ];
});

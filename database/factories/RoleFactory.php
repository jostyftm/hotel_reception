<?php

use Faker\Generator as Faker;
use Spatie\Permission\Models\Role;

$factory->defineAs(Role::class, 'user', function (Faker $faker) {
    return [
        'name'			=>	'user',
    ];
});

$factory->defineAs(Role::class, 'admin', function (Faker $faker) {
    return [
        'name'			=>	'admin',
    ];
});

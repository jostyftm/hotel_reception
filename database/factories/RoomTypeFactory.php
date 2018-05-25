<?php

use Faker\Generator as Faker;

$factory->defineAs(App\RoomType::class, 'simple', function (Faker $faker) {
    return [
        'type'			=>	'simple',
        'price'			=> 	35000,
        'description'	=>	'Todas nuestras habitaciones simples tienen una superficie
			aproximada de 20 m2, luz natural, vista panorámica de la
			ciudad de La Paz.
			Contamos con 32 Habitaciones.
			Este tipo de habitación cuenta con sistema central de
			calefacción, conexión a Internet (ADSL y Wi-Fi).'
    ];
});

$factory->defineAs(App\RoomType::class, 'doble', function (Faker $faker) {
    return [
        'type'			=>	'doble',
        'price'			=> 	70000,
        'description'	=>	'Cada habitación doble cuenta con dos camas tipo
			"Full Size", Frigo-Bar, Radio Reloj y una superficie
			aproximada de 30 m2. La tarífa incluye el desayuno buffet,
			bebida de bienvenida, uso del club Oasis, y el uso del
			Business Center. Contamos con 44 Habitaciones de tipo twin
			y 9 matrimoniales.'
    ];
});

$factory->defineAs(App\RoomType::class, 'standar', function (Faker $faker) {
    return [
        'type'			=>	'standar',
        'price'			=> 	100000,
        'description'	=>	'Suites finamente decoradas, cuentan con jacuzzi, dos
			camas tipo "queen size", y una pequeña sala.
			Aproximadamente cuenta con 37m2. Grandes ventanales
			y una magnífica vista de la Iglesia de San Francisco.
			Contamos con 9 Suites Estándar.'
    ];
});

$factory->defineAs(App\RoomType::class, 'ejecutiva', function (Faker $faker) {
    return [
        'type'			=>	'ejecutiva',
        'price'			=> 	150000,
        'description'	=> 	'Ideal para ejecutivos, posee una sala privada para
			reuniones y visitas de trabajo, tiene baño de visitas,
			conexión permanente a Internet (ADSL y Wi-Fi).
			Aproximadamente 40 m2. Además contamos con un
			Office Center totalmente equipado y Servicio Secretarial.
			Contamos con 9 Suites Ejecutivas.'
    ];
});

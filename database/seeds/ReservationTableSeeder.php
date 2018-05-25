<?php

use Illuminate\Database\Seeder;

use App\Room;
use App\User;

class ReservationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Reservation::class, 10)->create();
    }
}

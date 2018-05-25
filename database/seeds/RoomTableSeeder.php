<?php

use Illuminate\Database\Seeder;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Room::class, 10)->create()
        ->each(function($room){
            $room->photos()->saveMany(
                factory(App\RoomPhoto::class, 5)->make([
                    'room_id'   =>  $room->id
                ])
            );
        });
    }
}

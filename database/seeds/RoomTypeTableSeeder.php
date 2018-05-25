<?php

use Illuminate\Database\Seeder;

class RoomTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\RoomType::class, 'simple', 1)->create();
        factory(App\RoomType::class, 'doble', 1)->create();
        factory(App\RoomType::class, 'standar', 1)->create();
        factory(App\RoomType::class, 'ejecutiva', 1)->create();
    }
}

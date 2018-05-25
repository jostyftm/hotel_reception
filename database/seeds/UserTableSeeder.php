<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 'admin', 1)->create()
     	->each(function($admin){
     		$admin->assignRole('admin');
     	});

     	// factory(App\User::class, 'user', 50)->create()
     	// ->each(function($user){
     	// 	$user->assignRole('user');
     	// });
    }
}

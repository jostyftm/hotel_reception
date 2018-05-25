<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Role::class, 'admin', 1)->create();
        factory(Role::class, 'user', 1)->create();
    }
}

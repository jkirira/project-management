<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         factory('App\Roles')->create(['id'=> 1, 'name' => 'Tenant']);
         factory('App\Roles')->create(['id' => 2, 'name' => 'Manager']);
         factory('App\Roles')->create(['id' => 3, 'name' => 'Supervisor']);
    }
}

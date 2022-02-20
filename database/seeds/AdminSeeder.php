<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'supervisor',
            'last_name' => 'supervisor',
            'email' => 'supervisor@supervisor.com',
            'password' => bcrypt('12345678'),
            'phone' => Faker::numerify('##########'),
            'national_id' => Faker::numerify('##########'),
            'role_id' => 3,
            'remember_token' => str_random(10),
        ]);

        DB::table('users')->insert([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'phone' => Faker::numerify('##########'),
            'national_id' => Faker::numerify('##########'),
            'role_id' => 3,
            'remember_token' => str_random(10),
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        DB::table('users')->insert([
            'name' => "Santiago Velez S",
            'email' => 'santiago.velezs@autonoma.edu.co',
            'password' => Hash::make('hola123'),
            'username' => 'santiagovelezs',
        ]);
        

        DB::table('users')->insert([
            'name' => $faker->name($gender = null|'male'|'female'),
            'email' => $faker->email(),
            'password' => Hash::make('hola123'),
            'username' => $faker->userName(),
        ]);
    }
}

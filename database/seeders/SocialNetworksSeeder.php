<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialNetworksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        
        DB::table('social_networks')->insert([
            'type'   => 'twitter',
            'url'     => $faker->url(),
            'user_id' => 1,
        ]);

        DB::table('social_networks')->insert([
            'type'   => 'youtube',
            'url'     => $faker->url(),
            'user_id' => 1,
        ]);
    }
}

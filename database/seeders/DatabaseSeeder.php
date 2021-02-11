<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ImagesTemasSeeder;
use Database\Seeders\MyLinktreesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            UsersSeeder::class,
            LinksSeeder::class,
            SocialNetworksSeeder::class,
            ImagesTemasSeeder::class,
            MyLinktreesSeeder::class,
        ]);
    }
}

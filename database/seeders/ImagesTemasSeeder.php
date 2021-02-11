<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesTemasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images_temas')->insert([
            'name' => "Fondo 001",
            'url_image' => 'fondo02.jpg',            
        ]);
        DB::table('images_temas')->insert([
            'name' => "Fondo 002",
            'url_image' => 'fondo03.jpg',            
        ]);
        DB::table('images_temas')->insert([
            'name' => "Fondo 003",
            'url_image' => 'fondo05.jpg',            
        ]);
        DB::table('images_temas')->insert([
            'name' => "Fondo 004",
            'url_image' => 'fondo06.jpg',            
        ]);
        DB::table('images_temas')->insert([
            'name' => "Fondo 005",
            'url_image' => 'fondo07.jpg',            
        ]);
        DB::table('images_temas')->insert([
            'name' => "Fondo 006",
            'url_image' => 'fondo10.jpg',            
        ]);
        DB::table('images_temas')->insert([
            'name' => "Fondo 007",
            'url_image' => 'fondo11.jpg',            
        ]);
        DB::table('images_temas')->insert([
            'name' => "Fondo 008",
            'url_image' => 'fondo12.jpg',            
        ]); 
    }
}

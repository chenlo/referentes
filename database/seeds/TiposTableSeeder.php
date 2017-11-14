<?php

use Illuminate\Database\Seeder;

class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos')->insert([
            'nombre' => 'Metáfora',
        ]);
        DB::table('tipos')->insert([
            'nombre' => 'Metonímia',
        ]);
        DB::table('tipos')->insert([
            'nombre' => 'Nominalización de adjetivo relacional',
        ]);
        DB::table('tipos')->insert([
            'nombre' => 'Antonomasia',
        ]);
        DB::table('tipos')->insert([
            'nombre' => 'Adjetivación',
        ]);
        DB::table('tipos')->insert([
            'nombre' => 'Verbalización',
        ]);
        DB::table('tipos')->insert([
            'nombre' => 'Etimología popular',
        ]);
    }
}
<?php

use Illuminate\Database\Seeder;

class LenguasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lenguas')->insert([
            'nombre' => 'Español',
        ]);
        DB::table('lenguas')->insert([
            'nombre' => 'Inglés',
        ]);
        DB::table('lenguas')->insert([
            'nombre' => 'Vasco',
        ]);
    }
}

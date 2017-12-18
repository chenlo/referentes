<?php

use Illuminate\Database\Seeder;

class FinalCategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('final_categorias')->insert([
            'palabra' => 'Nombre común',
        ]);
        DB::table('final_categorias')->insert([
            'palabra' => 'Adjetivo',
        ]);
        DB::table('final_categorias')->insert([
            'palabra' => 'Adjetivo: gentilicio',
        ]);
        DB::table('final_categorias')->insert([
            'palabra' => 'Verbo',
        ]);
    }
}

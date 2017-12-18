<?php

use Illuminate\Database\Seeder;

class InicialCategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inicial_categorias')->insert([
            'palabra' => 'Antropónimo: nombre de personal',
        ]);
        DB::table('inicial_categorias')->insert([
            'palabra' => 'Antropónimo: apellido',
        ]);
        DB::table('inicial_categorias')->insert([
            'palabra' => 'Antropónimo: hipocorístico',
        ]);
        DB::table('inicial_categorias')->insert([
            'palabra' => 'Topónimo',
        ]);
        DB::table('inicial_categorias')->insert([
            'palabra' => 'Nombre de marca',
        ]);
    }
}

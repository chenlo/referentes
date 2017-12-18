<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LenguasTableSeeder::class);
        $this->call(TiposTableSeeder::class);
        $this->call(InicialCategoriasTableSeeder::class);
        $this->call(FinalCategoriasTableSeeder::class);
    }
}

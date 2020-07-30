<?php

use Illuminate\Database\Seeder;

class KejuruansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Kejuruan::create([
            'name' => 'Elektronika',
        ]);

        \App\Kejuruan::create([
            'name' => 'Refrigration',
        ]);

        \App\Kejuruan::create([
            'name' => 'Tek. Informasi dan Komunikasi',
        ]);

        \App\Kejuruan::create([
            'name' => 'Pariwisata',
        ]);
    }
}

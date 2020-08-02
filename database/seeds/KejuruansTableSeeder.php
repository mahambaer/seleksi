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
            'name' => strtoupper('Elektronika'),
        ]);

        \App\Kejuruan::create([
            'name' => strtoupper('Refrigration'),
        ]);

        \App\Kejuruan::create([
            'name' => strtoupper('Tek. Informasi dan Komunikasi'),
        ]);

        \App\Kejuruan::create([
            'name' => strtoupper('Pariwisata'),
        ]);
    }
}

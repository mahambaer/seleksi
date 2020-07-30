<?php

use Illuminate\Database\Seeder;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kejuruan = \App\Kejuruan::where('name', 'Refrigration')->first();
        \App\Program::create([
            'name' => 'ASISTEN TEKNISI REFRIGERASI DAN AC LEVEL I',
            'durasi' => 120,
            'kejuruan_id' => $kejuruan->id
        ]);
    }
}

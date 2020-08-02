<?php

use Illuminate\Database\Seeder;

class PesertasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $program = \App\Program::where('name', strtoupper('TEKNISI PEMELIHARAAN OTOMASI ELEKTRONIKA INDUSTRI (MAINTENANCE INDUSTRI 4.0)'))->first();
        \App\Peserta::create([
            'name' => 'Agung',
            'email' => 'mahambaer@gmail.com',
            'program_id' => $program->id,
            'token' => bcrypt($program->id.'mahambaer@gmail.com')
        ]);
    }
}

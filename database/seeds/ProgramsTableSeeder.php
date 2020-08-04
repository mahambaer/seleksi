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
        $kejuruan = \App\Kejuruan::where('name', strtoupper('Refrigration'))->first();
        \App\Program::create([
            'name' => strtoupper('ASISTEN TEKNISI REFRIGERASI DAN AC LEVEL I'),
            'kejuruan_id' => $kejuruan->id
        ]);
        
        $kejuruan = \App\Kejuruan::where('name', strtoupper('Pariwisata'))->first();
        \App\Program::create([
            'name' => strtoupper('BARISTA'),
            'kejuruan_id' => $kejuruan->id
        ]);
        
        $kejuruan = \App\Kejuruan::where('name', strtoupper('Tek. Informasi dan Komunikasi'))->first();
        \App\Program::create([
            'name' => strtoupper('DESAINER GRAFIS JUNIOR (JUNIOR GRAPHIC DESIGNER)'),
            'kejuruan_id' => $kejuruan->id
        ]);
        
        $kejuruan = \App\Kejuruan::where('name', strtoupper('Pariwisata'))->first();
        \App\Program::create([
            'name' => strtoupper('FOOD and BEVERAGE SERVICE'),
            'kejuruan_id' => $kejuruan->id
        ]);
        
        $kejuruan = \App\Kejuruan::where('name', strtoupper('Pariwisata'))->first();
        \App\Program::create([
            'name' => strtoupper('FRONT OFFICE RECEPTIONIST'),
            'kejuruan_id' => $kejuruan->id
        ]);
        
        $kejuruan = \App\Kejuruan::where('name', strtoupper('Pariwisata'))->first();
        \App\Program::create([
            'name' => strtoupper('HOUSEKEEPING ATTANDANT'),
            'kejuruan_id' => $kejuruan->id
        ]);
        
        $kejuruan = \App\Kejuruan::where('name', strtoupper('Tek. Informasi dan Komunikasi'))->first();
        \App\Program::create([
            'name' => strtoupper('IT SOFTWARE SOLUTIONS FOR BUSINESS'),
            'kejuruan_id' => $kejuruan->id
        ]);
        
        $kejuruan = \App\Kejuruan::where('name', strtoupper('Tek. Informasi dan Komunikasi'))->first();
        \App\Program::create([
            'name' => strtoupper('JUNIOR MOBILE PROGRAMMER'),
            'kejuruan_id' => $kejuruan->id
        ]);
        
        $kejuruan = \App\Kejuruan::where('name', strtoupper('Tek. Informasi dan Komunikasi'))->first();
        \App\Program::create([
            'name' => strtoupper('MOTION GRAPHIC ARTIST'),
            'kejuruan_id' => $kejuruan->id
        ]);
        
        $kejuruan = \App\Kejuruan::where('name', strtoupper('Tek. Informasi dan Komunikasi'))->first();
        \App\Program::create([
            'name' => strtoupper('NETWORK PROFESIONAL'),
            'kejuruan_id' => $kejuruan->id
        ]);
        
        $kejuruan = \App\Kejuruan::where('name', strtoupper('Pariwisata'))->first();
        \App\Program::create([
            'name' => strtoupper('Roti & Pattiserie'),
            'kejuruan_id' => $kejuruan->id
        ]);
        
        $kejuruan = \App\Kejuruan::where('name', strtoupper('Elektronika'))->first();
        \App\Program::create([
            'name' => strtoupper('TEKNIK TELEKOMUNIKASI'),
            'kejuruan_id' => $kejuruan->id
        ]);
        
        $kejuruan = \App\Kejuruan::where('name', strtoupper('Elektronika'))->first();
        \App\Program::create([
            'name' => strtoupper('Teknisi Embedded System Mikrokontroler'),
            'kejuruan_id' => $kejuruan->id
        ]);
        
        $kejuruan = \App\Kejuruan::where('name', strtoupper('Elektronika'))->first();
        \App\Program::create([
            'name' => strtoupper('TEKNISI INSTALASI FIBER OPTIK MADYA'),
            'kejuruan_id' => $kejuruan->id
        ]);
        
        $kejuruan = \App\Kejuruan::where('name', strtoupper('Elektronika'))->first();
        \App\Program::create([
            'name' => strtoupper('TEKNISI PEMELIHARAAN OTOMASI ELEKTRONIKA INDUSTRI (MAINTENANCE INDUSTRI 4.0)'),
            'kejuruan_id' => $kejuruan->id
        ]);
        
        $kejuruan = \App\Kejuruan::where('name', strtoupper('Refrigration'))->first();
        \App\Program::create([
            'name' => strtoupper('TEKNISI REFRIGERASI DOMESTIK LEVEL III'),
            'kejuruan_id' => $kejuruan->id
        ]);

        $kejuruan = \App\Kejuruan::where('name', strtoupper('Elektronika'))->first();
        \App\Program::create([
            'name' => strtoupper('Teknisi Telepon Seluler'),
            'kejuruan_id' => $kejuruan->id
        ]);
    }
}

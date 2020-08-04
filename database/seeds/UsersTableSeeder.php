<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Admin Kios',
            'email' => 'blkbekasi',
            'password' => bcrypt('bek4sisel4t4n')
        ]);
    }
}

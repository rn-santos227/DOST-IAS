<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'username' => 'admin',
            'nickname' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 1,
            'agency' => ' ',
            'agency_email' => ' ',
            'title' => 'mr',
            'position' => 'Administrator',
            'contact' => ' '
        ]);
    }
}

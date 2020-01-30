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
        DB::table('users')->insert([
            'username' => 'mikkel',
            'email' => 'dasmikko@gmail.com',
            'role' => 1,
            'active' => 1,
            'password' => bcrypt('123'),
        ]);
    }
}

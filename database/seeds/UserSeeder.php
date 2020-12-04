<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'email' => '123'.'@gmail.com',
            'password' => Hash::make('123456789'),
            'token' => '123',
            'userrole_id' => 1
        ]);
    }
}

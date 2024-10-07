<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ahmed Farag',
            'email' => 'ahmed@gmail.com',
            'password' => Hash::make('password'),
            'phone_number' => '9696858147',
        ]);

        //use query builder
        DB::table('users')->insert([
            'name' => 'System Admin',
            'email' => 'sys@gmail.com',
            'password' => Hash::make('password'),
            'phone_number' => '9696858148',
        ]);
    }
}

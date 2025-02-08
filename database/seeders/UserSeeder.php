<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make(123),
            'role_id' => '2',
        ]);
        User::create([
            'name' => 'Admin Buku',
            'email' => 'abk@gmail.com',
            'password' => Hash::make(123),
            'role_id' => '2',
        ]);
        User::create([
            'name' => 'Admin Projek',
            'email' => 'ap@gmail.com',
            'password' => Hash::make(123),
            'role_id' => '3',
        ]);
    }
}
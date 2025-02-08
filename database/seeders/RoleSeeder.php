<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'id_role' => '1',
            'level' => 'Owner',
        ]);
        Role::create([
            'id_role' => '2',
            'level' => 'Admin Buku Besar',
        ]);
        Role::create([
            'id_role' => '3',
            'level' => 'Admin Projek',
        ]);
    }
}
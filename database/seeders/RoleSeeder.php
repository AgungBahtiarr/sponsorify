<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            'role' => 'Event Organizer',
        ]);
        DB::table('roles')->insert([
            'role' => 'Sponsorship',
        ]);
        DB::table('roles')->insert([
            'role' => 'Admin',
        ]);
    }
}

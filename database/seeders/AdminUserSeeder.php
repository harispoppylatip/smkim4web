<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@smkistiqomah.sch.id'],
            [
                'name' => 'Admin SMKIM4',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ]
        );
    }
}

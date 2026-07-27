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
        \App\Models\User::create([
            'name' => 'Admin SMKIM4',
            'email' => 'admin@smkistiqomah.sch.id',
            'password' => bcrypt('admin123'),
        ]);
    }
}

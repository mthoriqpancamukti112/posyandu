<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'username' => 'Kader Posyandu',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}

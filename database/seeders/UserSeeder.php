<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'phone_number' => '081234567890',
            'password' => bcrypt('admin'),
            'role' => 2,
            'referral_code' => 'ABCDE',
            'referral_points' => 0,
        ]);
    }
}

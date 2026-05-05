<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'superadmin@nationaltodaybd.com'],
            [
                'name' => 'superadmin',
                'email' => 'superadmin@nationaltodaybd.com',
                'password' => bcrypt('password'), // Ensure to set a default password
            ]
        );

        $user = User::where('email', 'superadmin@nationaltodaybd.com')->first();
        $user->assignRole('superadmin');

    }
}

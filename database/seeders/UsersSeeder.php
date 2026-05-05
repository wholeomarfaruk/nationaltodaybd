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
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@metronews.info',
            'password' => bcrypt('password'), // Ensure to set a default password
        ]);
        $user = User::find(1);
        $user->assignRole('superadmin');

    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users for each role
        $roles = ['superadmin', 'admin', 'principal', 'teacher'];

        foreach ($roles as $role) {
            User::factory()->create([
                'name' => ucfirst($role) . ' User',
                'email' => $role . '@example.com',
                'role' => $role,
                'password' => bcrypt('password'), // Make sure to change in production
            ]);
        }

        // Create some additional regular teachers
        User::factory(3)->create([
            'role' => 'teacher'
        ]);
    }
}

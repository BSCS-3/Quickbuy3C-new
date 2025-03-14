<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin' => Role::firstOrCreate(['name' => 'admin']),
            'seller' => Role::firstOrCreate(['name' => 'seller']),
            'customer' => Role::firstOrCreate(['name' => 'customer']),
        ];

         // Define users with different roles
         $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'), // Change this in production
                'role' => 'admin',
            ],
            [
                'name' => 'Seller User',
                'email' => 'seller@example.com',
                'password' => Hash::make('password'),
                'role' => 'seller',
            ],
            [
                'name' => 'Customer User',
                'email' => 'customer@example.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ],
        ];

        // Insert users into the database and attach roles
        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
            ]);

            // Assign role using pivot table
            $user->roles()->attach($roles[$userData['role']]);
        }
    }
}

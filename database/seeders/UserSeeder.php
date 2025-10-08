<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Data user dan role masing-masing
        $users = [
            [
                'name'  => 'Super Admin',
                'email' => 'superadmin@example.com',
                'role'  => 'super-admin',
            ],
            [
                'name'  => 'Accounting',
                'email' => 'accounting@example.com',
                'role'  => 'accounting',
            ],
            [
                'name'  => 'Finance',
                'email' => 'finance@example.com',
                'role'  => 'finance',
            ],
            [
                'name'  => 'HRD',
                'email' => 'hrd@example.com',
                'role'  => 'hrd',
            ],
            [
                'name'  => 'Employee',
                'email' => 'employee@example.com',
                'role'  => 'employee',
            ],
        ];

        // Loop setiap data user
        foreach ($users as $data) {
            $user = User::firstOrCreate(
                [
                    'email' => $data['email']
                ],
                [
                    'name'     => $data['name'],
                    'password' => Hash::make('password'), // Password default
                ]
            );

            // Assign role ke user
            $user->assignRole($data['role']);
        }
    }
}

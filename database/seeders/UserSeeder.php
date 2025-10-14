<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan role sudah ada
        $role = Role::firstOrCreate(['name' => 'super-admin']);

        // Data user
        $users = [
            [
                'name'  => 'iruzz',
                'email' => 'ruzz@gmail.com',
                'password' => Hash::make('12345'),
                'role'  => 'super-admin',
            ],
        ];

        // Loop simpan user ke database
        foreach ($users as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']], // kalau email sudah ada, gak buat baru
                [
                    'name' => $data['name'],
                    'password' => $data['password'],
                ]
            );

            // Assign role-nya (pastikan Spatie Permission sudah di-setup)
            $user->assignRole($data['role']);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan role sudah ada
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'publisher', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@dimzstore.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }

        // Publishers
        $publishers = [
            ['name' => 'Penerbit Gramedia', 'email' => 'gramedia@dimzstore.com'],
            ['name' => 'Penerbit Erlangga', 'email' => 'erlangga@dimzstore.com'],
            ['name' => 'Indie Writer Studio', 'email' => 'indie@dimzstore.com'],
        ];

        foreach ($publishers as $pubData) {
            $publisher = User::firstOrCreate(
                ['email' => $pubData['email']],
                [
                    'name' => $pubData['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );
            if (!$publisher->hasRole('publisher')) {
                $publisher->assignRole('publisher');
            }
        }

        // Regular Users
        $users = [
            ['name' => 'Budi Santoso', 'email' => 'budi@example.com'],
            ['name' => 'Siti Aminah', 'email' => 'siti@example.com'],
            ['name' => 'Andi Wijaya', 'email' => 'andi@example.com'],
            ['name' => 'Dewi Lestari', 'email' => 'dewi@example.com'],
            ['name' => 'Rizki Pratama', 'email' => 'rizki@example.com'],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );
            if (!$user->hasRole('user')) {
                $user->assignRole('user');
            }
        }

        $this->command->info('Users seeded successfully!');
    }
}

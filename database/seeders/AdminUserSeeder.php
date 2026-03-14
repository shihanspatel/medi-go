<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@medigo.com'],
            [
                'name'              => 'Admin',
                'email'             => 'admin@medigo.com',
                'password'          => Hash::make('admin123'),
                'role'              => 'admin',
                'status'            => 'active',
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]
        );
    }
}

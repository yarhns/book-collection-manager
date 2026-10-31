<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
        public function run(): void
    {
        // Cari berdasarkan email. Jika tidak ada, baru buat baru.
        User::firstOrCreate(
            ['email' => 'admin@book.com'],
            [
                'name' => 'Dear Haens',
                'password' => Hash::make('password123'),
            ]
        );
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Cek apakah admin sudah ada agar tidak duplikat
        if (!User::where('username', 'admin')->exists()) {
            User::create([
                'full_name' => 'Administrator Utama',
                'username'  => 'admin',
                'email'     => 'admin@mindcare.com',
                'password'  => Hash::make('password123'), // Ganti password sesuai keinginan
                'role'      => 'admin',
                'is_active' => 1
            ]);
            $this->command->info('Akun Admin berhasil dibuat!');
        } else {
            $this->command->info('Akun Admin sudah ada.');
        }
    }
}
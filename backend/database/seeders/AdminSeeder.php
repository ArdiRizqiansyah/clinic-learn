<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => 'admin',
        ];

        // cek di user apakah sudah ada data yang sama
        $cek = User::where('email', $data['email'])->first();

        if (!$cek) {
            $admin = User::create($data);
            $admin->assignRole('admin');
        }
    }
}

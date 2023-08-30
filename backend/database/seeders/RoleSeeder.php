<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['admin'];

        foreach ($data as $role) {
            // cek jika ada data yang sama jangan disimpan
            $cek = Role::where('name', $role)->first();

            if (!$cek) {
                Role::create([
                    'name' => $role,
                ]);
            }
        }
    }
}

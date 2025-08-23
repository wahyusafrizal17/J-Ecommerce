<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // ✅ Tambahkan baris ini
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'Admin3',
            'email' => 'admin3@gmail.com',
            'password' => Hash::make('password123'),
        ]);
    }
}

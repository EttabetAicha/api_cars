<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Create an admin user
        User::create([
            'name' => 'aicha',
            'email' => 'aicha@gmail.com',
            'password' => Hash::make('aicha'),
        ]);
    }
}

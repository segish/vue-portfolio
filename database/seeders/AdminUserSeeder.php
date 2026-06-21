<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => config('portfolio.admin_email')],
            [
                'name' => 'Admin',
                'password' => Hash::make(config('portfolio.admin_password')),
            ],
        );
    }
}

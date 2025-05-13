<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123'),
            'is_admin' => true,
            'preferred_categories' => ['Music', 'Theater']
        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123123'),
            'is_admin' => false,
            'preferred_categories' => ['Sports', 'Comedy']
        ]);
    }
}
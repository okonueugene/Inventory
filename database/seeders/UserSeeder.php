<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'John Doe', 'email' => 'admin@admin.com', 'password' => bcrypt('12345678')],
            ['name' => 'Jane Doe', 'email' => 'staff@domain.com', 'password' => bcrypt('12345678')]
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
        
    }
}

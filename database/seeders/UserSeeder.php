<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Joe',
            'email' => 'emailme@joelohr.com',
            'password' => bcrypt('password'),
        ]);
    }
}

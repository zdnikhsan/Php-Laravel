<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 'admin2',
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('admin2'),
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@filamentphp.com',
            'password' => '$2y$10$4PHCQ7UvyUE/1zVblSmJg.BKCKel.bmUY0QTvXJu3OEez5r6.6oDG', // Password: Test7894*
        ]);

        User::factory()->count(10)->create();
    }
}

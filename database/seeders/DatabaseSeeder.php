<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Test User',
            'last_name' => 'Admin',
            'middle_name' => 'admin',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $this->call(ProgramSeeder::class);
        $this->call(TermSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(StudentProgramSeeder::class);
    }
}

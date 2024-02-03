<?php

namespace Database\Seeders;

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
        \App\Models\User::factory()->create([
            'name' => 'Myshko',
            'email' => 'me@test.wip',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        \App\Models\User::factory(10)->create();

        $this->call(TopicSeeder::class);
        $this->call(PostSeeder::class);
    }
}

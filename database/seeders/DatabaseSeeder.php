<?php

namespace Database\Seeders;

use App\Models\Release;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1234'),
            'email_verified_at' => now(),
        ]);

        $this->call([
            LungSeeder::class,
            AccountSeeder::class,
            CategorySeeder::class,
        ]);

        Release::factory()->count(30)->create();
    }
}

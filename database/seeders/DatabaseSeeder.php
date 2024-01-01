<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ERole;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //        $this->call(RoleAndPermissionSeeder::class);

        $user = User::create([
            'name' => 'Moderator',
            'email' => 'mod@test.com',
            'password' => \Hash::make('password'),
        ]);

        $user->assignRole(ERole::MODERATOR->value);
    }
}

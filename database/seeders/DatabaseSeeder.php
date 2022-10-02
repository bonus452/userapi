<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use File;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $user = User::factory()->create([
             'name' => 'Test User'
         ]);

        $token = $user->createToken($user->email);
        File::put(base_path('bearer_token.txt'), $token->plainTextToken);

    }
}

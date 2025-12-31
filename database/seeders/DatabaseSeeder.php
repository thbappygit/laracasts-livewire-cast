<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Greeting;
use App\Models\User;
use Database\Factories\ArticleFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Greeting::create(['greeting' => 'Hello']);
        Greeting::create(['greeting' => 'Hi']);
        Greeting::create(['greeting' => 'Hey']);
        Greeting::create(['greeting' => 'Howdy']);
        Greeting::create(['greeting' => 'Hola']);

         Article::factory(50)->create();
    }
}

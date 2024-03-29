<?php

namespace Database\Seeders;

use App\Models\Category;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Category::factory(15)->create();

        $this->call([
            CategoryDatabaseSeeder::class,
        ]);
        $this->call([
            ProductDatabaseSeeder::class,
        ]);
        // $this->call([
        //     AdminDatabaseSeeder::class,
        // ]);
    }
}

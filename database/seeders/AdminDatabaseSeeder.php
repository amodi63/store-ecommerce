<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Mohammed Amodi',
            'email' => 'Amodi123@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}

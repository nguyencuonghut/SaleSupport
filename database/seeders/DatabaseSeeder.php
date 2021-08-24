<?php

namespace Database\Seeders;

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
        $this->call([
            DepartmentsTableSeeder::class,
            UsersTableSeeder::class,
            ProductsTableSeeder::class,
            PriceTableSeeder::class,
            PolicyTableSeeder::class,
        ]);
    }
}

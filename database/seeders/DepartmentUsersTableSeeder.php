<?php

namespace Database\Seeders;

use App\Models\DepartmentUser;
use Database\Factories\DepartmentUserFactory;
use Illuminate\Database\Seeder;

class DepartmentUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DepartmentUser::factory(100)->create();
    }
}

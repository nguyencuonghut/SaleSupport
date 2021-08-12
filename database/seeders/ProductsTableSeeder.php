<?php

namespace Database\Seeders;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();

        DB::table('products')->insert(array (
            0 => array (
                    'id' => 1,
                    'code' => '1680R_25',
                    'weight' => 25,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            1 => array (
                    'id' => 2,
                    'code' => 'H168_25',
                    'weight' => 25,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            2 => array (
                    'id' => 3,
                    'code' => 'GT01_25',
                    'weight' => 25,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            3 => array (
                    'id' => 4,
                    'code' => 'Max01_25',
                    'weight' => 25,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            4 => array (
                    'id' => 5,
                    'code' => 'GT02_25',
                    'weight' => 25,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            5 => array (
                    'id' => 6,
                    'code' => 'Max02_25',
                    'weight' => 25,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            6 => array (
                    'id' => 7,
                    'code' => 'H128E_25',
                    'weight' => 25,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            7 => array (
                    'id' => 8,
                    'code' => '9999_20',
                    'weight' => 20,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            8 => array (
                    'id' => 9,
                    'code' => 'FS9999_20',
                    'weight' => 20,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            9 => array (
                    'id' => 10,
                    'code' => '1660_25',
                    'weight' => 25,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            10 => array (
                    'id' => 11,
                    'code' => '1110P_05',
                    'weight' => 5,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            11 => array (
                    'id' => 12,
                    'code' => '1110P_20',
                    'weight' => 20,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            12 => array (
                    'id' => 13,
                    'code' => '1120_25',
                    'weight' => 25,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            13 => array (
                    'id' => 14,
                    'code' => '1130S_25',
                    'weight' => 25,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            14 => array (
                    'id' => 15,
                    'code' => '1100S_25',
                    'weight' => 25,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            15 => array (
                    'id' => 16,
                    'code' => '1100_25',
                    'weight' => 25,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            16 => array (
                    'id' => 17,
                    'code' => '1200S_25',
                    'weight' => 25,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            17 => array (
                    'id' => 18,
                    'code' => '1410_25',
                    'weight' => 25,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            18 => array (
                    'id' => 19,
                    'code' => '1430_25',
                    'weight' => 25,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            19 => array (
                    'id' => 20,
                    'code' => '1100FS_25',
                    'weight' => 25,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
            20 => array (
                    'id' => 21,
                    'code' => '1100LS_25',
                    'weight' => 25,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ),
        ));
    }
}

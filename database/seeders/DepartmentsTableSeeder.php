<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->delete();

        DB::table('departments')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'code' => 'PHC',
                    'name' => 'Phòng Hành Chính',
                    'description' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            1 =>
                array (
                    'id' => 2,
                    'code' => 'PNS',
                    'name' => 'Phòng Nhân Sự',
                    'description' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            2 =>
                array (
                    'id' => 3,
                    'code' => 'PKSNB',
                    'name' => 'Phòng Kiểm Soát Nội Bộ',
                    'description' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            3 =>
                array (
                    'id' => 4,
                    'code' => 'BPIT',
                    'name' => 'Bộ phận IT',
                    'description' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            4 =>
                array (
                    'id' => 5,
                    'code' => 'PT',
                    'name' => 'Phòng Trại',
                    'description' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            5 =>
                array (
                    'id' => 6,
                    'code' => 'PBT',
                    'name' => 'Phòng Bảo Trì',
                    'description' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            6 =>
                array (
                    'id' => 7,
                    'code' => 'BDA',
                    'name' => 'Ban Dự Án',
                    'description' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            7 =>
                array (
                    'id' => 8,
                    'code' => 'BPK',
                    'name' => 'Bộ phận Kho',
                    'description' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            8 =>
                array (
                    'id' => 9,
                    'code' => 'SXTS',
                    'name' => 'Bộ phận Sản Xuất Thủy Sản',
                    'description' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            9 =>
                array (
                    'id' => 10,
                    'code' => 'SXGSGC',
                    'name' => 'Bộ phận Sản Xuất Gia Súc Gia Cầm',
                    'description' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            10 =>
                array (
                    'id' => 11,
                    'code' => 'BBV',
                    'name' => 'Ban Bảo Vệ',
                    'description' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            11 =>
                array (
                    'id' => 12,
                    'code' => 'PTC',
                    'name' => 'Phòng Kế Toán',
                    'description' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            12 =>
                array (
                    'id' => 13,
                    'code' => 'PKD',
                    'name' => 'Phòng Kinh Doanh',
                    'description' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            13 =>
                array (
                    'id' => 14,
                    'code' => 'PTM',
                    'name' => 'Phòng Thu Mua',
                    'description' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            14 =>
                array (
                    'id' => 15,
                    'code' => 'QLCL',
                    'name' => 'Phòng Quản Lý Chất Lượng',
                    'description' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            15 =>
                array (
                    'id' => 16,
                    'code' => 'PKT',
                    'name' => 'Phòng Kỹ Thuật',
                    'description' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
        ));
    }
}

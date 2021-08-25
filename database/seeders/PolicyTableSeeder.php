<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PolicyTableSeeder extends Seeder
{
    function get_random_color(){
        $chars = '456789ABCDEF';
        $color = '#';
        for ( $i = 0; $i < 6; $i++ ) {
           $color .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $color;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('policies')->delete();

        DB::table('policies')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'title' => '1.Trừ trực tiếp trên hóa đơn tương đương',
                    'content' => '4100: 20bao+1
                                1120: 30bao+1
                                4200E, 2200E 40Bao+1
                                Dòng thịt 200đ/kg; gia cầm đẻ 100đ/kg
                                Đối với trừ trực tiếp hóa đơn hiện hành ( bao gồm cả phần trừ trực tiếp nêu tại mục 1), sẽ điều chỉnh giảm giá hoá đơn, phần còn lại của trừ trực tiếp chỉ bao gồm:
                                + Đậm đặc, heo nái, heo con: 500đ/kg
                                + Heo còn lại, gà thịt, vịt thịt, cám bò: 300đ/kg
                                + Gia cầm đẻ 100đ/kg.
                                Phần trừ khuyến mãi tặng bao, dòng thịt 200đ, gia cầm đẻ 100đ từ ngày 01/8 - 04/8 sẽ tính trả vào chiết khấu tháng 8',
                    'start' => '2021-07-01',
                    'end' => '2021-07-22',
                    'url' => 'policy/show/1',
                    'backgroundColor' => $color= $this->get_random_color(),
                    'borderColor' => $color,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            1 =>
                array (
                    'id' => 2,
                    'title' => '2.Khuyến mãi tháng 8',
                    'content' => 'Tặng bao 1680R: 30+1; 8200: 40+1, trả ngay đơn hàng, còn lại cộng dồn trả vào chiết khấu tháng
                                4200: 200đ/kg
                                8200: 300đ/kg
                                Vịt đẻ 200đ/kg; Cút đẻ 100đ/kg; gà đẻ 200đ/kg
                                Hỗ trợ tăng giá từ 10/8-25/8 mức gà đẻ vịt đẻ 80đ/kg; cút đẻ 100đ/kg',
                    'start' => '2021-07-21',
                    'end' => '2021-08-11',
                    'url' => 'show/2',
                    'backgroundColor' => $color= $this->get_random_color(),
                    'borderColor' => $color,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            2 =>
                array (
                    'id' => 3,
                    'title' => '3.Vượt đậm đặc',
                    'content' => 'Tháng 8 so với tháng 7 mức 600đ/kg',
                    'start' => '2021-08-01',
                    'end' => '2021-08-31',
                    'url' => 'show/3',
                    'backgroundColor' => $color= $this->get_random_color(),
                    'borderColor' => $color,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            3 =>
                array (
                    'id' => 4,
                    'title' => '4.Khuyến mãi kéo dài, nhắc lại: 2000S',
                    'content' => '2000S mức 200đ/kg',
                    'start' => '2021-06-16',
                    'end' => '2021-09-16',
                    'url' => 'show/4',
                    'backgroundColor' => $color= $this->get_random_color(),
                    'borderColor' => $color,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            4 =>
                array (
                    'id' => 5,
                    'title' => '5.Khuyến mãi kéo dài, nhắc lại: 1410E',
                    'content' => '1410E mức 200đ/kg',
                    'start' => '2021-05-18',
                    'end' => '2021-09-18',
                    'url' => 'show/5',
                    'backgroundColor' => $color= $this->get_random_color(),
                    'borderColor' => $color,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            5 =>
                array (
                    'id' => 6,
                    'title' => '6.Khuyến mãi kéo dài, nhắc lại: 1135S',
                    'content' => '1135S mức 200đ/kg',
                    'start' => '2021-06-12',
                    'end' => '2021-09-11',
                    'url' => 'show/6',
                    'backgroundColor' => $color= $this->get_random_color(),
                    'borderColor' => $color,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            6 =>
                array (
                    'id' => 7,
                    'title' => '7.Khuyến mãi kéo dài, nhắc lại: 2200E',
                    'content' => '2200E mức 300đ/kg',
                    'start' => '2021-07-16',
                    'end' => '2021-09-30',
                    'url' => 'show/7',
                    'backgroundColor' => $color= $this->get_random_color(),
                    'borderColor' => $color,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            7 =>
                array (
                    'id' => 8,
                    'title' => '8.Khuyến mãi kéo dài, nhắc lại: 1135S, 1130S, 1100S, 1410, 1410E, 1680R',
                    'content' => '1135S, 1130S, 1100S, 1410, 1410E, 1680R mức 300đ/kg',
                    'start' => '2021-09-16',
                    'end' => '2021-09-30',
                    'url' => 'show/8',
                    'backgroundColor' => $color= $this->get_random_color(),
                    'borderColor' => $color,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
        ));
    }
}

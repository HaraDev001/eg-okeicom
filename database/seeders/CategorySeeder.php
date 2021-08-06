<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();

        $datas = [
            '1'  => '語学',
            '2'  => '家庭教師',
            '3'  => '音楽',
            '4'  => 'アート・デザイン',
            '5'  => '美容',
            '6'  => '健康',
            '7'  => 'ダンス',
            '8'  => 'バレエ',
            '9'  => 'フィットネス',
            '10' => '武道',
            '11' => '書道',
            '12' => 'お茶',
            '13' => 'お花',
            '14' => '手芸',
            '15' => 'パソコン',
            '16' => '趣味',
            '17' => '教養',
            '18' => 'その他',
        ];

        foreach ( $datas as $key => $value ) {
            DB::table('categories')->insert([
                'id' => $key,
                'name' => $value,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

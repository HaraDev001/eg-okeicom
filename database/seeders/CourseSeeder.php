<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->truncate();

        $datas = [
            [
                'user_id' => 1,
                'title' => 'コース1',
                'detail' => 'コース1の詳細',
                'category1_id' => 1,
                'category2_id' => 2,
                'category3_id' => 3,
            ],
            [
                'user_id' => 1,
                'title' => 'コース2',
                'detail' => 'コース2の詳細',
                'category1_id' => 4,
                'category2_id' => 5,
                'category3_id' => 6,
            ],
            [
                'user_id' => 2,
                'title' => 'コース3',
                'detail' => 'コース3の詳細',
                'category1_id' => 1,
                'category2_id' => 2,
                'category3_id' => 3,
            ],
        ];

        foreach($datas as $data) {
            $lesson = new Course();
            $lesson->user_id = $data['user_id'];
            $lesson->title = $data['title'];
            $lesson->detail = $data['detail'];
            $lesson->category1_id = $data['category1_id'];
            $lesson->category2_id = $data['category2_id'];
            $lesson->category3_id = $data['category3_id'];
            $lesson->save();
        }
    }
}

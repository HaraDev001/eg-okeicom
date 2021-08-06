<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')->truncate();

        // for ($i = 1; $i < 20; $i++) {
        //     Lesson::create([
        //         'user_id' => 1,
        //         'course_id' => 1,
        //         'status' => 0,
        //         'public' => 1,
        //         'type' => 1,
        //         'view' => 'nQizZ9J7KmDsgSVeWKgM63ZFkDK795KcnQizZ9J7KmDsgSVeWKgM63ZFkDK795Kc',
        //         'date' => '2021-06-'.$i,
        //         'start' => '00:00',
        //         'finish' => '00:00',
        //         'price' => $i * 100,
        //         'cancel_rate' => '5',
        //         'title' => 'ユーザ1のレッスンナンバー'.$i,
        //         'detail' => 'ユーザ1のレッスン詳細ナンバー'.$i,
        //     ]);
        // }

        // for ($i = 1; $i < 16; $i++) {
        //     Lesson::create([
        //         'user_id' => 2,
        //         'course_id' => 2,
        //         'status' => 0,
        //         'public' => 1,
        //         'type' => 1,
        //         'view' => 'nCw7dCCn3Fs5gJcAyWwDeh3PDZFYaegRnCw7dCCn3Fs5gJcAyWwDeh3PDZFYaegR',
        //         'date' => '2021-06-'.$i,
        //         'start' => '00:00',
        //         'finish' => '00:00',
        //         'price' => $i * 100,
        //         'cancel_rate' => '5',
        //         'title' => 'ユーザ2のレッスンナンバー'.$i,
        //         'detail' => 'ユーザ2のレッスン詳細ナンバー'.$i,
        //     ]);
        // }
    }
}

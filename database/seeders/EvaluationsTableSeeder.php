<?php

namespace Database\Seeders;


use App\Models\Evaluation;
use Illuminate\Database\Seeder;

class EvaluationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 5; $i++) {
            Evaluation::create([
                'user_student_id'   => '1',
                'user_teacher_id'   => $i,
                'lesson_id'         => '1',
                'point'             => '4',
                'comment'           => 'とてもよかったです',
            ]);
        }
        for ($i = 5; $i < 9; $i++) {
            Evaluation::create([
                'user_student_id'   => '3',
                'user_teacher_id'   => $i,
                'lesson_id'         => '1',
                'point'             => '3',
                'comment'           => 'まあまあよかったです。',
            ]);
        }
        for ($i = 10; $i < 12; $i++) {
            Evaluation::create([
                'user_student_id'   => '2',
                'user_teacher_id'   => $i,
                'lesson_id'         => '1',
                'point'             => '2',
                'comment'           => 'あまり良くなかったです。',
            ]);
        }
        for ($i = 1; $i < 5; $i++) {
            Evaluation::create([
                'user_student_id'   => '1',
                'user_teacher_id'   => $i,
                'lesson_id'         => '1',
                'point'             => '4',
                'comment'           => 'とてもよかったです',
            ]);
        }
        for ($i = 5; $i < 9; $i++) {
            Evaluation::create([
                'user_student_id'   => '3',
                'user_teacher_id'   => $i,
                'lesson_id'         => '1',
                'point'             => '3',
                'comment'           => 'まあまあよかったです。',
            ]);
        }
        for ($i = 10; $i < 12; $i++) {
            Evaluation::create([
                'user_student_id'   => '2',
                'user_teacher_id'   => $i,
                'lesson_id'         => '1',
                'point'             => '2',
                'comment'           => 'あまり良くなかったです。',
            ]);
        }
    }
}

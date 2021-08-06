<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 10; $i++) {
            Payment::create([
                'user_teacher_id' => 1,
                'user_student_id' => 2,
                'lesson_id' => 1,
                'status' => 1,
                'amount' => 300 * $i,
                'created_at' => '2021-03-0' . $i . '21:42:0' . $i
            ]);
        };
        for ($i = 1; $i < 10; $i++) {
            Payment::create([
                'user_teacher_id' => 1,
                'user_student_id' => 2,
                'lesson_id' => 1,
                'status' => 1,
                'amount' => 400 * $i,
                'created_at' => '2021-04-0' . $i . '21:42:0' . $i
            ]);
        };
        for ($i = 1; $i < 10; $i++) {
            Payment::create([
                'user_teacher_id' => 1,
                'user_student_id' => 2,
                'lesson_id' => 1,
                'status' => 1,
                'amount' => 500 * $i,
                'created_at' => '2021-05-0' . $i . '21:42:0' . $i
            ]);
        };
    }
}




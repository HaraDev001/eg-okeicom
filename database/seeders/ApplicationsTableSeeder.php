<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Seeder;

class ApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 10; $i++) {
            Application::create([
                'lesson_id'         => $i,
                'user_id'           => $i,
                'coupon_id'         => null,
                'status'            => 0,
                'cancel_id'         => null,
                'price'             => 1000,
                'coupon_price'      => 1,
                'cancel_price'      => ($i % 2) + 1,
            ]);
        }
        for ($i = 1; $i < 10; $i++) {
            Application::create([
                'lesson_id'         => $i,
                'user_id'           => $i + 1,
                'coupon_id'         => null,
                'status'            => 2,
                'cancel_id'         => null,
                'price'             => 1000,
                'coupon_price'      => 1,
                'cancel_price'      => ($i % 2) + 1,
            ]);
        }
    }
}

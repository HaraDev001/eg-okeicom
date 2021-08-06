<?php

namespace Database\Seeders;

use App\Models\Withdrawal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class WithdrawalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 10; $i++) {
            Withdrawal::create([
                'user_id'    => 1,
                // 'bank_type'  => 0,
                'bank_id'    => 1,
                'amount'     => 200 * $i,
                'fee'        => 40 * $i,
                'created_at' => '2021-03-0' . $i . '21:42:1' . $i
            ]);
        };
        for ($i = 1; $i < 10; $i++) {
            Withdrawal::create([
                'user_id'    => 1,
                // 'bank_type'  => 0,
                'bank_id'    => 1,
                'amount'     => 300 * $i,
                'fee'        => 60 * $i,
                'created_at' => '2021-04-0' . $i . '21:42:1' . $i
            ]);
        };
        for ($i = 1; $i < 10; $i++) {
            Withdrawal::create([
                'user_id'    => 1,
                // 'bank_type'  => 0,
                'bank_id'    => 1,
                'amount'     => 400 * $i,
                'fee'        => 80 * $i,
                'created_at' => '2021-05-0' . $i . '21:42:1' . $i
            ]);
        }
    }
}

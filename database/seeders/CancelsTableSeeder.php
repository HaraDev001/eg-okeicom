<?php

namespace Database\Seeders;

use App\Models\Cancel;
use Illuminate\Database\Seeder;

class CancelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 10; $i++) {
            Cancel::create([
                'application_id'    => 1,
                'user_id'           => $i+1,
                'status'            => 1,
                'reason'            => null,
                'approval_at'       => null,
            ]);
        }
    }
}

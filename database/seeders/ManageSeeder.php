<?php

namespace Database\Seeders;

use App\Models\Manage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('manages')->truncate();

        $datas = [
            [
                'name' => '管理者1',
                'email' => 'test1@test.com',
                'password' => 'password',
            ],
            [
                'name' => '株式会社アイリック',
                'email' => 'info@okeicom.com',
                'password' => 'irick0615',
            ],
        ];

        foreach($datas as $data) {
            $manage = new Manage();
            $manage->name = $data['name'];
            $manage->email = $data['email'];
            $manage->password = Hash::make($data['password']);
            $manage->save();
        }
    }
}

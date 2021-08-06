<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();

        $datas = [
            [
                'name' => 'ユーザー1',
                'email' => 'test1@test.com',
                'tel' => '00000000000',
                'password' => 'password',
                'account' => 'user1',
                'status' => 1,
                'is_teacher' => 1,
                'profile' => 'ユーザー1のプロフィール',
                'mailing' => '0',
            ],
            [
                'name' => 'ユーザー2',
                'email' => 'test2@test.com',
                'tel' => '00000000001',
                'password' => 'password',
                'account' => 'user2',
                'status' => 1,
                'is_teacher' => 1,
                'profile' => 'ユーザー2のプロフィール',
                'mailing' => '1',
            ],
            [
                'name' => 'ユーザー3',
                'email' => 'test3@test.com',
                'tel' => '00000000002',
                'password' => 'password',
                'account' => 'user3',
                'status' => 0,
                'is_teacher' => 0,
                'profile' => 'ユーザー3のプロフィール',
                'mailing' => '0',
            ],
        ];

        foreach($datas as $data) {
            $manage = new User();
            $manage->name = $data['name'];
            $manage->email = $data['email'];
            $manage->tel = $data['tel'];
            $manage->password = Hash::make($data['password']);
            $manage->account = $data['account'];
            $manage->status = $data['status'];
            $manage->is_teacher = $data['is_teacher'];
            $manage->profile = $data['profile'];
            $manage->mailing = $data['mailing'];
            $manage->save();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}

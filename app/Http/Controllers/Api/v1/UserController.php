<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Lesson;
use App\Models\Course;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ユーザー一覧を取得
        $users = User::all();
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $userNew = new User();
        // $user = $userNew->getTeachersShow($id);
        // return $user

        $user = User::find($id);
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        // 画像以外処理
        $user->update([
            // 'name'           => $request['name'],
            // 'country_id'     => $request['country_id'],
            // 'language_id'    => $request['language_id'],
            // 'prefecture_id'  => $request['prefecture_id'],
            'commition_rate' => number_format($request['commition_rate']),
            // 'email'          => $request['email'],
            // 'profile'        => $request['profile'],
            // 'category1_id'   => $request['categories'][0] ?? NULL,
            // 'category2_id'   => $request['categories'][1] ?? NULL,
            // 'category3_id'   => $request['categories'][2] ?? NULL,
            // 'category4_id'   => $request['categories'][3] ?? NULL,
            // 'category5_id'   => $request['categories'][4] ?? NULL,
        ]);
        // カテゴリー保存処理
        // $target = $user->saveCategories($request);
        // 画像保存処理
        $user->saveImgs($request);
        $user->save();
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lessons = Lesson::where('user_id', $id)->whereNull('deleted_at')->first();
        if($lessons) {
            return 'ユーザーに登録済みのレッスンがあるため、削除できません。';
        } else {
            User::find($id)->delete();
            return 'ユーザーの削除に成功しました。';
        }
    }
}

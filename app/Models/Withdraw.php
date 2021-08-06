<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Withdraw extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'reason',
    ];

    /**
     * 退会処理
     */
    public function executeWithdraw()
    {
        // 退会作成
        $user_id = Auth::user()->id;

        // 開講予定のレッスンがあった場合、削除不可にする（collection contains()メソッド）
        $lessons = User::find($user_id)->lessons;
        if($lessons->contains('status', '0')) {
            $error = '開講予定のレッスンが残っております。レッスンを削除してから退会を行ってください。';
            return $error;
        };

        // // 受講予定のレッスンがあった場合、削除不可にする
        $applications = User::find($user_id)->applications;
        if($applications->contains('status', '0')) {
            $error = '受講予定のレッスンが残っております。キャンセル手続きを行ってから退会を行ってください。';
            return $error;
        };

        $withdraw = new self();
        $withdraw->fill([
            'user_id' => Auth::user()->id,
        ])->save();

        // // 申込、自身の開始前レッスンの申込があればキャンセルに
        // $application = new Application();
        // $application->updateStatusByWithdraw();

        // // 自身の予定済みレッスンがあればキャンセルに
        // $lesson = new Lesson();
        // $lesson->updateStatusByWithdraw();

        // ログインユーザを削除
        $user = new User();
        $user->deleteLoggedUser();
    }
}

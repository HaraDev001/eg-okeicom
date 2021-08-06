<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_NORMAL = 0;            // 正常
    const STATUS_COMPLETION = 1;        // 終了済み
    const STATUS_CANCEL_STUDENT = 2;    // 生徒キャンセル（退会時も）
    const STATUS_CANCEL_TEACHER = 3;    // 講師キャンセル（退会時も）
    const STATUS_CANCEL_ADMIN = 4;      // 運営キャンセル

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lesson_id',
        'user_id',
        'coupon_id',
        'status',
        'cancel_id',
        'price',
        'coupon_price',
        'cancel_price',
    ];

    /**
     * 退会による申込状態の更新
     */
    public function applicationList()
    {
        return self::select([
                'applications.*',
                'users.id as user_id',
                'users.img as img',
                'users.name as name',
                'users.sex as sex',
                'prefectures.name as pref',
            ])
            ->whereIn('applications.status', [0,1])
            ->leftJoin('users', 'applications.user_id', '=', 'users.id')
            ->leftJoin('prefectures', 'users.prefecture_id', '=', 'prefectures.id')
            ->get();
    }

    /**
     * 退会による申込状態の更新
     */
    public function applicationListOfLesson($id)
    {
        return self::select([
                        'applications.*',
                        'users.id as user_id',
                        'users.img as img',
                        'users.name as name',
                        'users.sex as sex',
                        'prefectures.name as pref',
                    ])
                    ->where('applications.lesson_id', $id)
                    ->whereIn('applications.status', [0,1])
                    ->leftJoin('users', 'applications.user_id', '=', 'users.id')
                    ->leftJoin('prefectures', 'users.prefecture_id', '=', 'prefectures.id')
                    ->get();
    }

    /**
     * 退会による申込状態の更新
     */
    public function updateStatusByWithdraw() {
        // (受講者)正常な申込をキャンセルに
        Application::query()
            ->select(['applications.*'])
            ->where('applications.user_id', Auth::user()->id)
            ->where('applications.status', self::STATUS_NORMAL)
            ->update([
                'applications.status' => self::STATUS_CANCEL_STUDENT
            ]);

        // (講師)自身の開始前レッスンをキャンセルに
        Application::query()
            ->select(['applications.*'])
            ->join('lessons', 'applications.lesson_id', 'lessons.id')
            ->where('lessons.user_id', Auth::user()->id)
            ->where('applications.status', self::STATUS_NORMAL)
            ->update([
                'applications.status' => self::STATUS_CANCEL_STUDENT
            ]);
    }
}

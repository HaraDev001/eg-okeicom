<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;



class Cancel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'application_id',
        'user_id',
        'status',
        'reason',
        'approval_at',
    ];

    const STATUS_AUTO = 0;              // 24時間以前のキャンセル
    const STATUS_PENDING_TEACHER = 1;   // 講師承認待ち
    const STATUS_PENDING_ADMIN = 2;     // 運営承認待ち
    const STATUS_APPROVAL = 3;          // 講師承認済み
    const STATUS_DENIAL_TEACHER = 8;    // 講師非承認
    const STATUS_DENIAL_ADMIN = 9;      // 運営非承認

    /**
     * キャンセル申請中の件数を取得
     *
     * @param int $users_id
     * @return int
     */
    public function getCancelPendingCount(int $users_id)
    {
        return self::query()
            ->join('applications', 'cancels.application_id', '=', 'applications.id')
            ->join('lessons', 'applications.lesson_id', '=', 'lessons.id')
            ->where('lessons.user_id', $users_id)
            ->where('applications.status', Application::STATUS_NORMAL)
            ->whereIn('cancels.status', [self::STATUS_PENDING_TEACHER, self::STATUS_PENDING_ADMIN])
            ->count();
    }

    /**
     * 指定ユーザが持つレッスンのキャンセル申請を取得
     *
     * @param int $users_id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findByUsersId(int $users_id)
    {
        return self::query()
            ->select([
                'cancels.*',
                'users.name as users_name',
                'users.img as users_img',
                'lessons.id as lessons_id',
            ])
            ->join('applications', 'cancels.application_id', '=', 'applications.id')
            ->join('lessons', 'applications.lesson_id', '=', 'lessons.id')
            ->join('users', 'cancels.user_id', '=', 'users.id')
            ->where('lessons.user_id', $users_id)
            ->where('applications.status', Application::STATUS_NORMAL)
            ->whereIn('cancels.status', [self::STATUS_PENDING_TEACHER, self::STATUS_PENDING_ADMIN])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * 指定のキャンセルを承認
     *
     * @param int $id
     */
    public function approvalCancel(int $id) {
        // 申込をキャンセルに
        $application = Application::query()
                           ->select(['applications.*'])
                           ->join('lessons', 'applications.lesson_id', 'lessons.id')
                           ->join('cancels', 'applications.id', 'cancels.application_id')
                           ->where('cancels.id', $id)
                           ->where('lessons.user_id', Auth::user()->id)
                           ->first();
        $application->status = Application::STATUS_CANCEL_STUDENT;
        $application->save();

        // キャンセルを承認済みに
        $cancel = self::query()
            ->select(['cancels.*'])
            ->join('applications', 'cancels.application_id', '=', 'applications.id')
            ->join('lessons', 'applications.lesson_id', 'lessons.id')
            ->where('cancels.id', $id)
            ->where('lessons.user_id', Auth::user()->id)
            ->first();
        $cancel->status = self::STATUS_APPROVAL;
        $cancel->save();
    }

    /**
     * 指定のキャンセルを拒否
     *
     * @param int $id
     */
    public function rejectionCancel(int $id) {
        // キャンセルを非承認に
        $cancel = self::query()
                      ->select(['cancels.*'])
                      ->join('applications', 'cancels.application_id', '=', 'applications.id')
                      ->join('lessons', 'applications.lesson_id', 'lessons.id')
                      ->where('cancels.id', $id)
                      ->where('lessons.user_id', Auth::user()->id)
                      ->first();
        $cancel->status = self::STATUS_DENIAL_TEACHER;
        $cancel->save();
    }
}

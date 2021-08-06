<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Withdrawal;


class Payment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'application_id',
        'user_teacher_id',
        'user_student_id',
        'lesson_id',
        'amount',
        'status',
    ];

    /**
     * 保有金額をカンマ区切りにフォーマット
     *
     * @return string
     */
    public function getSeparateCommaAmountAttribute()
    {
        return '¥' . number_format($this->amount);
    }

    /**
     * 時点保有金額をカンマ区切りにフォーマット
     *
     * @return string
     */
    public function getSeparateCommaPointAmountAttribute()
    {
        return '¥' . number_format($this->point_amount);
    }

    /**
     * 決済金額を符号付きカンマ区切りにフォーマット
     *
     * @return string
     */
    public function getSeparateCommaPointAddSignAmountAttribute($value)
    {
        $sign = $this->add_sign_amount >= 0 ? '+' : '-';
        return $sign . '¥' . number_format(abs($this->add_sign_amount));
        // return $this->add_sign_amount * 2;
    }

    /**
     * 取引年月日をフォーマット
     *
     * @return string
     */
    public function getFormatedYmdCreatedAtAttribute()
    {
        return $this->created_at->format("Y年n月j日");
    }

    /**
     * 保有金額を取得
     *
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public function getHoldingAmount()
    {
        // ユーザーID
        $user_id = Auth::user()->id;
        // プラス金額を全て取得
        $query_plus_amount = self::where('user_teacher_id', $user_id)
            ->where('status', 1)
            ->sum('amount');

        // マイナス金額を全て取得
        $query_minus_amount = Withdrawal::where('user_id', $user_id)
            ->sum('amount');

        return intval($query_plus_amount) - intval($query_minus_amount);


        // // プラス金額(レッスンを購入された履歴)を取得
        // $user_id = Auth::user()->id;
        // $query_plus_amount = self::query()
        //     ->select([
        //         DB::raw('1 as id'),
        //         DB::raw('sum(amount) as sum_amount')
        //     ])
        //     ->where('payments.user_teacher_igetMonthsd', $user_id)
        //     ->groupBy([
        //         'payments.id',
        //     ]);

        // // マイナス金額(レッスンを購入したor出金した履歴)とプラス金額をUNION ALLで取得
        // $query_amount = Withdrawal::query()
        //     ->select([
        //         DB::raw('max(withdrawals.id) as id'),
        //         DB::raw('sum(amount) * -1 as sum_amount')
        //     ])
        //     ->where('withdrawals.user_id', $user_id)
        //     ->groupBy([
        //         'withdrawals.user_id',
        //     ])
        //     ->unionAll($query_plus_amount);

        // // 総保有金額を取得
        // return self::query()
        //     ->select([
        //         DB::raw('sum(amounts.sum_amount) as amount')
        //     ])
        //     ->joinSub($query_amount, 'amounts', function ($join) {
        //         $join->on('payments.id', '=', 'amounts.id');
        //     })
        //     ->first();
    }

    /**
     * 取引月を取得
     *
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public function getMonths()
    {
        return self::query()
            ->select([
                DB::raw("CONCAT(DATE_FORMAT(payments.created_at, '%Y%m'), '01') as months")
            ])
            ->orWhere('payments.user_teacher_id', Auth::user()->id)
            ->orWhere('payments.user_student_id', Auth::user()->id)
            ->groupByRaw(
                "CONCAT(DATE_FORMAT(payments.created_at, '%Y%m'), '01')",
            )
            ->orderByRaw('1 desc')
            ->get();
    }

    /**
     * 取引詳細を取得
     *
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public function getDetail($start_date = null, $end_date = null)
    {
        // $details = self::query()
        //     ->select([
        //         'payments.*',
        //         'lessons.title as lessons_title'
        //     ])
        //     ->leftJoin('applications', 'payments.application_id', '=', 'applications.id')
        //     ->leftJoin('lessons', 'applications.lesson_id', '=', 'lessons.id')
        //     // ->where(function ($query) {
        //     //     $query->orWhere('payments.user_teacher_id', Auth::user()->id)
        //     //           ->orWhere('payments.user_student_id', Auth::user()->id);
        //     // })
        //     ->where('payments.user_teacher_id', Auth::user()->id)
        //     ->orderBy('payments.created_at')
        //     ->get();
        $user_id = Auth::user()->id;

        // 出金履歴一覧
        $withdraw = Withdrawal::query()
            ->select([
                'withdrawals.amount AS amount',
                'withdrawals.created_at AS created_at',
                DB::raw("'出金' AS lessons_title"),
            ])
            ->where(function ($query) use ($user_id, $start_date, $end_date) {
                if ($start_date != null && $end_date != null) {
                    return $query->where('withdrawals.user_id', $user_id)
                                ->whereDate('created_at', '>=', $start_date)
                                ->whereDate('created_at', '<=', $end_date) ;
                }
                else{
                    return $query->where('withdrawals.user_id', $user_id);
                }
            })

            // 受け取り履歴一覧と出金リクエスト一覧を結合させる
            ->orderBy('created_at', 'desc');
        // 受け取り履歴一覧（キャンセルされたもの以外）
        $details = self::query()
            ->select([
                'payments.amount AS amount',
                'payments.created_at AS created_at',
                'lessons.title AS lessons_title',
            ])
            ->where(function ($query) use ($user_id, $start_date, $end_date) {
                if ($start_date != null && $end_date != null) {
                    return $query->where([
                                    ['user_teacher_id', '=', $user_id],
                                    ['payments.status', '=', 1],
                                ])
                                ->whereDate('payments.created_at', '>=', $start_date)
                                ->whereDate('payments.created_at', '<=', $end_date) ;
                }
                else{
                    return $query->where([
                        ['user_teacher_id', '=', $user_id],
                        ['payments.status', '=', 1],
                    ]);
                }
            })
            ->unionAll($withdraw)
            ->leftJoin('applications', 'payments.application_id', '=', 'applications.id')
            ->leftJoin('lessons', 'applications.lesson_id', '=', 'lessons.id')
            ->orderBy('created_at', 'asc')
            ->get();
        // 出金リクエスト一覧
        // $details = DB::table('withdrawals')

        // 保有金額が0からスタート
        $wk_point_amount = 0;
        foreach ($details as $detail) {
            // // 取引時点の保有金額情報を付加
            // $detail->point_amount = $wk_point_amount;
            // // 先生なら＋、生徒ならーseparateCommaPoint
            // $detail->add_sign_amount = Auth::user()->id == $detail->user_teacher_id ? $detail->amount : $detail->amount * -1;
            // $wk_point_amount += $detail->add_sign_amount;

            // 取引時点の保有金額情報を付加
            // $detail->point_amount = $wk_point_amount;
            // $detail->add_sign_amount = $detail->lessons_title == '出金' ? $detail->amount * -1 : $detail->amount;
            // $wk_point_amount += $detail->add_sign_amount;

            $detail->point_amount = $wk_point_amount;
            $detail->point_amount += $detail->lessons_title == '出金' ? $detail->amount * -1 : $detail->amount;
            // $detail->point_amount = $wk_point_amount;
            $detail->add_sign_amount = $detail->lessons_title == '出金' ? $detail->amount * -1 : $detail->amount;
            $wk_point_amount += $detail->add_sign_amount;
        }

        return $details->reverse();
    }

    /**
     * 決済確定処理
     *
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public function settlementConfirmed($user_id)
    {
        // $payments = self::where('id', '=', $user_id)
        //     ->where('status', '=', 0)
        //     ->get();
        // foreach($payments as $payment) {
        //     //
        // }
    }
}

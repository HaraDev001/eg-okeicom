<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Withdrawal extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'bank_id',
        'amount',
        'fee',
        'verified_at',
    ];

    /**
     * 取引履歴を取得する
     *
     *
     * @return string
     */
    public function withdrawalList()
    {
        // DB::table('withdrawals')->create([
        return Withdrawal::select([
            'withdrawals.*',
            'users.id as user_id',
            'users.account as user_account',
            'banks.type as bank_type',
            'banks.number as bank_number',
            'banks.name as bank_name',
            'bank_japans.mark as japan_mark',
            'bank_others.financial_name as financial_name',
            'bank_others.branch_name as branch_name',
            'bank_others.branch_number as branch_number',
            'bank_others.other_type as other_type',
        ])
        ->leftJoin('users', 'withdrawals.user_id', '=', 'users.id')
        ->leftJoin('banks', 'withdrawals.bank_id', '=', 'banks.id')
        ->leftJoin('bank_japans', 'banks.id', '=', 'bank_japans.bank_id')
        ->leftJoin('bank_others', 'banks.id', '=', 'bank_others.bank_id')
        ->get();
        // $withdrawal = new Withdrawal();
        // $withdrawal::create([
        //     'user_id'   => $userId,
        //     'bank_id'   => $id,
        //     'amount'    => Session::get('holding_amount'),
        //     'fee'       => Session::get('fee'),
        // ]);
    }

    /**
     * 取引履歴を登録する
     *
     *
     * @return string
     */
    public function store($id, $userId)
    {
        // DB::table('withdrawals')->create([
        $withdrawal = new Withdrawal();
        $withdrawal::create([
            'user_id'   => $userId,
            'bank_id'   => $id,
            'amount'    => Session::get('holding_amount'),
            'fee'       => Session::get('fee'),
        ]);
    }
}

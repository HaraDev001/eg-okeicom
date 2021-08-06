<?php

namespace App\Models;

use App\Models\BankJapan;
use App\Models\BankOther;
use App\Models\Cancel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'type',
        'number',
        'name',
    ];

    protected $with = ['bankOther', 'bankJapan'];

    /**
     * 銀行に関連しているその他銀行情報
     */
    public function bankOther()
    {
        return $this->hasOne(BankOther::class);
    }

    /**
     * 銀行に関連しているその他銀行情報
     */
    public function bankJapan()
    {
        return $this->hasOne(BankJapan::class);
    }

    /**
      * 銀行情報を取得する
      */
    public function showBank($id)
    {
        return self::select([
                'banks.*',
                'bank_japans.mark as japan_mark',
                'bank_others.financial_name as financial_name',
                'bank_others.branch_name as branch_name',
                'bank_others.branch_number as branch_number',
                'bank_others.other_type as other_type',
            ])
            ->where('user_id', $id)
            ->whereNull('banks.deleted_at')
            ->leftJoin('bank_japans', 'banks.id', 'bank_japans.bank_id')
            ->leftJoin('bank_others', 'banks.id', 'bank_others.bank_id')
            ->first();
    }

    /**
      * 銀行情報を登録する（既にあれば削除する）
      */
    public function storeBank($banks, $userId)
    {
        DB::beginTransaction();
        try {
          // 前の銀行情報を物理削除
          $oldBank = Bank::where('user_id' ,$userId)->first();
          if($oldBank) {
              $oldBankId = $oldBank->id;
              // ゆうちょの銀行情報
              if($oldBank->type === 'japan') {
                  BankJapan::where('bank_id', $oldBankId)->delete();
              // その他の銀行情報
              } else if($oldBank->type === 'other') {
                  BankOther::where('bank_id', $oldBankId)->delete();
              }
              $oldBank->delete();
          }
          // 新しく銀行情報を登録する
          $bankNew = new Bank();
          if(isset($banks['yucho_mark'])) {
              // 銀行テーブル登録
              $bankLast = $bankNew::create([
                  'user_id' => $userId,
                  'type' 		=> 'japan',
                  'number'  => $banks['yucho_number'],
                  'name'    => $banks['yucho_name'],
              ]);
              $lastId = $bankLast->id;

              // ゆうちょテーブル登録
              $bankJapanNew = new BankJapan();
              $bankJapanNew::create([
                  'bank_id'  => $lastId,
                  'mark'     => $banks['yucho_mark'],
              ]);
              DB::commit();
              return $lastId;
          } else if(isset($banks['other_financial_name'])) {
              // 銀行テーブル登録
              $bankLast = $bankNew::create([
                'user_id' => $userId,
                'type' 		=> 'other',
                'number'  => $banks['other_number'],
                'name'    => $banks['other_name'],
              ]);
              $lastId = $bankLast->id;

              // その他テーブル登録
              $bankNewOther = new BankOther();
              $bankNewOther::create([
                  'bank_id'        => $lastId,
                  'financial_name' => $banks['other_financial_name'],
                  'branch_name'    => $banks['other_branch_name'],
                  'branch_number'  => $banks['other_branch_number'],
                  'other_type'     => $banks['other_type'],
              ]);
              DB::commit();
              return $lastId;
          }
          DB::rollBack();
          $error = '不明のエラーです。管理者へお問い合わせください。';
          return $error;
        } catch (\Exception $e) {
          DB::rollBack();
          $error = '銀行情報の登録に失敗しました。再度ご登録をお願いいたします。';
          return $error;
        }

    }
}

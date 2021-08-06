<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OthersBank extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['created_at', 'updated_at'];


    /**
     * その他銀行情報を登録する
     *
     *
     * @return string
     */
    public function registerOtherBank($params, $id)
    {
        $others_bank = new OthersBank();
        $others_bank::create([
            'user_id'           => $id,
            'financial_name'    => $params->other_financial_name,
            'branch_name'       => $params->other_branch_name,
            'branch_number'     => $params->other_branch_number,
            'type'              => $params->other_type,
            'number'            => $params->other_number,
            'name'              => $params->other_name,
        ]);
    }
}

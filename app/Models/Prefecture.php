<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * 全カテゴリを取得。オプションで「全て」を追加
     *
     * @param $is_add_option
     * @return mixed
     */
    public function getAll($is_add_option = false)
    {
        $prefectures = Prefecture::all();
        if ($is_add_option) {
            $add_prefecture = new Prefecture();
            $prefectures = $prefectures->prepend( $add_prefecture );
        }
        return $prefectures;
    }
}

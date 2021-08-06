<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
        $categories = Category::all();
        if ($is_add_option) {
            $add_category = new Category();
            $add_category->id  = 0;
            $add_category->name = '全て';
            $categories = $categories->prepend( $add_category );
        }
        return $categories;
    }

}

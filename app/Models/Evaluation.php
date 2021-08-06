<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Evaluation extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_student_id',
        'user_teacher_id',
        'url',
        'lesson_id',
        'point',
        'comment',
    ];

    /**
     * 講師の評価一覧
     *
     * @param Builder $query
     * @param [integer] $id
     * @return Builder
     */
    public function index($id)
    {
        return self::query()
            ->where('user_teacher_id', '=', $id)
            ->join('users', 'evaluations.user_student_id', '=', 'users.id');
    }

}

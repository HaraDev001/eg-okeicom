<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'detail',
        'category1_id',
        'category2_id',
        'category3_id',
        'category4_id',
        'category5_id',
        'img1',
        'img2',
        'img3',
        'img4',
        'img5',
    ];


    /**
     * コース一覧
     *
     * @param $users_id
     * @param $params
     * @int $status
     */
    public function courseList()
    {
        return Course::select([
            'courses.*',
            'categories1.name as category1_name',
            'categories2.name as category2_name',
            'categories3.name as category3_name',
            'categories4.name as category4_name',
            'categories5.name as category5_name',
            'users.name as user_name',
            'users.id as user_id',
        ])
        ->join('users', 'courses.user_id', '=', 'users.id')
        ->leftJoin('categories as categories1', 'courses.category1_id', '=', 'categories1.id')
        ->leftJoin('categories as categories2', 'courses.category2_id', '=', 'categories2.id')
        ->leftJoin('categories as categories3', 'courses.category3_id', '=', 'categories3.id')
        ->leftJoin('categories as categories4', 'courses.category4_id', '=', 'categories4.id')
        ->leftJoin('categories as categories5', 'courses.category5_id', '=', 'categories5.id')
        ->whereNull('courses.deleted_at')
        // ->where('lessons.status', $status)
        ->orderBy('courses.created_at', 'desc')
        // ->paginate(20);
        ->get();
    }

    /**
     * リレーションシップ：レッスン
     *
     * @param $users_id
     * @param $params
     * @int $status
     */
    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }

    /* Base / get~~~Index, get~~~Show, get~~~Delete, get~~~Update
    --------------------------------------------------------------------------------------------------*/
    /**
     * 指定ステータスのコース全件検索
     *
     * @param $users_id
     * @param $params
     * @int $status
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findByUsersId(int $users_id, int $status)
    {
        $course = new Course();
        $lessonCounts = $course->getRelationCourseLessonCounts();
        // コースごとのレッスン数を取得
        return self::query()
            ->select([
                'courses.*',
                'categories1.name as category1_name',
                'categories2.name as category2_name',
                'categories3.name as category3_name',
                'categories4.name as category4_name',
                'categories5.name as category5_name',
            ])
            ->join('users', 'courses.user_id', '=', 'users.id')
            ->leftJoin('categories as categories1', 'courses.category1_id', '=', 'categories1.id')
            ->leftJoin('categories as categories2', 'courses.category2_id', '=', 'categories2.id')
            ->leftJoin('categories as categories3', 'courses.category3_id', '=', 'categories3.id')
            ->leftJoin('categories as categories4', 'courses.category4_id', '=', 'categories4.id')
            ->leftJoin('categories as categories5', 'courses.category5_id', '=', 'categories5.id')
            // ->leftJoinSub($lessonCounts, 'lessons', 'courses.id', 'lessons.course_id')
            ->leftJoinSub($lessonCounts, 'courses', function($join) {
                $join->on('courses.course_id', '=', 'courses.id');
            })
            // ->leftJoin($lessonCounts, 'courses.id', '=', 'course_id')
            // ->lestJoin($lessonCounts, 'courses', function($join) {
            //     $join->on('courses.course_id', '=', 'courses.id');
            // })
            ->where('courses.user_id', $users_id)
            // ->where('lessons.status', $status)
            ->orderBy('courses.created_at', 'desc')
            // ->paginate(20);
            ->paginate(Config::get('const.paginate.lesson'));
    }

    /**
     * コースの画像一覧を取得する
     * @return array
     */
    public function courseImgLists($id)
    {
        // ID指定のコース情報を取得
        $target = Course::query()->find($id);
        return $target->only('img1', 'img2', 'img3', 'img4', 'img5');
    }

    /**
     * カテゴリー名を取得
     * @return string
     */
    public function getCategoryNameAttribute()
    {
        if ($this['category1_id'] == null) {
            return "";
        } else {
            return Category::query()->find($this['category1_id'])['name'];
        }
    }

    /**
     * 画像1の公開パスを取得
     * @return string
     */
    public function getPublicPathImg1Attribute()
    {
        return $this->createCoursePublicPath($this->img1);
    }

    /**
     * 画像2の公開パスを取得
     * @return string
     */
    public function getPublicPathImg2Attribute()
    {
        return $this->createCoursePublicPath($this->img2);
    }

    /**
     * 画像3の公開パスを取得
     * @return string
     */
    public function getPublicPathImg3Attribute()
    {
        return $this->createCoursePublicPath($this->img3);
    }

    /**
     * 画像4の公開パスを取得
     * @return string
     */
    public function getPublicPathImg4Attribute()
    {
        return $this->createCoursePublicPath($this->img4);
    }

    /**
     * 画像5の公開パスを取得
     * @return string
     */
    public function getPublicPathImg5Attribute()
    {
        return $this->createCoursePublicPath($this->img5);
    }

    /**
     * コース画像の公開パスを生成
     *
     * @param string $img
     * @return string
     */
    public function createCoursePublicPath($img)
    {
        if ($img) {
            return '/storage/courses/' . $img;
        } else {
            return '';
        }
    }

    /**
     * 設定されているカテゴリーを配列で取得する
     * @return array
     */
    public function getArrayConfiguredCategoriesAttribute()
    {
        return [
            $this->category1_id,
            $this->category2_id,
            $this->category3_id,
        ];
    }

    /**
     * 画像保存判定。作成or削除or変更なし
     */
    public function saveImgs($request)
    {
        // 画像1
        if ($request->hasFile('img1')) {
            $this->img1 = basename(Storage::putFile(Config::get('const.image_path.course'), $request->file('img1')));
        } elseif($request->img1_del == 1) {
            Storage::delete(Config::get('const.image_path.course') . '/' . $this->img1);
            $this->img1 = null;
        }
        // 画像2
        if ($request->hasFile('img2')) {
            $this->img2 = basename(Storage::putFile(Config::get('const.image_path.course'), $request->file('img2')));
        } elseif($request->img2_del == 1) {
            Storage::delete(Config::get('const.image_path.course') . '/' . $this->img2);
            $this->img2 = null;
        }
        // 画像3
        if ($request->hasFile('img3')) {
            $this->img3 = basename(Storage::putFile(Config::get('const.image_path.course'), $request->file('img3')));
        } elseif($request->img3_del == 1) {
            Storage::delete(Config::get('const.image_path.course') . '/' . $this->img3);
            $this->img3 = null;
        }
        // 画像4
        if ($request->hasFile('img4')) {
            $this->img4 = basename(Storage::putFile(Config::get('const.image_path.course'), $request->file('img4')));
        } elseif($request->img4_del == 1) {
            Storage::delete(Config::get('const.image_path.course') . '/' . $this->img4);
            $this->img4 = null;
        }
        // 画像5
        if ($request->hasFile('img5')) {
            $this->img5 = basename(Storage::putFile(Config::get('const.image_path.course'), $request->file('img5')));
        } elseif($request->img5_del == 1) {
            Storage::delete(Config::get('const.image_path.course') . '/' . $this->img5);
            $this->img5 = null;
        }
    }

    /**
     * カテゴリーの保存
     *
     * @param array $data
     */
    public function saveCategories($request) {
        $this->category1_id = array_key_exists(0, $request->categories) ? (int)$request->categories[0] : null;
        $this->category2_id = array_key_exists(1, $request->categories) ? (int)$request->categories[1] : null;
        $this->category3_id = array_key_exists(2, $request->categories) ? (int)$request->categories[2] : null;
        $this->category4_id = array_key_exists(3, $request->categories) ? (int)$request->categories[3] : null;
        $this->category5_id = array_key_exists(4, $request->categories) ? (int)$request->categories[4] : null;
    }

    /**
     * 画像削除
     */
    public function deleteImgs()
    {
        if ($this->img1) {
            if(!$this->img1 == 'no-image-course.png') {
                Storage::delete(Config::get('const.image_path.course') . '/' . $this->img1);
            }
        }
        if ($this->img2) {
            Storage::delete(Config::get('const.image_path.course') . '/' . $this->img2);
        }
        if ($this->img3) {
            Storage::delete(Config::get('const.image_path.course') . '/' . $this->img3);
        }
        if ($this->img4) {
            Storage::delete(Config::get('const.image_path.course') . '/' . $this->img4);
        }
        if ($this->img5) {
            Storage::delete(Config::get('const.image_path.course') . '/' . $this->img5);
        }
    }

    /* Relationships / getRelation~~~
    --------------------------------------------------------------------------------------------------*/
    /**
     * 指定コースのレッスン数を取得
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getRelationCourseLessonCounts()
    {
        // 1.IDごとのレッスンを取得（集計関数 count）
        return Lesson::query()
            ->select(
                'lessons.course_id',
                DB::raw('COUNT(lessons.course_id) AS course_counts'),
            )
            ->join('courses', 'lessons.course_id', '=', 'courses.id')
            // 2.ID属性によって
            // 2.course idごとにgroup byする
            ->groupBy('lessons.course_id');
    }

    /* Query methods / getQuery~~~
    --------------------------------------------------------------------------------------------------*/



    /* Scope / scopeOf~~~
    --------------------------------------------------------------------------------------------------*/


    /* Accessors and mutators / get~~~Attribute / ~~~
    --------------------------------------------------------------------------------------------------*/

    /* Other /
    --------------------------------------------------------------------------------------------------*/

}

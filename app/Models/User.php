<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const STATUS_STUDENT = 0;
    const STATUS_TEACHER = 1;
    const SEX_UNKNOWN = 0;
    const SEX_MALE = 1;
    const SEX_FEMALE = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'account',
        'status',
        'sex',
        'tel',
        'age',
        'country_id',
        'prefecture_id',
        'language_id',
        'img',
        'profile',
        'mailing',
        'commition_rate',
        // 'bank_type',
        // 'bank_id',
        // 'credit_id',
        'category1_id',
        'category2_id',
        'category3_id',
        'category4_id',
        'category5_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 日付を変形する属性
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * リレーション：ユーザーのコース一覧
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    /**
     * リレーション：ユーザーのレッスン一覧
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->with('course');
    }

    /**
     * 条件検索した講師一覧を取得
     *
     * @param $value
     * @return array
     */
    public function searchTeacher($params)
    {
        // パラメーターを設定
        // null型演算子
        $is_sort       = $params['sort_param'] ?? '';
        $is_categories = $params['categories_id'] ?? '';
        $is_sex        = $params['is_sex'] ?? '';
        $is_keyword    = $params['keyword'] ?? '';

        // 評価の計算結果
        $evaluations   = $this->getTeachersPointQuery();

        // 条件ユーザー一覧をリターン
        return self::query()
            ->where('is_teacher', 1)
            ->ofSortParam($is_sort)
            ->ofCategoryId($is_categories)
            ->ofUserSex($is_sex)
            ->ofSearchKeyword($is_keyword)
            ->leftJoinSub($evaluations, 'evaluations', function ($join) {
                $join->on('users.id', '=', 'evaluations.user_teacher_id');
            })
            ->select([
                'users.*',
                'evaluations.avg_point as evaluations_avg_point',
                'evaluations.count as count',
            ]);
    }

    /**
     * Scopeによる絞り込み：ソート機能
     *
     * @param Builder $query
     * @param [integer] $key
     * @return Builder
     */
    public function scopeOfSortParam(Builder $query, $key)
    {
        // desc（3, 2, 1）
        // asc（1, 2, 3）
        if (blank($key)) return;
        if ($key == 'new') {
            return $query->orderby('users.created_at', 'desc');
        } elseif($key == 'evaluation') {
            return $query->orderBy('evaluations_avg_point', 'desc');
        }
    }

    /**
     * Scopeによる絞り込み：カテゴリー
     *
     * @param Builder $query
     * @param [integer] $key
     * @return Builder
     */
    public function scopeOfCategoryId(Builder $query, $key)
    {
        if (blank($key)) return;
        return $query->when($key > 0, function ($query) use ($key) {
            $query->where(function ($query) use ($key) {
                $query->orwhere('users.category1_id', '=', $key)
                    ->orwhere('users.category2_id', '=', $key)
                    ->orwhere('users.category3_id', '=', $key)
                    ->orwhere('users.category4_id', '=', $key)
                    ->orwhere('users.category5_id', '=', $key);
            });
        });
        // return $query->where(function ($query) use ($key) {
        //     $query->orwhere('users.category1_id', '=', $key)
        //         ->orwhere('users.category2_id', '=', $key)
        //         ->orwhere('users.category3_id', '=', $key)
        //         ->orwhere('users.category4_id', '=', $key)
        //         ->orwhere('users.category5_id', '=', $key);
        // });
    }

    /**
     * Scopeによる絞り込み：性別
     *
     * @param Builder $query
     * @param [integer] $key
     * @return Builder
     */
    public function scopeOfUserSex(Builder $query, $key)
    {
        if (blank($key)) return;
        if ($key == 'man') {
            return $query->where('users.sex', 'LIKE', '%1%');
        } elseif ($key == 'female') {
            return $query->where('users.sex', 'LIKE', '%2%');
        } else {
            return $query;
        }
    }

    /**
     * Scopeによる絞り込み：性別
     *
     * @param Builder $query
     * @param [integer] $key
     * @return Builder
     */
    public function scopeOfSearchKeyword(Builder $query, $key)
    {
        if (blank($key)) return;
        if (isset($key)) {
            return $query->where(function ($query) use ($key) {
                    $query->orwhere('users.name', 'like', '%'.$key.'%')
                        ->orWhere('users.profile','like','%'.$key.'%');
            });
        }
    }

    /**
     * 講師詳細
     *
     */
    public function show($id)
    {
        $teacher_number = Evaluation::query()
            ->select(
                'evaluations.user_teacher_id',
                DB::raw("count('user_teacher_id') as reviews"),
                DB::raw("avg('user_teacher_id') as avg_point"),
            )
            ->groupBy('evaluations.user_teacher_id');

        return self::query()
            ->select([
                'users.*',
                'evaluations.reviews as reviews',
                'evaluations.avg_point as evaluations_avg_point',
            ])
            ->leftJoinSub($teacher_number, 'evaluations', function ($join) {
                $join->on('users.id', '=', 'evaluations.user_teacher_id');
            })
            ->where('users.id', '=', $id);
    }

    /**
     * 現在の状態名称リストを連想配列で取得
     *
     * @return array
     */
    public static function getArrayStatuses()
    {
        return [
            self::STATUS_STUDENT => __('UserStatusStudent'),
            self::STATUS_TEACHER => __('UserStatusTeacher'),
        ];
    }

    /**
     * 性別の名称リストを連想配列で取得
     *
     * @return array
     */
    public static function getArraySexes()
    {
        return [
            self::SEX_UNKNOWN => __('UserSexUnknown'),
            self::SEX_MALE => __('UserSexMale'),
            self::SEX_FEMALE => __('UserSexFemale'),
        ];
    }

    /**
     * プロフィール画像保存処理
     */
    public function saveImgs($request)
    {
        if ($request->hasFile('img')) {
            if ($request->file('img')->isValid()) {
                $this->img = basename(Storage::putFile(Config::get('const.image_path.profile'), $request->file('img')));
            }
        }
    }

    /* アクセサ get~~~Attribute
    ------------------------------------------------------------------------------------------------------*/
    /**
     * 性別の名称を取得
     *
     * @param $value
     * @return array
     */
    public function getSexNameAttribute()
    {
        $sex_name = '';
        switch ($this['sex']) {
            case self::SEX_UNKNOWN:
                $sex_name = __('UserSexUnknown');
                break;
            case self::SEX_MALE:
                $sex_name =  __('UserSexMale');
                break;
            case self::SEX_FEMALE:
                $sex_name =  __('UserSexFemale');
                break;
        }
        return $sex_name;
    }

    /**
     * 講師の評価値を少数第一までにフォーマット
     * @return string
     */
    public function getRoundAvgPointAttribute()
    {
        return round($this->evaluations_avg_point, 1);
    }

    /**
     * プロフィール画像の公開パスを取得
     * @return string
     */
    public function getPublicPathImgAttribute()
    {
        return $this->createProfilePublicPath($this->img);
    }

    /**
     * プロフィール画像の公開パスを生成
     *
     * @param string $img
     * @return string
     */
    public function createProfilePublicPath($img)
    {
        if ($img) {
            return '/storage/profile/' . $img;
        } else {
            return '';
        }
    }

    /**
     * 講師の評価値を取得するクエリを取得
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getTeachersPointQuery()
    {
        // 講師別の評価値を集計
        return Evaluation::query()
            ->select(
                'evaluations.user_teacher_id',
                DB::raw('avg(evaluations.point) as avg_point'),
                DB::raw('count(evaluations.user_teacher_id) as count')
            )
            ->groupBy('evaluations.user_teacher_id');
    }

    /**
     * 講師のコース一覧を取得する
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getTeachersCourseQuery()
    {
        // 講師別の評価値を集計
        return Course::query()
            ->select(
                'courses.user_id'
            )
            ->groupBy('courses.user_id');
    }

    /**
     * 指定レッスンの参加者一覧取得
     *
     * @param int $users_id
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findByLessonsId(int $lessons_id, int $users_id)
    {
        return self::query()
            ->select([
                'users.*',
                'prefectures.name as prefectures_name',
            ])
            ->join('applications', 'users.id', '=', 'applications.user_id')
            ->join('lessons', 'applications.lesson_id', '=', 'lessons.id')
            ->leftJoin('prefectures', 'users.prefecture_id', '=', 'prefectures.id')
            ->where('lessons.user_id', $users_id)
            ->where('applications.lesson_id', $lessons_id)
            ->orderBy('applications.created_at', 'desc')
            ->get();
    }

    /**
     * ログイン中のユーザ削除
     *
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function deleteLoggedUser()
    {
        return self::query()->find(Auth::user()->id)->delete();
    }

    /**
     * 高評価の講師を取得
     *
     * @param int $users_id
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getPopularTeachers()
    {
        // 講師別の評価値を集計
        $evaluations = $this->getTeachersPointQuery();

        return self::query()
            ->select([
                'users.*',
                'categories1.name as category1_name',
                'categories2.name as category2_name',
                'categories3.name as category3_name',
                'categories4.name as category4_name',
                'categories5.name as category5_name',
                'evaluations.avg_point as evaluations_avg_point',
            ])
            ->leftJoin('categories as categories1', 'users.category1_id', '=', 'categories1.id')
            ->leftJoin('categories as categories2', 'users.category2_id', '=', 'categories2.id')
            ->leftJoin('categories as categories3', 'users.category3_id', '=', 'categories3.id')
            ->leftJoin('categories as categories4', 'users.category4_id', '=', 'categories4.id')
            ->leftJoin('categories as categories5', 'users.category5_id', '=', 'categories5.id')
            ->leftJoinSub($evaluations, 'evaluations', function ($join) {
                $join->on('users.id', '=', 'evaluations.user_teacher_id');
            })
            ->where('is_teacher', 1)
            // ->whereExists(function ($query) {
            //     $query->select(DB::raw(1))
            //         ->from('lessons')
            //         ->whereRaw('lessons.user_id = users.id');
            // })
            ->orderByDesc('evaluations.avg_point')
            ->orderBy('users.created_at')
            ->limit(Config::get('const.top_thumbnail_count'))
            ->get();
    }

    /**
     * 新着講師を取得
     *
     * @param int $users_id
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getNewArrivalTeachers()
    {
        // 講師別の評価数を集計
        $evaluations = $this->getTeachersPointQuery();

        return self::query()
            ->select([
                'users.*',
                'categories1.name as category1_name',
                'categories2.name as category2_name',
                'categories3.name as category3_name',
                'categories4.name as category4_name',
                'categories5.name as category5_name',
                'evaluations.avg_point as evaluations_avg_point',
            ])
            ->leftJoin('categories as categories1', 'users.category1_id', '=', 'categories1.id')
            ->leftJoin('categories as categories2', 'users.category2_id', '=', 'categories2.id')
            ->leftJoin('categories as categories3', 'users.category3_id', '=', 'categories3.id')
            ->leftJoin('categories as categories4', 'users.category4_id', '=', 'categories4.id')
            ->leftJoin('categories as categories5', 'users.category5_id', '=', 'categories5.id')
            ->leftJoinSub($evaluations, 'evaluations', function ($join) {
                $join->on('users.id', '=', 'evaluations.user_teacher_id');
            })
            ->where('is_teacher', 1)
            // ->whereExists(function ($query) {
            //     $query->select(DB::raw(1))
            //         ->from('lessons')
            //         ->whereRaw('lessons.user_id = users.id');
            // })
            ->orderByDesc('users.created_at')
            ->limit(Config::get('const.top_thumbnail_count'))
            ->get();
    }

    /**
     * 講師一覧
     *
     * @param int $categories_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getTeachersList($sex=null,$category_id=null)
    {
        // 講師別の評価値を集計
        $evaluations = $this->getTeachersPointQuery();

       //講師のみ
        $query = self::query()
            ->select([
                'users.*',
                'categories1.name as category1_name',
                'categories2.name as category2_name',
                'categories3.name as category3_name',
                'categories4.name as category4_name',
                'categories5.name as category5_name',
                'evaluations.avg_point as evaluations_avg_point',
            ])
            ->where('is_teacher', 1)
            ->leftJoin('categories as categories1', 'users.category1_id', '=', 'categories1.id')
            ->leftJoin('categories as categories2', 'users.category2_id', '=', 'categories2.id')
            ->leftJoin('categories as categories3', 'users.category3_id', '=', 'categories3.id')
            ->leftJoin('categories as categories4', 'users.category4_id', '=', 'categories4.id')
            ->leftJoin('categories as categories5', 'users.category5_id', '=', 'categories5.id')
            ->leftJoinSub($evaluations, 'evaluations', function ($join) {
                $join->on('users.id', '=', 'evaluations.user_teacher_id');
            }); // 講師のみ
            // ->where('status',User::STATUS_TEACHER);//講師のみ

        //性別があれば性別で絞込
        if($sex){
            $query->where("sex",$sex);
        }
        //カテゴリがーあればor検索
        if($category_id){
            $query->where(function($query) use($category_id){
                $query->where('category1_id', '=', $category_id)
                    ->orWhere('category2_id', '=', $category_id)
                    ->orWhere('category3_id', '=', $category_id)
                    ->orWhere('category4_id', '=', $category_id)
                    ->orWhere('category5_id', '=', $category_id);
            });
        }
        //並び順取得
        $order=session('order',0);
        $tmp=["id","desc"];
        if($order==1){
            $tmp=["evaluations_avg_point","desc"];
        }
        return $query->orderBy($tmp[0],$tmp[1])->paginate(Config::get('const.paginate.teacher'));
    }

    /**
     * 講師詳細
     *
     * @param int $categories_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getTeachersShow($user_id)
    {
        // 講師別の評価値を集計
        $evaluations = $this->getTeachersPointQuery();

        //講師詳細
        return self::query()
            ->where('users.id', $user_id)
            ->select([
                'users.*',
                'categories1.name as category1_name',
                'categories2.name as category2_name',
                'categories3.name as category3_name',
                'categories4.name as category4_name',
                'categories5.name as category5_name',
                'evaluations.avg_point as evaluations_avg_point',
                'prefectures.name as pref',
                'countries.name as country',
                'languages.name as language',
            ])
            ->leftJoin('categories as categories1', 'users.category1_id', '=', 'categories1.id')
            ->leftJoin('categories as categories2', 'users.category2_id', '=', 'categories2.id')
            ->leftJoin('categories as categories3', 'users.category3_id', '=', 'categories3.id')
            ->leftJoin('categories as categories4', 'users.category4_id', '=', 'categories4.id')
            ->leftJoin('categories as categories5', 'users.category5_id', '=', 'categories5.id')
            ->leftJoin('prefectures', 'users.prefecture_id', '=', 'prefectures.id')
            ->leftJoin('countries', 'users.country_id', '=', 'countries.id')
            ->leftJoin('languages', 'users.language_id', '=', 'languages.id')
            ->leftJoinSub($evaluations, 'evaluations', function ($join) {
                $join->on('users.id', '=', 'evaluations.user_teacher_id');
            })
            ->first();
    }

    /**
     * 講師カウント
     *
     * @param int $categories_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function countTeachersList($sex=null,$category_id = null)
    {
        //講師のみ
        $query=self::where('status',User::STATUS_TEACHER);
        //性別があれば性別で絞込
        if($sex){
            $query->where("sex",$sex);
        }
        //カテゴリがーあればor検索
        if($category_id){
            $query->where(function($query) use($category_id){
                $query->where('category1_id', '=', $category_id)
                    ->orWhere('category2_id', '=', $category_id)
                    ->orWhere('category3_id', '=', $category_id)
                    ->orWhere('category4_id', '=', $category_id)
                    ->orWhere('category5_id', '=', $category_id);
            });
        }
        return $query->count();
    }

    /**
     * ステータスの保存
     *
     * @param array $data
     */
    public function changeStatus($id)
    {
        $user = self::find($id);
        $user->status = 1;
        $user->save();
    }

    /**
     * カテゴリーの保存
     *
     * @param array $data
     */
    public function saveCategories($request)
    {
        if($request->categories) {
            $this->category1_id = array_key_exists(0, $request->categories) ? (int)$request->categories[0] : null;
            $this->category2_id = array_key_exists(1, $request->categories) ? (int)$request->categories[1] : null;
            $this->category3_id = array_key_exists(2, $request->categories) ? (int)$request->categories[2] : null;
            $this->category4_id = array_key_exists(3, $request->categories) ? (int)$request->categories[3] : null;
            $this->category5_id = array_key_exists(4, $request->categories) ? (int)$request->categories[4] : null;
        }
    }

    //以下二つは本来べつに作るべきかもしりないが利便性をかんがえuserに作成する
    /**
     * レビュー数を取得する
     *
     */
    public function countEvaluations()
    {
        // return Evaluation::where('user_teacher_id', $this->id)
        //     ->count();
        return Evaluation::query()
            ->select(
                'evaluations.user_teacher_id', DB::raw("count('user_teacher_id') as reviews")
            )
            ->groupBy('evaluations.user_teacher_id');
    }

    /**
     * 平均ポイントを取得する
     *
     */
    public function averageEvaluationPoint()
    {
        return Evaluation::where('user_teacher_id', $this->id)
            ->avg('point');
    }

    /**
     * 属するコースの最安値を取得する
     *
     */
    public function getMinPrice()
    {
        return Lesson::where('user_id', $this->id)
            ->min('price');
    }

    /**
     * 属するコースの直近日を取得する
     *
     */
    public function getMinDate()
    {
        return Lesson::where('user_id', $this->id)
            ->min('date');
    }

    /**
     *
     * 参加人数を取得する
     *
     */
    public function getJoinCount()
    {
        return Application::where('status', Application::STATUS_NORMAL)->whereIn('lesson_id', function ($query) {
                return $query->select('id')
                            ->from('lessons')
                            ->where('user_id',$this->id);
            })->count();
    }
}

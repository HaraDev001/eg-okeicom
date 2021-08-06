<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Category;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;

class SearchController extends Controller
{
    private $lesson;
    private $category;
    private $user;

    // クラスをインスタンス化するときに必ず実行される関数
    public function __construct(
        // インスタンス化
        Lesson $lesson,
        Category $category,
        User $user
    )
    {
        // グローバル化
        // 依存性注入（DI）
        $this->lesson = $lesson;
        $this->category = $category;
        $this->user = $user;
    }
    public function index(Request $request)
    {
        $params     = $request->all();
        $lessons    = null;
        $teachers   = null;
        // キーワードがある場合、パラーメーターに保存
        if(isset($request->keyword)) { $params['keyword'] = $request->keyword; }
        // カテゴリーがある場合、パラーメーターにカテゴリーを保存
        if(isset($request->categories_id)) { $params['categories_id'] = $request->categories_id; }
        // 日付がある場合、パラーメーターに日付を保存
        if(isset($request->select_date)) { $params['select_date'] = $request->select_date; }
        // ターゲットに値がある場合、パラーメーターにターゲットを保存
        if(isset($request->is_target)) { $params['is_target'] = $request->is_target; }
        // ソートに値がある場合、パラーメーターにソートを保存
        if(isset($request->sort_param)) { $params['sort_param'] = $request->sort_param; }

        // dd($params);
        $sort_param    = $request->sort_data;
        $categories_id = $request->categories_id;
        if(isset($params['is_target']) && $params['is_target'] == 'teachers') {
            $teachers = $this->user->searchTeacher($params)->paginate(20);
        } else {
            $lessons = $this->lesson->findBySearchKeyword($params, $categories_id)->dynamicOrderBy($sort_param)->paginate(20);
        }
        // $is_target     = $request->is_target;
        // dd($is_target);
        // if($params['is_target'] == 'lessons') {
        // } else ($params['is_s'])

        $categories    = $this->category->getAll(true);

        return view('searches.index', compact('params', 'lessons', 'teachers', 'categories'));
    }
}

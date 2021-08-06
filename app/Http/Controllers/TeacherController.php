<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Cancel;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Country;
use App\Models\Language;
use App\Models\Prefecture;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Evaluation;
use App\Http\Requests\Course\StoreRequest as CourseStoreRequest;
use App\Http\Requests\Course\UpdateRequest as CourseUpdateRequest;
use App\Http\Requests\Lesson\CancelRequest as LessonCancelRequest;
use App\Http\Requests\Lesson\StoreRequest as LessonStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use NcJoes\OfficeConverter\OfficeConverter;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller,
    Session;
use Carbon\Carbon;
use SebastianBergmann\Environment\Console;

class TeacherController extends Controller
{
    private $application;
    private $course;
    private $category;
    private $cancel;
    private $lesson;
    private $user;
    private $teacher;

    public function __construct(
        Application $application,
        Course $course,
        Category $category,
        Cancel $cancel,
        Lesson $lesson,
        User $user,
        User $teacher
    )
    {
        $this->application  = $application;
        $this->course       = $course;
        $this->category     = $category;
        $this->cancel       = $cancel;
        $this->lesson       = $lesson;
        $this->user         = $user;
        $this->teacher      = $teacher;
    }

    /**
     * 講師一覧
     * カテゴリー処理も含む
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $categories = $this->category->getAll(true);
        $params     = $request->all();
        $teachers   = $this->user->searchTeacher($params)->paginate(20);

        return view('teachers.index', compact('teachers', 'params', 'categories'));
    }

    /**
     * 並び替え
     *
     * @param Request $request
     */
    public function changeOrder(Request $request)
    {
        session(['order' => $request->input("order")]);
        return redirect(url()->previous());
    }

    /**
     * カテゴリー一覧
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function category(Request $request,$category=null)
    {
        //一覧の表示数
        $limit=config('const.paginate.teacher');

        //カテゴリー取得
        $categories=Category::all();

        $users=$this->user->getTeachersList($request->input("sex"),$category);
        $count=$this->user->countTeachersList($request->input("sex"),$category);

        //ページング処理
        $page=(int)$request->input("page");
        if(!$page){
            $page=1;
        }
        $start=$limit*($page-1)+1;
        $end=$start+$limit;
        if($end>$count){
            $end=$count;
        }
        if($limit) {
            $page_cnt=floor($count/$limit)+1;
            if($count%$limit==0){
                $page_cnt--;
            }
        } else {
            $page_cnt = 1;
        }

        $selected_category=null;

        //カテゴリーある場合はここで内容取得
        if($category){
            $selected_category=Category::find($category);
        }

        $order=session('order',0);

        $new_users=new Collection();
        foreach ($users as $key => $value) {
            $new_users->push($value);
        }
        //表示
        return view('teachers.index',["users"=>$new_users,'categories'=>$categories,'count'=>$count,'order'=>$order,'sex'=>$request->input("sex"),'selected_category'=>$selected_category,'page'=>$page,'start'=>$start,'end'=>$end,'page_cnt'=>$page_cnt]);
    }

    /**
     * 講師詳細
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detail($id)
    {
        // ユーザー詳細情報
        $user = $this->user->getTeachersShow($id);
        // $current_id = Auth::id();
        // if($current_id !== $id)
        // {
        //     return redirect('/');
        // } else{
            // ユーザーのレッスン一覧を取得する
            // $lessons = User::find($id)->lessons->sortBy('created_at');
            $lessons = $this->lesson->findLessonOfTeacherId($id);

            $evalutions = Evaluation::where("user_teacher_id",$id)->orderBy("id","desc")->get();
            foreach ($evalutions as $key => $evalution) {
                $evalution_user = User::find($evalution->user_student_id);
                if($evalution_user){
                    $evalution["user_name"] = $evalution_user["name"];
                    $evalution["user_img"]  = $evalution_user["img"];
                }
                $evalution["date"] = substr($evalution["created_at"], 0,10);
                $evalutions[$key] = $evalution;
            }
    
            // ビュー画面
            return view('teachers.detail', compact('user', 'lessons', 'evalutions'));
        // }

        //取得
        // $user=User::where("id",$id)->where('status',User::STATUS_TEACHER)->first();
        // //無い場合は404としておく
        // if(!$user){
        //     abort(404);
        // }

        // //子要素取得
        // $user["count"]=$user->countEvaluations();
        // $user["ave"]=$user->averageEvaluationPoint();
        // if($user->category1_id){
        //     $user["cat1"]=Category::find($user->category1_id)->name;
        // }
        // if($user->category2_id){
        //     $user["cat2"]=Category::find($user->category2_id)->name;
        // }
        // if($user->category3_id){
        //     $user["cat3"]=Category::find($user->category3_id)->name;
        // }
        // if($user->category4_id){
        //     $user["cat4"]=Category::find($user->category4_id)->name;
        // }
        // if($user->category5_id){
        //     $user["cat5"]=Category::find($user->category5_id)->name;
        // }
        // if($user->country_id){
        //     $user["country"]=Country::where("id",$user->country_id)->value("name");
        // }
        // if($user->language_id){
        //     $user["lang"]=Language::where("id",$user->language_id)->value("name");
        // }
        // if($user->prefecture_id){
        //     $user["pref"]=Prefecture::where("id",$user->prefecture_id)->value("name");
        // }

        // //レッスン取得
        // $lessons=Lesson::where("user_id",$id)->where("status",Lesson::STATUS_PLANS)->where("public",0)->orderBy("date","asc")->get();
        // foreach ($lessons as $key => $lesson) {
        //     $course=Course::find($lesson->course_id);
        //     if($course){
        //         if($course->category1_id){
        //             $lesson["cat1"]=Category::find($course->category1_id)->name;
        //         }
        //         if($course->category2_id){
        //             $lesson["cat2"]=Category::find($course->category2_id)->name;
        //         }
        //         if($course->category3_id){
        //             $lesson["cat3"]=Category::find($course->category3_id)->name;
        //         }
        //         if($course->category4_id){
        //             $lesson["cat4"]=Category::find($course->category4_id)->name;
        //         }
        //         if($course->category5_id){
        //             $lesson["cat5"]=Category::find($course->category5_id)->name;
        //         }
        //         if($course->img1){
        //             $lesson["img"]=$course->img1;
        //         }
        //     }
        //     $lesson["price"]=number_format($lesson->price);
        //     //日付の整形はバックエンドしておく
        //     $lesson["date_format"]=Carbon::parse($lesson["date"])->isoFormat("MM/DD(ddd)");
        //     $lesson["start_format"]=Carbon::parse($lesson["start"])->format("H:i");
        //     $lesson["finish_format"]=Carbon::parse($lesson["finish"])->format("H:i");
        //     $lessons[$key]=$lesson;
        // }
        // //評価取得
        // $evalutions=Evaluation::where("user_teacher_id",$id)->orderBy("id","desc")->get();
        // foreach ($evalutions as $key => $evalution) {
        //     $evalution_user=User::find($evalution->user_student_id);
        //     if($evalution_user){
        //         $evalution["user_name"]=$evalution_user["name"];
        //         $evalution["user_img"]=$evalution_user["img"];
        //     }
        //     $evalution["date"]=substr($evalution["created_at"], 0,10);
        //     $evalutions[$key]=$evalution;
        // }
        // return view('teachers.detail',["user"=>$user,"lessons"=>$lessons,"evalutions"=>$evalutions]);
    }

    /**
     * コース一覧
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function course(Request $request)
    {
        // コース一覧を取得
        $courses = $this->course->findByUsersId(Auth::user()->id, $this->user::STATUS_TEACHER);
        $lessons = DB::table('lessons')->get();
        return view('teachers.course', compact('courses'));
    }

    /**
     * コース作成ページ
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createCourse(Request $request)
    {
        $categories = $this->category->getAll();
        return view('teachers.course-create', compact('categories'));
    }

    /**
     * コースの登録処理
     *
     * @param CourseStoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function storeCourse(CourseStoreRequest $request)
    {
        DB::beginTransaction($request);
        try {
            $course = new Course();
            $course->user_id = Auth::user()->id;
            // コース追加の処理
            $course->title = $request->title;
            $course->detail = $request->detail;
            $course->saveCategories($request);
            $course->saveImgs($request);
            $course->save();
            $last_insert_id = $course->id;

            // ユーザーの状態を講師にする処理
            $user = User::find($course->user_id);
            $user->is_teacher = 1;
            $user->save();

            // セッションにコースIDを登録する
            session(['course_id' => $last_insert_id]);

            DB::commit();
            return redirect(route('mypage.t.lessons.create'));
        } catch (\PDOException $e){
            DB::rollBack();
            return back()->withInput()->with('flash_message', 'コースの登録に失敗しました。');
        }
    }

    /**
     * レッスン作成画面表示
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createLessons(Request $request)
    {
        $courses_id = $request->courses_id;
        $types = $this->lesson->getArrayTypes();
        return view('teachers.lesson-create', compact('courses_id', 'types'));
    }

    /**
     * レッスンの作成
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function storeLessons(Request $request)
    {
        // コースのクラス作成
        $lessons = json_decode($request->lessons, true);

        // レッスンの閲覧用ランダムな整数を設定する
        // $urls[] = '';
        // foreach((array)$lessons as $index => $lesson) {
        //     do {
        //         // 12桁のランダムな整数を作成
        //         $randams[$index] = substr(bin2hex(random_bytes(64)), 0, 64);
        //         // DBに登録されているnumberと12桁のランダムな整数が合致するか
        //         $key = in_array($randams[$index], $urls);
        //         // ランダムな整数がDBと同じ場合は、再度ランダムな整数を発行する
        //     } while ($key == true);
        // }

        // レッスンに必要な情報を入れる
        $models[] = '';

        // レッスンのスライド処理
        foreach ((array)$lessons as $index => $lesson) {
            // if($lesson['slide']){
            $models[$index] = Lesson::make($lesson);
            // if(!empty($lesson['slide'])){
            //     // スライドの処理
            //     $new_folder = time()."".rand();
            //     Storage::disk('lesson')->makeDirectory($new_folder, $mode= 0777, true, true);
            //     $base64_slide = explode(',',$lesson['slide']);
            //     $real_slide = base64_decode($base64_slide[1]);
            //     $new_filename = $lesson['title'];
            //     Storage::disk('lesson')->put($new_folder.'/'.$new_filename.".pptx", $real_slide);
            //     $ppt_path = $path = Storage::disk('lesson')->path($new_folder.'/'.$new_filename.".pptx");
            //     $converter = new OfficeConverter($ppt_path, null, '/Applications/LibreOffice.app/Contents/MacOS/soffice', true);
            //     $converter->convertTo($new_filename.'.pdf');
            //     $models[$index]->slide = $new_filename;
            //     $models[$index]->view = $new_folder;
            // } else {
            //     // $models[$index]->view = $randams[$index];
            //     $models[$index]->view = '';
            // }
            if(!empty($lesson['slide'])){
                // スライドの処理
                $extension = explode('/', explode(':', substr($lesson['slide'], 0, strpos($lesson['slide'], ';')))[1])[1];
                if($extension == "vnd.ms-powerpoint"){
                    $real_extension = "ppt";
                }else{
                    $real_extension = "pptx";
                }
                $new_folder = time()."".rand();
                Storage::disk('lesson')->makeDirectory($new_folder, $mode= 0777, true, true);
                $base64_slide = explode(',',$lesson['slide']);
                $real_slide = base64_decode($base64_slide[1]);
                $new_filename = $lesson['title'];
                Storage::disk('lesson')->put($new_folder.'/'.$new_filename.".".$real_extension, $real_slide);

                $models[$index]->slide = $new_filename.".".$real_extension;
                $models[$index]->view = $new_folder;
            } else {
                // $models[$index]->view = $randams[$index];
                $models[$index]->view = '';
            }
            // ランダムな整数を配列に入れる
            $models[$index]->course_id = session('course_id');
            $models[$index]->title = $lesson['title'];
            $models[$index]->public = $lesson['public'];
            $models[$index]->type = $lesson['type'];
            $models[$index]->url = $lesson['url'] ?? '';
            $models[$index]->date = $lesson['date'] ?? '';
            $models[$index]->start = $lesson['start'] ?? '';
            $models[$index]->finish = $lesson['finish'] ?? '';
            $models[$index]->price = $lesson['price'] ?? '';
            $models[$index]->cancel_rate = $lesson['cancel_rate'] ?? '';
            $models[$index]->detail = $lesson['detail'] ?? '';
            $models[$index]->user_id = Auth::user()->id;
            $models[$index]->status = 0;
            $models[$index]->save();
        }
        return redirect(route('mypage.t.courses'));
    }

    /**
     * コース詳細
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function coursesDetail(Request $request)
    {
        //registering course_id 
        $course_id = $request->courses_id;
        session(['course_id' => $course_id]);

        $course = Course::query()->find($request->courses_id);
        $categories = $this->category->getAll();
        $lessons = $this->lesson->findByCoursesId($request->courses_id, Auth::user()->id);
        return view('teachers.course-detail', compact('course', 'categories', 'lessons'));
    }

    /**
     * コースの更新/削除
     *
     * @param CourseUpdateRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function updateCourses(CourseUpdateRequest $request)
    {
        $target_id = $request->courses_id;
        $course = Course::query()->find($request->courses_id);
        if($request->has('save')) {
            // 更新
            $course->title = $request->title;
            $course->detail = $request->detail;
            $course->saveCategories($request);
            $course->saveImgs($request);
            $course->save();
            return redirect('/mypage/t/courses/detail/' . $target_id);
        } elseif ($request->has('delete')) {
            // 削除
            DB::transaction(function () use ($course) {
                $course->deleteImgs();
                $this->lesson->deleteByCoursesId($course->id);
                $course->delete();
            });
            return redirect(route('mypage.t.courses'));
        }
    }

    /**
     *
     * コースのレッスン作成
     *
     *
     */
    public function createCourseLesson(request $request)
    {
        $lessonNew = new Lesson();
        DB::beginTransaction();
        try {
            // if(!empty($request['slide'])){
            //     // スライドの処理
            //     $new_folder = time()."".rand();
            //     Storage::disk('lesson')->makeDirectory($new_folder, $mode= 0777, true, true);
            //     $base64_slide = explode(',',$request['slide']);
            //     $real_slide = base64_decode($base64_slide[1]);
            //     $new_filename = $request->title;
            //     Storage::disk('lesson')->put($new_folder.'/'.$new_filename.".pptx", $real_slide);
            //     $ppt_path = $path = Storage::disk('lesson')->path($new_folder.'/'.$new_filename.".pptx");
            //     $converter = new OfficeConverter($ppt_path, null, '/Applications/LibreOffice.app/Contents/MacOS/soffice', true);
            //     $converter->convertTo($new_filename.'.pdf');
            //     $lessonNew->slide = $new_filename;
            //     $lessonNew->view = $new_folder;
            // } else {
            //     // $models[$index]->view = $randams[$index];
            //     $lessonNew->view = '';
            // }
            if(!empty($request['slide'])){
                // スライドの処理
                $extension = explode('/', explode(':', substr($request['slide'], 0, strpos($request['slide'], ';')))[1])[1];
                if($extension == "vnd.ms-powerpoint"){
                    $real_extension = "ppt";
                }else{
                    $real_extension = "pptx";
                }
                $new_folder = time()."".rand();
                Storage::disk('lesson')->makeDirectory($new_folder, $mode= 0777, true, true);
                $base64_slide = explode(',',$request['slide']);
                $real_slide = base64_decode($base64_slide[1]);
                $new_filename = $request['title'];
                Storage::disk('lesson')->put($new_folder.'/'.$new_filename.".".$real_extension, $real_slide);

                $lessonNew->slide = $new_filename.".".$real_extension;
                $lessonNew->view = $new_folder;
            } else {
                // $models[$index]->view = $randams[$index];
                $lessonNew->view = '';
            }
            // ランダムな整数を配列に入れる
            $lessonNew->course_id = session('course_id');
            $lessonNew->title = $request['title'];
            $lessonNew->public = $request['public'];
            $lessonNew->type = $request['type'];
            $lessonNew->url = $request['url'] ?? '';
            $lessonNew->date = $request['date'] ?? '';
            $lessonNew->start = $request['start'] ?? '';
            $lessonNew->finish = $request['finish'] ?? '';
            $lessonNew->price = $request['price'] ?? '';
            $lessonNew->cancel_rate = $request['cancel_rate'] ?? '';
            $lessonNew->detail = $request['detail'] ?? '';
            $lessonNew->user_id = Auth::user()->id;
            $lessonNew->status = 0;
            $lessonNew->save();
            DB::commit();
            return redirect(route('mypage.t.courses.detail', ['courses_id' => session('course_id')]));
        } catch (\PDOException $e){
            DB::rollBack();
            return back()->withInput()->with('flash_message', 'コースの登録に失敗しました。');
        }
    }

    /**
     *
     * コースのレッスン編集
     *
     */
    public function updateCourseLesson(request $request)
    {
        dd('編集');
    }

    // /**
    //  * レッスンの登録
    //  *
    //  * @param LessonStoreRequest $request
    //  * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    //  */
    // public function storeLessons(LessonStoreRequest $request)
    // // public function storeLessons(Request $request)
    // {
    //   $targets = json_decode($request->get('lessons'), true);

    //   $lesson->fill([
    //     'user_id' => Auth::user()->id,
    //     'course_id' => $request->courses_id,
    //     'status' => $this->lesson::STATUS_PLANS,
    //     'public' => $request->public,
    //     'type' => $request->type,
    //     'date' => $request->date,
    //     'start' => $request->start,
    //     'finish' => $request->finish,
    //     'price' => $request->price,
    //     'view' => 'fdav9ub32ojbvdfavadf',
    //     'cancel_rate' => $request->cancel_rate,
    //     'title' => $request->title,
    //     'detail' => $request->detail,
    //   ])->save();

    //   return redirect(route('mypage.t.courses.detail', ['courses_id' => $request->courses_id]));
    // }

    /**
     * レッスンの編集
     *
     * @param LessonStoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editLessons($id)
    {
        // 詳細取得
        // $lesson = Lesson::find($id);
        // $userids = Application::where('lesson_id', $id)->whereIn('status', [0,1])->pluck('user_id')->toArray();
        // $users = User::whereIn('id', $userids)->get();
        // return view('teachers.lesson-edit', compact('lesson', 'users'));
        // レッスン一覧
        $lesson = Lesson::find($id);
        // $applications = Application::where('lesson_id', $id)->whereIn('status', [0,1])->get();
        // $user_ids = Application::where('lesson_id', $id)->whereIn('status', [0,1])->pluck('user_id')->toArray();
        // $users = User::whereIn('id', $user_ids)->get();
        // return view('teachers.lesson-edit', compact('lesson', 'users', 'applications'));

        // $applications = Application::select([
        //                                 'applications.*',
        //                                 'users.id as user_id',
        //                                 'users.img as img',
        //                                 'users.name as name',
        //                                 'users.sex as sex',
        //                                 'prefectures.name as pref',
        //                             ])->where('applications.lesson_id', $id)
        //                             ->whereIn('applications.status', [0,1])
        //                             ->leftJoin('users', 'applications.user_id', '=', 'users.id')
        //                             ->leftJoin('prefectures', 'users.prefecture_id', '=', 'prefectures.id')
        //                             ->get();
        $applications = $this->application->applicationListOfLesson($id);
        return view('teachers.lesson-edit', compact('lesson', 'applications'));
    }

    /**
     * レッスンの更新
     *
     * @param LessonStoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    // public function updateLessons(LessonStoreRequest $request)
    public function updateLessons(Request $request)
    {
        // dd($request->all());
        $lesson = Lesson::find($request['lesson_id']);
        // レッスン更新処理
        $lesson->update([
            'title'         => $request['title'],
            'url'           => $request['url'],
            'date'          => $request['date'],
            'start'         => $request['start'],
            'finish'        => $request['finish'],
            'detail'        => $request['detail'],
            'price'         => $request['price'],
            'cancel_rate'   => $request['cancel_rate'],
        ]);
        return back()->with('success', '更新が成功しました。');

    }

    /**
     * レッスンの削除
     *
     * @param LessonStoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function deleteLessons(Request $request)
    {
        // 該当レッスンのIDを取得
        $lesson_id = $request->lesson_id;
        // 該当レッスンのユーザーIDを取得
        $user_id = $request->user_id;
        // 該当レッスンからコースIDを取得
        $course_id = $request->course_id;
        // レッスンIDから該当するレッスンを取得して、削除
        Lesson::find($lesson_id)->delete();

        // 関連削除 / 編集
        // 該当レッスンの予約を全てキャンセルする(Applications)
        // 該当レッスンのクーポンを全て削除する（Coupon）
        // 該当レッスンの未決定のキャンセル処理を全てdeleted_ad（Cancels）
        // 該当レッスンの未実施の決済履歴もキャンセル(Payments）

        // コース詳細へ戻る
        return redirect(route('mypage.t.courses.detail', ['courses_id' => $course_id]));
    }

    /**
     * レッスン参加状況画面表示
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function lessonsParticipation(Request $request)
    {
        $lessons = $this->lesson->findByUsersIdGetApplicationCnt(Auth::user()->id);
        return view('teachers.lesson-participation', compact('lessons'));
    }

    /**
     * レッスン参加ユーザ一覧表示
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function lessonParticipationUsers(Request $request)
    {
        $users = $this->user->findByLessonsId($request->lessons_id, Auth::user()->id);

        return view('teachers.lesson-participation-users', compact('users'));
    }

    /**
     * キャンセルリクエスト一覧表示
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function cancelRequests(Request $request)
    {
        $cancels = $this->cancel->findByUsersId(Auth::user()->id);
        return view('teachers.cancel-requests', compact('cancels'));
    }

    /**
     * キャンセル実行
     *
     * @param LessonCancelRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function doCancel(LessonCancelRequest $request)
    {
        DB::transaction(function () use ($request) {
            if ($request->has('save')) {
                // 承認
                foreach ($request->cancels as $id) {
                    $this->cancel->approvalCancel($id);
                }
            } else {
                // 拒否
                foreach ($request->cancels as $id) {
                    $this->cancel->rejectionCancel($id);
                }
            }
        });

        return redirect(route('mypage.t.cancel-requests'));
    }

    public function doBlock(Request $request) {
        DB::transaction(function () use ($request) {
            $application = Application::where('lesson_id', $request->lessonId)
              ->where('user_id', $request->userId)
              ->first();
            $application->status = 3;
            $application->deleted_at = date("Y-m-d");
            $application->save();

            \App\Models\Cancel::create([
                'application_id' => $application->id,
                'user_id' => $request->userId,
                'status' => 1
            ]);
        });
        return redirect(route('mypage.t.lessons.edit', ['lesson_id' =>$request->lessonId]));
    }

    /**
     * ステータス変更
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function change(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->status = 0;
        $user->save();
        // $this->teacher->changeStatus($user_id);
        return redirect(route('mypage.u.attendance-lessons'));
    }
}

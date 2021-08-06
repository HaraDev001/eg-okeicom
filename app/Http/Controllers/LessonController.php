<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\Cancel;
use App\Models\Payment;
use App\Models\Category;
use App\Models\Evaluation;
use App\Models\Application;
use App\Mail\BuyLesson;
use App\Mail\CancelLesson;
use App\Mail\LessonDetail;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Controller,
    Session;
use App\Http\Resources\LessonDetailResource;
use App\Http\Requests\StoreEvaluation;

use Carbon\Carbon;

class LessonController extends Controller
{
    private $user;
    private $lesson;
    private $category;
    private $evaluation;

    public function __construct(
        User $user,
        Lesson $lesson,
        Course $course,
        Category $category,
        Evaluation $evaluation
    )

    {
        $this->user = $user;
        $this->lesson = $lesson;
        $this->course = $course;
        $this->category = $category;
        $this->evaluation = $evaluation;
    }

    /**
     * レッスン一覧
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $params = [];
        // dd($request->all());
        // カテゴリーがある場合、パラーメーターにカテゴリーを保存
        if(isset($request->categories_id)) {
            $params['categories_id'] = '';
            $params['categories_id'] = $request->categories_id;
        }

        // ソートに値がある場合、パラーメーターにソートを保存
        if(isset($request->sort_param)) {
            $params['sort_param'] = '';
            $params['sort_param'] = $request->sort_param;
        }

        // 全件検索 / 並び替え機能 / ページネーション機能
        $lessons    = $this->lesson->searchLesson($params)->paginate(20);
        $categories = $this->category->getAll(true);

        // dd($params);
        return view('lessons.index', compact('params', 'lessons', 'categories'));
    }

    /**
     * カテゴリ別レッスン一覧
     *
     * @param Request $request
     * @return Factory|View
     */
    public function category(Request $request)
    {
        // dd($request);
        // $sort_param    = $request->query('sort_param');
        // $categories_id = $request->query('categories_id');
        if(isset($request->categories_id)) { $params['categories_id'] = $request->categories_id; }
        // ソートに値がある場合、パラーメーターにソートを保存
        if(isset($request->sort_param)) { $params['sort_param'] = $request->sort_param; }
        $lessons    = $this->lesson->findByCategoriesId($params)->DynamicOrderBy($params)->paginate(20);
        $categories = $this->category->getAll(true);
        return view('lessons.index', compact('params', 'lessons', 'categories'));
    }

    /**
     * レッスン詳細
     *
     * @param Request $request
     * @return Factory|View
     */
    public function detail(Request $request, $lesson_id)
    {
        // レッスン情報
        $lesson = $this->lesson->getShowLesson($lesson_id)->first();
        // $current_id = $lesson->user_id;
        // $user_id = Auth::id();
        // if($current_id == $user_id)
        // {
            // レッスンID情報をセッションに入れる
            $request->session()->put("lesson_id", $lesson['id']);

            // ログインユーザー情報
            // $user_id = Auth::user()->id;
            $user_id = Auth::id();

            // レッスンの講師情報
            $user = User::find($lesson->user_id);
            // レッスンの講師の評価情報
            $evaluations = $this->evaluation->index($lesson->user_id)->get();
            // 関連レッスン一覧
            $relatedLessons = $this->lesson->findByCoursesId($lesson->course_id, $lesson->user_id);
            // コース画像一覧を配列で取得
            $courseImgLists = $this->course->courseImgLists($lesson->course_id);

            // レッスンを購入しているか調べる
            $lessonInstance = new Lesson;
            $checkPurchase  = $lessonInstance->checkPurchaseLesson($lesson_id, $user_id);
            if($checkPurchase) {
                $request->session()->put("application_id", $checkPurchase['id']);
            }

            // レッスン開始日時を取得
            $basicDate = $this->lesson->getBasicDate($lesson->date, $lesson->start);
            // レッスン終了日時を取得
            $finishDate = $this->lesson->getBasicDate($lesson->date, $lesson->finish);

            $currentDate = Carbon::create(
                date("Y", strtotime(date("Y-m-d H:i:s"))),
                date("m", strtotime(date("Y-m-d H:i:s"))),
                date("d", strtotime(date("Y-m-d H:i:s"))),
                date("H", strtotime(date("Y-m-d H:i:s"))),
                date("i", strtotime(date("Y-m-d H:i:s"))),
                date("s", strtotime(date("Y-m-d H:i:s")))
            );

            // レッスンを登録する
            return view('lessons.detail', compact('lesson_id', 'lesson', 'user', 'evaluations', 'relatedLessons', 'courseImgLists', 'checkPurchase', 'basicDate', 'finishDate', 'currentDate'));
        // } else {
        //     return redirect('/');
        // }
    }

    /**
     * レッスン予約ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function application(Request $request)
    {
        // セッション情報を確認
        if(Session::get('lesson_id')) {
            $lesson = $this->lesson->getShowLesson(Session::get('lesson_id'))->first();
            // $lesson = Session::all();
        } else {
            $error = 'レッスン情報がありません。';
            return back()->withErrors($error);
        }
        // レッスンの画像情報を取得する
        $course_id = $lesson->course_id;
        $courseImg = $this->course->courseImgLists($course_id)['img1'];

        // ユーザーステータス
        $user_status = Auth::user()->status;

        return view('lessons.application', compact('lesson', 'courseImg', 'user_status'));
    }

    /**
     * レッスン予約ページ POST
     *
     * @param Request $request
     * @return Factory|View
     */
    public function applicationPost(Request $request)
    {
        // セッション情報を確認
        if(Session::get('lesson_id')) {
            return redirect(route('lessons.credit-payment'));
        } else {
            $error = 'レッスン情報がありません。';
            return back()->withErrors($error);
        }
        // return view(route('lessons.credit-payment'));
    }

    /**
     * クレジットカード決済ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function paymentCredit(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user_status = $user->status;
        // セッション情報を確認
        if(Session::get('lesson_id')) {
            $lesson = $this->lesson->getShowLesson(Session::get('lesson_id'))->first();
        } else {
            $error = 'レッスン情報がありません。';
            return back()->withErrors($error);
        }
        return view('lessons.credit-payment', compact('lesson', 'user_status'));
    }

    /**
     *
     * クレジットカード決済ページ POST
     * クレジットカード番号：5778689503669749
     *
     * @param Request $request
     * @return Factory|View
     */
    public function paymentCreditPost(Request $request)
    {
        // レッスン情報をセットする
        if(Session::get('lesson_id')) {
            $lesson = $this->lesson->getShowLesson(Session::get('lesson_id'))->first();
        } else {
            $error = 'レッスン情報がありません。';
            return back()->withErrors($error);
        }
        // ユーザー情報を取得する
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        // １．受け取った値からXML構文を作成
        $xml = '<?xml version="1.0" encoding="utf-8"?>
            <request service="token" action="newcard">
            <authentication>
                <clientip>2014003669</clientip>
            </authentication>
            <card>
                <cvv>' . $request->cvv . '</cvv>
                <number>' . $request->number . '</number>
                <expires>
                    <year>' . $request->year . '</year>
                    <month>' . $request->month . '</month>
                </expires>
                <name>' . $request->name . '</name>
            </card>
        </request>';

        // ２．XML構文をcUELでPOST
        // トークン発行用URL
        $token_url = 'https://linkpt.cardservice.co.jp/cgi-bin/token/token.cgi';
        // トークン発行用URLにcUelでPOST
        $curl_token = curl_init($token_url);
        curl_setopt($curl_token, CURLOPT_POST, TRUE);
        curl_setopt($curl_token, CURLOPT_POSTFIELDS, $xml); // パラメータをセット
        curl_setopt($curl_token, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_token, CURLOPT_RETURNTRANSFER, true);

        // ３．レスポンスからトークン取得を取得し、submitする
        // トークン発行からレスポンスを取得し、連想配列に戻す
        $response_token = curl_exec($curl_token);
        $object = simplexml_load_string($response_token);
        $array = json_decode(json_encode($object), true);
        // クレカエラーメッセージ一覧
        if($array['result']['status'] == 'invalid') {
            switch ($array['result']['code']) {
                case '88888888':
                    $error = '決済システムがメンテナンス中です。時間を置いて、決済を行ってください。';
                    break;
                case '90100100':
                    $error = '通信に失敗しました。運営者へお問い合わせください。';
                    break;
                case '99999999':
                    $error = 'その他のシステムエラーが発生しました。運営者へお問い合わせください。';
                    break;
                case '02130110':
                    $error = '不正な操作です。ログアウトして、再度お試しください。';
                    break;
                case '02130514':
                    $error = '「カード番号」を入力してください。';
                    break;
                case '02130517':
                case '02130619':
                case '02130620':
                case '02130621':
                case '02130640':
                    $error = '「カード番号」を正しく入力してください。';
                    break;
                case '02130714':
                    $error = '「有効期限(年)」を入力してください。';
                    break;
                case '02130717':
                case '02130725':
                    $error = '「有効期限(年)」を正しく入力してください。';
                    break;
                case '02130814':
                    $error = '「有効期限(月)」を入力してください。';
                    break;
                case '02130817':
                case '02130825':
                    $error = '「有効期限(月)」を正しく入力してください。';
                    break;
                case '02130922':
                    $error = '「有効期限」を正しく入力してください。';
                    break;
                case '02131014':
                    $error = 'CVVが不正です。';
                    break;
                case '02131117':
                case '02131123':
                case '02131124':
                    $error = '「カード名義」を正しく入力してください。';
                    break;
                default:
                    $error = 'エラーが発生しました。運営者へお問い合わせください。';
                    break;
            }
            return back()->withInput()->withErrors($error);
        }

        // ゼウス決済用URL
        $payment_url = 'https://linkpt.cardservice.co.jp/cgi-bin/secure.cgi';
        // パラーメーター設定
        $params = [
            'clientip'  => '2014003669',
            'token_key' => $array['result']['token_key'],
            'money'     => $lesson->price,
            'telno'     => $user->tel,
            'send'      => 'mall',
            'email'     => $user->email,
            // 'email'     => Auth::user()->email,
        ];
        // dd($params);
        // パラメーターをsubmitする
        $curl_payment = curl_init($payment_url);
        curl_setopt($curl_payment, CURLOPT_POST, TRUE);
        curl_setopt($curl_payment, CURLOPT_POSTFIELDS, http_build_query($params)); // パラメータをセット
        curl_setopt($curl_payment, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_payment, CURLOPT_RETURNTRANSFER, true);
        $response_payment = curl_exec($curl_payment);

        // ４．エラーメッセージ設定
        if($response_payment === ['Invalid clientip', 'Invalid sendid', 'Invalid telno', 'Invalid email']) {
            return redirect(route('lessons.application.error'));
        } elseif($response_payment === 'Invalid money') {
            $error = '決済金額をご確認ください';
            return back()->withErrors($error);
        } elseif($response_payment === 'failure_order') {
            $error = 'クレジットカードが利用できません。クレジットカード会社にお問い合わせください。';
            return back()->withErrors($error);
        } elseif($response_payment === 'maintenance') {
            $error = '決済サービスがメンテナンス中のため、決済ができませんでした。お手数おかけしますが、時間を置いて決済してくださいませ。';
            return back()->withErrors($error);
        } elseif($response_payment === 'Success_order') {
            DB::beginTransaction();
            try {
                // キャンセル金額
                $cancel_price = $lesson->price * $lesson->cancel_rate / 100;

                // *** レッスン予約情報に登録 ***
                $applicationInstance = new Application;
                $applicationParams['lesson_id']     = $lesson->id;
                $applicationParams['user_id']       = $user_id;
                $applicationParams['price']         = $lesson->price;
                $applicationParams['cancel_price']  = $cancel_price;
                $applicationInstance->create($applicationParams);
                $application_id = DB::getPdo()->lastInsertId();

                // *** 決済履歴情報に登録 ***
                $paymentInstance = new Payment;
                $paymentParams['application_id']  = $application_id;
                $paymentParams['user_student_id'] = $user_id;
                $paymentParams['user_teacher_id'] = $lesson->user_id;
                $paymentParams['lesson_id']       = $lesson->id;
                $paymentParams['amount']          = $lesson->price;
                $paymentInstance->create($paymentParams);

                // 送信者にメールを送る


                DB::commit();
                return redirect(route('lessons.application.complete'));
            } catch (\Exception $e) {
                DB::rollback();
                $error = '決済に失敗しました。再度、ご登録をお願いいたします。';
                return back()->withInput()->withErrors($error);
            }
            $error = '不明なエラーが発生しました。管理者へお問い合わせください。';
            return back()->withInput()->withErrors($error);
            // 決済情報登録
        }
        dd('不明');

        // ５．完了ページへ遷移
        // https://linkpt.cardservice.co.jp/cgi-bin/token/token.cgi
        // return view('lessons.credit-payment');
    }

    /**
     * クレジットカード決済失敗ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function errorApplication(Request $request)
    {
        // 指定したデータをセッションから削除する
        session()->forget('lesson_id');
        return view('lessons.application-error');
    }

    /**
     * クレジットカード決済完了ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function completeApplication(Request $request)
    {
        // 講師側へ自動メール送信
        $user = Auth::user();
        $lesson = Lesson::find(session()->get('lesson_id'));
        $teacher = User::find($lesson->user_id);
        // 送信
        $email = new BuyLesson($teacher, $lesson);
        Mail::to($teacher->email)->send($email);

        // 受講者へ自動メール送信
        // 送信
        $userEmail = new LessonDetail($user, $lesson);
        Mail::to($user->email)->send($userEmail);

        // 指定したデータをセッションから削除する
        session()->forget('lesson_id');

        return view('lessons.application-complete');
    }

    /**
     * クレジットカード決済完了ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function completeApplicationPost(Request $request)
    {
        // ユーザーIDを取得
        $user_id = Auth::user()->id;
        // ユーザーが講師の場合、ステータスを変更
        DB::beginTransaction();
        try {
            if(Auth::user()->status === 1) {
                // ユーザーの情報更新
                $user = User::where('id', $user_id)->first();
                $user->status = 0;
                $user->save();
            }
            DB::commit();
            return redirect(route('mypage.u.attendance-lessons'));
        } catch(\Exception $e) {
            DB::rollback();
            $error = '原因不明のエラーです。管理者へお問い合わせくださいませ。';
            return back()->withErrors($error);
        }
    }

    /**
     * レッスンキャンセルページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function cancel(Request $request)
    {
        // セッション情報を確認
        if(Session::get('application_id') && Session::get('lesson_id')) {
            // 変数に値をセット
            $application_id = Session::get('application_id');
            $lesson_id = Session::get('lesson_id');

            // 変数の値をセットする
            $application = Application::find($application_id);
            $lesson = Lesson::find($lesson_id);
            $course = Course::find($lesson->course_id);
            // $lesson = $this->lesson->getShowLesson(Session::get('application_id'))->first();

            // セッションに値をセットし直す
            $request->session()->put("application", $application);
            $request->session()->put("lesson", $lesson);
            // dd(Session::get('application'));
        } else {
            $error = 'エラーが発生しました。';
            return back()->withErrors($error);
        }

        // ユーザーステータス
        $user_status = Auth::user()->status;

        return view('lessons.cancel', compact('lesson', 'course', 'user_status'));
    }

    /**
     * レッスンキャンセル実行処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function doCancel(Request $request)
    {
        if(Session::get('application') && Session::get('lesson')) {
            // 変数に値をセット
            $application_id = Session::get('application')->id;
            $lesson = Session::get('lesson');
        } else {
            $error = 'キャンセルに失敗しました。運営者にお問い合わせください。';
            return back()->withErrors($error);
        }

        // $year = date('Y', strtotime($lesson->date));
        // $month = date('m', strtotime($lesson->date));
        // $day = date('d', strtotime($lesson->date));
        // $hour = date('H', strtotime($lesson->start));
        // $minute = date('i', strtotime($lesson->start));
        // $second = date('s', strtotime($lesson->start));
        // $basicDate = Carbon::create($year, $month, $day, $hour, $minute, $second);
        $basicDate = $this->lesson->getBasicDate($lesson->date, $lesson->start);

        DB::beginTransaction();
        try {
            $user_id = Auth::user()->id;
            // 予約情報を取得する
            $application = Application::find($application_id);
            // *** キャンセル登録 ***
            $cancelInstance = new Cancel;
            $cancelParams['application_id'] = $application_id;
            $cancelParams['user_id']        = $user_id;
            $cancelParams['reason']         = $request->reason;
            if($basicDate <= Carbon::now()->subHours(24)) {
                // 24時間より前の場合
                $cancelParams['status'] = 0;
                $cancelParams['approval_at'] = Carbon::now();
            } else {
                // 24時間以内の場合
                $cancelParams['status'] = 9;
            }
            $cancelInstance->create($cancelParams);

            // キャンセル登録時のIDを取得する
            $cancel_id = DB::getPdo()->lastInsertId();

            // *** 決済処理拒否登録 ***
            $payment = Payment::where('application_id', $application_id)->first();
            $payment->status = 2;
            $payment->save();
            $payment->delete();

            // *** 申し込み拒否登録 ***
            $application->status = 2;
            $application->cancel_id = $cancel_id;
            $application->save();
            $application->delete();

            // *** メール送信 ***
            $email = new CancelLesson();
            $user = User::find($user_id);
            $user_email = $user->email;
            Mail::to($user_email)->send($email);

            // DBトランザクションをコミット
            DB::commit();
            return redirect(route('lessons.cancel.complete'));
        } catch (\Exception $e) {
            DB::rollback();
            $error = 'キャンセル処理ができませんでした。運営者にお問い合わせくださいませ。';
            return back()->withErrors($error);
        }
    }

    /**
     * レッスンキャンセル完了ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function completeCancel(Request $request)
    {
        $user_status = Auth::user()->status;
        return view('lessons.cancel-complete', compact('user_status'));
    }

    /**
     * レッスン閲覧画面
     *
     * @param Request $request
     * @return Factory|View
     */
    public function browsing($lesson_id)
    {
        // 共通のURL
        $lesson = Lesson::find($lesson_id);

        // ユーザーIDのログイン情報
        $user_id = Auth::user()->id;
        if(!$user_id) {
            return redirect(route('login'));
        }

        // レッスンを購入しているか調べる
        $lessonInstance = new Lesson;
        $checkHistory = $lessonInstance->checkPurchaseLesson($lesson_id, $user_id);
        if($checkHistory) {
            return view('lessons.browsing', $lesson)->with('lesson', $lesson);
        } else {
            return back();
        }
    }

    /**
     * 講師評価ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function createEvaluation($id, Request $request)
    {
        $evaluation = Evaluation::where('url', $id)->first();
        $user_id = Auth::id();

        // 既に倫理削除している場合
        if(!$evaluation) {
            return redirect(route('lessons.evaluation.complete'));
        }

        // 担当のユーザーでない場合、トップページにリダイレクト
        if($user_id !== $evaluation->user_student_id) {
            return redirect(route('home'));
        }

        // セッションを入れる
        $request->session()->put('id', $evaluation->id);
        return view('lessons.evaluation-create');
    }

    /**
     * 講師評価実行処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function storeEvaluation(StoreEvaluation $request)
    {
        // 対象の評価のID
        $evaluation = Evaluation::find(session()->get('id'));

        // 評価の更新
        $evaluation->point   = $request['point'];
        $evaluation->comment = $request['comment'];
        // $evaluation->delete();
        $evaluation->update();

        return redirect(route('lessons.evaluation.complete'));
    }

    /**
     * 講師評価完了ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function completeEvaluation(Request $request)
    {
        return view('lessons.evaluation-complete');
    }
}

<?php

use App\Http\Controllers\Auth\LoginController as UserLogin;
use App\Http\Controllers\Auth\Admin\LoginController as AdminLogin;
use App\Http\Controllers\Auth\ForgotPasswordController as UserForgotPassword;
use App\Http\Controllers\Auth\RegisterController as UserRegister;
use App\Http\Controllers\Auth\ResetPasswordController as UserResetPassword;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ユーザー認証
Route::get('login', [UserLogin::class, 'showLoginForm'])->name('login');
Route::post('login', [UserLogin::class, 'login']);
Route::post('logout', [UserLogin::class, 'logout'])->name('logout');

// 管理者認証
Route::get('admin-login', [AdminLogin::class, 'showLoginForm'])->name('admin.login');
Route::post('admin-login', [AdminLogin::class, 'login']);
Route::post('admin-logout', [AdminLogin::class, 'logout'])->name('admin.logout');

// パスワードリセット
Route::get('password-reset', [UserForgotPassword::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password-email', [UserForgotPassword::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password-reset/new/{token}', [UserResetPassword::class, 'showResetForm'])->name('password.reset');
Route::post('password-reset/new', [UserResetPassword::class, 'reset'])->name('password.update');
Route::get('password-reset/complete', [UserResetPassword::class, 'complete'])->name('password.complete');

// ユーザーログイン
Route::get('sign-up', [UserRegister::class, 'showEmailVerifyForm'])->name('email.verify');
Route::post('email-send', [UserRegister::class, 'emailVerify'])->name('email.verify.send');
Route::get('email-send/complete', [UserRegister::class, 'completeEmailSend'])->name('email.send.complete');
Route::get('sign-up/register/{token}', [UserRegister::class, 'showRegistrationForm'])->name('sign-up.show');
Route::post('sign-up/register/{token}', [UserRegister::class, 'register'])->name('sign-up.store');
Route::get('sign-up/complete', [UserRegister::class, 'completeRegister'])->name('sign-up.complete');

// 管理者認証
Route::prefix('owner-admin')->name('admins.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AdminLogin::class, 'showLoginForm'])->name('login');
        Route::post('login', [AdminLogin::class, 'login']);
    });
    Route::post('logout', [AdminLogin::class, 'logout'])->name('logout');
    Route::middleware('guest')->group(function () {
        // 認証後ページ
        // 出金：リクエスト
        Route::get('withdraw/request', [AdminController::class, 'requestWithdraws'])->name('withdraws.request');
        // 出金：履歴一覧
        Route::get('withdraw/history', [AdminController::class, 'historyWithdraws'])->name('withdraws.history');

        // ユーザー：一覧
        Route::get('users', [AdminController::class, 'indexUsers'])->name('users.index');
        // ユーザー：追加
        Route::get('users/add', [AdminController::class, 'createUsers'])->name('users.create');
        Route::post('users/store', [AdminController::class, 'storeUsers'])->name('users.store');
        // ユーザー：編集（詳細）
        Route::get('users/edit/{id}', [AdminController::class, 'editUsers'])->name('users.edit');
        Route::post('users/update', [AdminController::class, 'updateUsers'])->name('users.update');

        // コース：一覧
        Route::get('courses', [AdminController::class, 'indexCourses'])->name('courses.index');
        // コース：詳細
        Route::get('courses/detail/{id}', [AdminController::class, 'showCourses'])->name('courses.show');

        // メッセージ：一覧
        Route::get('messages', [AdminController::class, 'indexMessages'])->name('messages.index');

        // 取引(確定前)：一覧
        Route::get('deals-before', [AdminController::class, 'indexDealsBefore'])->name('deails-before.index');
        // 取引(確定後)：一覧
        Route::get('deals-after', [AdminController::class, 'indexDealsAfter'])->name('deails-after.index');

        // お知らせ：一覧
        Route::get('news', [AdminController::class, 'indexNews'])->name('news.index');
        Route::post('news', [AdminController::class, 'deleteNews'])->name('news.delete');
        // お知らせ：編集
        Route::get('news/edit/{id}', [AdminController::class, 'editNews'])->name('news.edit');
        Route::post('news/update/{id}', [AdminController::class, 'updateNews'])->name('news.update');
        // お知らせ：新規作成
        Route::get('news/add', [AdminController::class, 'createNews'])->name('news.create');
        Route::post('news/add', [AdminController::class, 'postNews'])->name('news.post');

        // クーポン：一覧
        Route::get('coupons', [AdminController::class, 'indexCoupons'])->name('coupons.index');
        // クーポン：編集
        Route::get('coupons/edit/', [AdminController::class, 'editCoupons'])->name('coupons.edit');
        // クーポン：新規作成
        Route::get('coupons/add', [AdminController::class, 'createCoupons'])->name('coupons.create');
    });
});

// レッスン
Route::prefix('lessons')->name('lessons.')->group(function () {
    // レッスン：一覧
    Route::get('/', [LessonController::class, 'index'])->name('index');
    // レッスン：カテゴリー別
    Route::get('categories', [LessonController::class, 'category'])->name('categories');
    // レッスン：詳細（※ detail/{id} のルートは、detail/*** の各ルートの一番下に書くこと）
    Route::get('detail/{id}', [LessonController::class, 'detail'])->name('detail');
    // レッスン：ログインが必須なページ
    Route::middleware('auth')->group(function () {
        // レッスン：予約
        Route::get('application', [LessonController::class, 'application'])->name('application');
        Route::post('application', [LessonController::class, 'applicationPost'])->name('application.post');
        // 決済画面
        Route::get('application/credit-payment', [LessonController::class, 'paymentCredit'])->name('credit-payment');
        Route::post('application/credit-payment', [LessonController::class, 'paymentCreditPost'])->name('credit-payment.post');
        Route::get('application/error', [LessonController::class, 'errorApplication'])->name('application.error');
        // 決済完了画面
        Route::get('application/complete', [LessonController::class, 'completeApplication'])->name('application.complete');
        Route::post('application/complete', [LessonController::class, 'completeApplicationPost'])->name('application.complete.post');
        // キャンセル
        Route::get('application/cancel', [LessonController::class, 'cancel'])->name('cancel');
        Route::post('application/cancel', [LessonController::class, 'doCancel'])->name('cancel.do');
        // キャンセル完了
        Route::get('application/cancel/complete', [LessonController::class, 'completeCancel'])->name('cancel.complete');
        // レッスン閲覧画面
        Route::get('browsing/{id}', [LessonController::class, 'browsing'])->name('browsing');
        // 評価完了
        Route::get('evaluation/complete', [LessonController::class, 'completeEvaluation'])->name('evaluation.complete');
        // 評価画面
        Route::get('evaluation/{url}', [LessonController::class, 'createEvaluation'])->name('evaluation.create');
        Route::post('evaluation', [LessonController::class, 'storeEvaluation'])->name('evaluation.update');
    });
});

// 講師一覧
Route::prefix('teachers')->name('teachers.')->group(function () {
    Route::get('/', [TeacherController::class, 'index'])->name('index');
    // レッスン：カテゴリー別
    Route::get('categories', [TeacherController::class, 'index'])->name('index');
    Route::get('/changeOrder', [TeacherController::class, 'changeOrder'])->name('changeOrder');
    Route::get('detail/{id}', [TeacherController::class, 'detail'])->name('detail');
});

// 講師管理画面
Route::prefix('mypage/t')->name('mypage.t.')->group(function () {
    Route::middleware('auth')->group(function () {
        // コース一覧
        Route::get('courses', [TeacherController::class, 'course'])->name('courses');
        // コース詳細
        Route::get('courses/detail/{courses_id}', [TeacherController::class, 'coursesDetail'])->name('courses.detail');
        // コース編集
        Route::post('courses/update', [TeacherController::class, 'updateCourses'])->name('courses.update');
        // コース：レッスン作成
        Route::post('courses/lesson/create', [TeacherController::class, 'createCourseLesson'])->name('courses.lesson.create');
        // コース：レッスン編集
        Route::post('courses/lesson/update', [TeacherController::class, 'updateCourseLesson'])->name('courses.lesson.update');
        // コース作成
        Route::get('courses/create', [TeacherController::class, 'createCourse'])->name('courses.create');
        Route::post('courses/store', [TeacherController::class, 'storeCourse'])->name('courses.store');
        // // レッスン作成
        Route::get('lessons/create', [TeacherController::class, 'createLessons'])->name('lessons.create');
        Route::post('lessons/store', [TeacherController::class, 'storeLessons'])->name('lessons.store');

        // レッスン編集
        Route::get('lessons/edit/{lesson_id}', [TeacherController::class, 'editLessons'])->name('lessons.edit');
        Route::post('lessons/update', [TeacherController::class, 'updateLessons'])->name('lessons.update');
        // レッスン削除
        Route::post('lessons/delete', [TeacherController::class, 'deleteLessons'])->name('lessons.delete');

        // プロフィール
        Route::get('profile', [StudentController::class, 'profile'])->name('profile');
        Route::post('profile/update', [StudentController::class, 'updateProfile'])->name('profile.update');
        Route::get('profile/password', [StudentController::class, 'editPassword'])->name('profile.password.edit');
        Route::post('profile/password', [StudentController::class, 'updatePassword'])->name('profile.password.update');

        // レッスン参加状況
        Route::get('lesson-participation', [TeacherController::class, 'lessonsParticipation'])->name('lessons.participation');
        Route::get('lesson-participation/{lessons_id}', [TeacherController::class, 'lessonParticipationUsers'])->name('lessons.participation.users');

        // キャンセルリクエスト
        Route::get('cancel-requests', [TeacherController::class, 'cancelRequests'])->name('cancel-requests');
        Route::post('cancel-requests', [TeacherController::class, 'doCancel'])->name('cancel.do');
        Route::post('block-application', [TeacherController::class, 'doBlock'])->name('block.do');

        // メッセージ
        Route::get('messages', [StudentController::class, 'messages'])->name('messages');
        Route::post('messages', [StudentController::class, 'sendMessages'])->name('messages.send');
        Route::get('messages/{partner_users_id}', [StudentController::class, 'messageDetail'])->name('messages.detail');

        // 入出金
        Route::get('trade', [StudentController::class, 'trade'])->name('trade');
        Route::post('csv/export', [WithdrawalController::class, 'csvExport'])->name('trade.csv.export');
        Route::get('trade/withdrawal', [WithdrawalController::class, 'withdrawalRequest'])->name('payment.create');
        Route::post('trade/withdrawal', [WithdrawalController::class, 'withdrawalRequestConfirmed'])->name('payment.store');
        Route::get('trade/withdrawal/complete', [WithdrawalController::class, 'withdrawalRequestCompleted'])->name('payment.complete');

        // 銀行口座
        Route::get('bank', [BankController::class, 'show'])->name('bank.show');
        Route::get('bank/edit', [BankController::class, 'edit'])->name('bank.edit');
        Route::post('bank/update', [BankController::class, 'update'])->name('bank.update');

        // 退会
        Route::get('withdrawal', [StudentController::class, 'createWithdrawal'])->name('withdrawal.create');
        Route::post('withdrawal', [StudentController::class, 'storeWithdrawal'])->name('withdrawal.store');

        // 切り替え
        Route::get('change', [TeacherController::class, 'change'])->name('change');
    });
});

// 受講者管理画面
Route::prefix('mypage/u')->name('mypage.u.')->group(function () {
    Route::get('withdrawal/complete', [StudentController::class, 'completeWithdrawal'])->name('withdrawal.complete');
    Route::middleware(['auth', 'student'])->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        // 受講予定レッスン
        Route::get('attendance-lessons', [StudentController::class, 'attendanceLessons'])->name('attendance-lessons');
        // 受講済みレッスン
        Route::get('taken-lessons', [StudentController::class, 'takenLessons'])->name('taken-lessons');

        // メッセージ
        Route::get('messages', [StudentController::class, 'messages'])->name('messages');
        Route::post('messages', [StudentController::class, 'sendMessages'])->name('messages.send');
        Route::get('messages/{partner_users_id}', [StudentController::class, 'messageDetail'])->name('messages.detail');

        // プロフィール
        Route::get('profile', [StudentController::class, 'profile'])->name('profile');
        Route::post('profile/update', [StudentController::class, 'updateProfile'])->name('profile.update');
        Route::get('profile/password', [StudentController::class, 'editPassword'])->name('profile.password.edit');
        Route::post('profile/password', [StudentController::class, 'updatePassword'])->name('profile.password.update');

        // 銀行口座
        // Route::get('bank', [BankController::class, 'show'])->name('bank.show');
        // Route::get('bank/edit', [BankController::class, 'edit'])->name('bank.edit');
        // Route::post('bank/update', [BankController::class, 'update'])->name('bank.update');

        // クレジットカード
        // Route::get('creditcards', [StudentController::class, 'creditcards'])->name('creditcards');
        // Route::get('creditcards/add', [StudentController::class, 'createCreditcards'])->name('creditcards.create');
        // Route::post('creditcards/store', [StudentController::class, 'storeCreditcards'])->name('creditcards.store');
        // Route::get('creditcards/edit', [StudentController::class, 'editCreditcards'])->name('creditcards.edit');
        // Route::post('creditcards/update', [StudentController::class, 'updateCreditcards'])->name('creditcards.update');

        // 入出金
        // Route::get('trade', [StudentController::class, 'trade'])->name('trade');
        // Route::get('trade/withdrawal', [StudentController::class, 'createPayment'])->name('payment.create');
        // Route::post('trade/withdrawal', [StudentController::class, 'storePayment'])->name('payment.store');
        // Route::get('trade/withdrawal/complete', [StudentController::class, 'completePayment'])->name('payment.complete');

        // 退会
        Route::get('withdrawal', [StudentController::class, 'createWithdrawal'])->name('withdrawal.create');
        Route::post('withdrawal', [StudentController::class, 'storeWithdrawal'])->name('withdrawal.store');
    });
    Route::get('change', [StudentController::class, 'change'])->name('change');
});

// 静的ページ
Route::name('pages.')->group(function () {
    Route::get('news', [PageController::class, 'news' ])->name('news');
    Route::get('news/detail/{id}', [PageController::class, 'newsDetail'])->name('news.detail');
    // Route::get('company', [PageController::class, 'company'])->name('company');
    // Route::get('terms-service', [PageController::class, 'termsService'])->name('terms-service');
    // Route::get('terms-point', [PageController::class, 'termsPoint'])->name('terms-point');
    Route::get('terms-user', [PageController::class, 'termsUser'])->name('terms-user');
    Route::get('terms-teacher', [PageController::class, 'termsTeacher'])->name('terms-teacher');
    Route::get('tokushoho', [PageController::class, 'tokushoho'])->name('tokushoho');
    Route::get('faq-user', [PageController::class, 'faqUser'])->name('faq-user');
    Route::get('faq-teacher', [PageController::class, 'faqTeacher'])->name('faq-teacher');
    // キャンセルポリシー
    Route::get('cancel-user', [PageController::class, 'cancelUser'])->name('cancel-user');
    Route::get('cancel-teacher', [PageController::class, 'cancelTeacher'])->name('cancel-teacher');
    Route::get('flow', [PageController::class, 'flow'])->name('flow');
});

// 検索
Route::get('search', [SearchController::class, 'index'])->name('search.index');

/* お問い合わせ */
// 入力画面
Route::get('contact', [ContactController::class, 'index'])->name('contact');
// 送信完了
Route::post('contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('contact/complete', [ContactController::class, 'complete'])->name('contact.complete');

//講師ご希望の方へ, 初めての方へ
Route::get('/for-first', function () {
    return view('okeicom.first');
});
Route::get('/for-teacher', function () {
    return view('okeicom.teacher');
});
Route::get('/zoom', function () {
    return view('okeicom.zoom');
});
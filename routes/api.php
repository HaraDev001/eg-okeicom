<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ManageController;
use App\Http\Controllers\Api\LessonsController;
use App\Http\Controllers\Api\v1\AnnouncementController;
use App\Http\Controllers\Api\v1\ApplicationController;
use App\Http\Controllers\Api\v1\CourseController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\PrefectureController;
use App\Http\Controllers\Api\v1\MessageController;
use App\Http\Controllers\Api\v1\WithdrawalController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// コースAPI
Route::resource('v1/courses', CourseController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
// ユーザーAPI
Route::resource('v1/users', UserController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
// レッスンAPI
Route::resource('v1/lessons', LessonsController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
// 取引API
Route::resource('v1/applications', ApplicationController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
// 出金リクエストAPI
Route::resource('v1/withdrawals', WithdrawalController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
// お知らせAPI
Route::resource('v1/announcements', AnnouncementController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
// メッセージAPI
Route::resource('v1/messages', MessageController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
// カテゴリーAPI
Route::resource('v1/categories', CategoryController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
// 都道府県API
Route::resource('v1/prefectures', PrefectureController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

// 管理者認証
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        // 認証済みルート

        // 管理者
        Route::apiResource('/manages', ManageController::class);

    });
});

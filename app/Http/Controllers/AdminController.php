<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use App\Models\Lesson;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * ユーザ一覧
     *
     * @param Request $request
     * @return Factory|View
     */
    public function indexUsers(Request $request)
    {
        return view('admins.users-index');
    }

    /**
     * ユーザ一追加ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function createUsers(Request $request)
    {
        return view('admins.users-create');
    }

    /**
     * ユーザ一登録処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function storeUsers(Request $request)
    {
        return redirect(route('admins.users.index'));
    }

    /**
     * ユーザ一編集ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function editUsers(Request $request)
    {
        $userId = $request->id;
        // $userDate = User::find($userId);
        $userNew = new User();
        $userDate = $userNew->getTeachersShow($userId);
        $categories = Category::all();
        return view('admins.users-edit', compact('userDate', 'categories'));
    }

    /**
     * ユーザ一更新処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function updateUsers(Request $request)
    {
        return redirect(route('admins.users-update'));
    }

    /**
     * コース：一覧
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function indexCourses(Request $request)
    {
        return view('admins.courses-index');
    }


    /**
     * コース；詳細
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function showCourses(Request $request)
    {
        return view('admins.courses-show');
    }

    /**
     * メッセージ一覧
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function indexMessages(Request $request)
    {
        return view('admins.messages-index');
    }

    /**
     * 出金リクエスト
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function requestWithdraws(Request $request)
    {
        return view('admins.withdraws-request');
    }

    /**
     * 出金履歴
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function historyWithdraws(Request $request)
    {
        return view('admins.withdraws-history');
    }

    /**
     * 取引(確定前)：一覧
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function indexDealsBefore(Request $request)
    {
        return view('admins.deals-before-index');
    }

    /**
     * 取引(確定後)：一覧
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function indexDealsAfter(Request $request)
    {
        return view('admins.deals-after-index');
    }

    /**
     * お知らせ：一覧
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function indexNews(Request $request)
    {
        $announcements = Announcement::all();
        return view('admins.news-index', compact('announcements'));
    }

    /**
     * お知らせ：削除
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function deleteNews(Request $request)
    {
        $announcement = Announcement::find($request->get('id'))->delete();
        return redirect(route('admins.news.index'));
    }

    /**
     * お知らせ：編集
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function editNews($id)
    {
        $announcement = Announcement::find($id)->first();
        return view('admins.news-edit', compact('announcement'));
    }

    /**
     * お知らせ：更新
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function updateNews(Request $request, $id)
    {
        Announcement::where('id', $id)
            ->update([
                'title' => $request->title,
                'thumbnail' => $request->thumbnail,
                'detail' => $request->detail,
            ]);
        return redirect(route('admins.news.edit', $id));
    }

    /**
     * お知らせ：追加
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function createNews(Request $request)
    {
        return view('admins.news-create');
    }

    /**
     * お知らせ：投稿
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function postNews(Request $request)
    {
        $AnnouncementNew = new Announcement();
        $AnnouncementNew->create([
            'title' => $request->title,
            'thumbnail' => $request->thumbnail,
            'detail' => $request->detail,
        ]);
        return redirect(route('admins.news.index'));
    }

    /**
     * クーポン：一覧
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function indexCoupons(Request $request)
    {
        // return view('admins.news-index');
    }

    /**
     * クーポン：編集
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function editCoupons(Request $request)
    {
        // return view('admins.news-create');
    }

    /**
     * クーポン：追加
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function createCoupons(Request $request)
    {
        // return view('admins.news-create');
    }
}





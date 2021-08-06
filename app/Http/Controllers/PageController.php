<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    // 静的ページコントローラー

    /**
     * お知らせ一覧ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function news(Request $request)
    {
        return view('pages.news');
    }

    /**
     * お知らせ詳細ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function newsDetail(Request $request)
    {
        return view('pages.news-detail');
    }

    /**
     * 運営者情報ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    // public function company(Request $request)
    // {
    //     return view('pages.company');
    // }

    /**
     * サービス規約ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function termsService(Request $request)
    {
        return view('pages.terms-service');
    }

    /**
     * ポイント規約ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function termsPoint(Request $request)
    {
        return view('pages.terms-point');
    }

    /**
     * 受講者規約ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function termsUser(Request $request)
    {
        return view('pages.terms-user');
    }

    /**
     * 講師規約ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function termsTeacher(Request $request)
    {
        return view('pages.terms-teacher');
    }

    /**
     * 特商法に基づく表示ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function tokushoho(Request $request)
    {
        return view('pages.tokushoho');
    }

    /**
     * 受講者よくある質問ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function faqUser(Request $request)
    {
        return view('pages.faq-user');
    }

    /**
     * 講師よくある質問ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function faqTeacher(Request $request)
    {
        return view('pages.faq-teacher');
    }

    /**
     * 流れ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function flow(Request $request)
    {
        return view('pages.flow');
    }

    /**
     * 受講者キャンセルポリシー
     *
     * @param Request $request
     * @return Factory|View
     */
    public function cancelUser(Request $request)
    {
        return view('pages.cancel-user');
    }

    /**
     * 講師キャンセルポリシー
     *
     * @param Request $request
     * @return Factory|View
     */
    public function cancelTeacher(Request $request)
    {
        return view('pages.cancel-teacher');
    }
}

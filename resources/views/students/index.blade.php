@extends('layouts.user')

{{--  タイトル・メタディスクリプション  --}}
@section('title', 'ダッシュボード')
@section('description', '受講者ダッシュボード')

{{--  CSS  --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/dashboard.css') }}">
@endpush

{{--  本文  --}}
@section('content')
<div class="dashboard">
    <div class="dashboard-content">
        <div class="dashboard-content-list"><a href="">講師管理画面と切り替える</a></div>
    </div>
    <div class="dashboard-content">
        <div class="dashboard-content-list"><a href="{{ route('mypage.u.attendance-lessons') }}">受講レッスン</a></div>
        <div class="dashboard-content-list"><a href="{{ route('mypage.u.messages') }}">メッセージ</a></div>
        <div class="dashboard-content-list"><a href="{{ route('mypage.u.profile') }}">プロフィール</a></div>
        {{-- <div class="dashboard-content-list"><a href="{{ route('mypage.u.creditcards') }}">クレジットカード情報</a></div> --}}
        {{-- <div class="dashboard-content-list"><a href="{{ route('mypage.u.index') }}">銀行口座情報</a></div> --}}
        <div class="dashboard-content-list"><a href="{{ route('mypage.u.trade') }}">入出金管理</a></div>
    </div>
    <div class="dashboard-content">
        {{--  <div class="dashboard-content-list"><a href="{{ route('news') }}">お知らせ</a></div>  --}}
        <div class="dashboard-content-list"><a href="{{ route('contact') }}">運営にお問い合わせ</a></div>
    </div>
    <div class="dashboard-content">
        <div class="dashboard-content-list"><a href="{{ route('lessons.index') }}">レッスンを探す</a></div>
        <div class="dashboard-content-list"><a href="{{ route('teachers.index') }}">講師を探す</a></div>
        <div class="dashboard-content-list"><a href="{{ route('logout') }}">ログアウト</a></div>
    </div>
</div>
@endsection


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>受講者ダッシュボード</h2>
            <div>
                <a class="" href="{{ route('mypage.u.attendance-lessons') }}">
                    {{ __('Menu Attendance Lesson') }}
                </a>
            </div>
            <div>
                <a class="" href="{{ route('mypage.u.messages') }}">
                    {{ __('Menu Messages') }}
                </a>
            </div>
            <div>
                <a class="" href="{{ route('mypage.u.profile') }}">
                    {{ __('Menu Profile') }}
                </a>
            </div>
            <div>
                <a class="" href="{{ route('mypage.u.creditcards') }}">
                    {{ __('Menu CreditCard') }}
                </a>
            </div>
            <div>
                <a class="" href="{{ route('mypage.u.index') }}">
                    {{ __('Menu Bank') }}
                </a>
            </div>
            <div>
                <a class="" href="{{ route('mypage.u.trade') }}">
                    {{ __('Menu Trade') }}
                </a>
            </div>
            <div>
                <a class="" href="{{ route('lessons.index') }}">
                    {{ __('Menu Search Lesson') }}
                </a>
            </div>
            <div>
                <a class="" href="{{ route('teachers.index') }}">
                    {{ __('Menu Search Teacher') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection --}}




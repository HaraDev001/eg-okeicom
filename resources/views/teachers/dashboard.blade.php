@extends('layouts.teacher')

<!-- タイトル・メタディスクリプション -->
@section('title', 'ダッシュボード')
@section('description', 'ダッシュボード')

<!-- CSS -->
@push('css')
	<link rel="stylesheet" href="{{ asset('/css/foundation/single/dashboard.css') }}">
@endpush

<!-- 本文 -->
@section('content')
	<div class="dashboard">
		<div class="dashboard-content">
			<div class="dashboard-content-list"><a href="{{ route('mypage.t.courses') }}">登録済みコース</a></div>
			<div class="dashboard-content-list"><a href="{{ route('mypage.t.message') }}">レッスン参加状況</a></div>
			<div class="dashboard-content-list"><a href="{{ route('mypage.t.lessons.participation') }}">キャンセル依頼</a></div>
			<div class="dashboard-content-list"><a href="{{ route('mypage.t.message') }}">メッセージ</a></div>
			<div class="dashboard-content-list"><a href="{{ route('mypage.t.trade') }}">プロフィール</a></div>
			<div class="dashboard-content-list"><a href="{{ route('mypage.t.trade') }}">入出金一覧</a></div>
			<!-- <div class="dashboard-content-list"><a href="">クレジットカード情報</a></div> -->
			<!-- <div class="dashboard-content-list"><a href="">銀行口座情報</a></div> -->
			<!-- <div class="dashboard-content-list"><a href="">クーポン発行</a></div> -->
		</div>
		<div class="dashboard-content">
			<div class="dashboard-content-list"><a href="{{ route('news') }}">お知らせ</a></div>
			<div class="dashboard-content-list"><a href="{{ route('contact') }}">運営にお問い合わせ</a></div>
			<div class="dashboard-content-list"><a href="{{ route('logout') }}">ログアウト</a></div>
		</div>
	</div>
@endsection

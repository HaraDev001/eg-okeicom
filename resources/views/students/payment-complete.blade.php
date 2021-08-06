@extends('layouts.teacher-single')

{{--  タイトル・メタディスクリプション  --}}
@section('title', '出金リクエスト完了')
@section('description', '出金リクエスト完了')

{{--  CSS  --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/teacher.css') }}">
@endpush

{{--  本文  --}}
@section('content')
	<div class="l-wrap--single">
		<div class="l-wrap--title">
			<h1 class="c-headline--screen">出金リクエスト完了</h1>
		</div>

		<div class="l-wrap--body">
			<div class="l-wrap--main l-wrap--detail">
				<div class="l-content--detail">
					<div class="l-content--detail__inner">
            <p class="u-text--sentence u-mb10">出金リクエストが完了しました。<br>10営業日以内に、返金手続きを行います。</p>
            <a href="{{ route('mypage.t.courses') }}" class="u-text--link">ダッシュボードへ戻る</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>出金リクエスト完了</h2>
        </div>
    </div>
</div>
@endsection --}}

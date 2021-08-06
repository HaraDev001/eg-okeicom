{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>クレジットカード決済失敗</h2>
            </div>
        </div>
    </div>
@endsection --}}


@extends('layouts.single')

{{-- タイトル・メタディスクリプション --}}
@section('title', 'クレジットカード決済 | おけいcom')
@section('description', 'おけいcomのクレジットカード決済ページです。')

{{-- CSS --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/lessonApplication.css') }}">
@endpush

{{-- 本文 --}}
@section('content')
<div class="l-wrap--single">
	<div class="l-wrap--title">
		<h1 class="c-headline--screen">クレジットカード決済エラー</h1>
	</div>
	<div class="l-wrap--body">
		<div class="l-wrap--main l-wrap--detail">
			<div class="l-content--detail">
				<div class="l-content--detail__inner">
                    <p class="u-text--sentence u-mb20">サービスに不具合が生じております。お手数ですが、運営元へお問い合わせくださいませ。</p>
					<!-- <p class="u-text--sentence u-mb20">支払いに失敗しました。<br>以下メッセージを確認の上、もう一度手続きをお願いいたします。</p> -->
					<!-- <div class="c-text--attention bg-yellow u-mb20">
						<p>エラーメッセージエラーメッセージエラーメッセージ</p>
					</div> -->
					<a href="" class="u-text--link">レッスン詳細へ戻る</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

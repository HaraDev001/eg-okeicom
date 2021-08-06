{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            パスワードリセットが完了しました
        </div>
    </div>
</div>
@endsection --}}


@extends('layouts.single')

<!-- タイトル・メタディスクリプション -->
@section('title', 'パスワード再設定完了 | おけいcom')
@section('description', 'パスワード再設定完了')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
<div class="l-wrap--single login">
	<div class="l-wrap--title">
		<h1 class="c-headline--screen u-textAlign__center">パスワード再登録完了</h1>
	</div>
	<div class="l-wrap--body">
		<div class="l-wrap--main l-wrap--detail">
			<div class="l-content--detail">
				<div class="l-content--detail__inner">
					<p class="u-text--sentence u-mb20">パスワードの再登録が完了しました。<br>ログイン画面より、ログインをお願いいたします。</p>
					<a href="/login" class="u-text--link">ログイン画面へ</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
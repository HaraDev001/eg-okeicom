@extends('layouts.owner')

<!-- タイトル・メタディスクリプション -->
@section('title', 'ユーザー一覧 | おけいcom')
@section('description', 'ユーザー')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
	<div class="l-wrap--owner--main">
		<div class="l-wrap--owner--main--inner">
			<div class="l-wrap--owner--header">
				<div class="l-wrap--owner--header--title">
					<p>ユーザー一覧</p>
				</div>
				{{--  <div class="l-wrap--owner--header--button">
					<div class="c-button--add">
						<a href="">ユーザーを追加する</a>
					</div>
				</div>  --}}
			</div>
			<div class="l-wrap--owner--body">
				<div class="l-wrap--owner--body--inner">
					<admin-user-list />
				</div>
			</div>
		</div>
	</div>
@endsection

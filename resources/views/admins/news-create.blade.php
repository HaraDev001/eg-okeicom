@extends('layouts.owner')

{{--  タイトル・メタディスクリプション  --}}
@section('title', 'お知らせ新規作成 | おけいcom')
@section('description', 'お知らせ新規作成')

{{--  CSS  --}}
@push('css')

@endpush

{{--  JS  --}}
@push('js')
@endpush


{{--  本文  --}}
@section('content')
	<div class="l-wrap--owner--main single-page">
		<div class="l-wrap--owner--main--inner">
			<div class="l-wrap--owner--header">
				<div class="l-wrap--owner--header--title">
					<a href="{{ route('admins.news.index') }}" class="c-link--back">お知らせ一覧へ戻る</a>
                    <p>お知らせ作成</p>
				</div>
			</div>
			<div class="l-wrap--owner--body">
                <form method="post" action="{{ route('admins.news.post') }}">
                    @csrf
                    <div class="l-wrap--owner--body--inner u-mb10">
                        <div class="l-wrap--owner--body--news">
                            <input type="text" name="title" placeholder="タイトル">
                        </div>
                    </div>
                    <div class="l-wrap--owner--body--inner" style="padding: 0;">
                        <div class="l-wrap--owner--body--news">
                            <textarea id="ckeditor" name="detail"></textarea>
                        </div>
                    </div>
                    <div class="l-button--submit">
                        <button class="c-button--square__pink" type="submit">
                            投稿する
                        </button>
                    </div>
                </form>
			</div>
		</div>
    </div>
@endsection

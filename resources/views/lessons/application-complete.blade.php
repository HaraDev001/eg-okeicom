@extends((Auth::user()->status == 0)?'layouts.user-single':'layouts.teacher-single')

{{--  タイトル・メタディスクリプション  --}}
@section('title', 'クレジットカード決済完了 | おけいcom')
@section('description', 'おけいcomのクレジットカード決済完了ページです。')

{{--  CSS  --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/lessonApplication.css') }}">
@endpush

{{--  本文  --}}
@section('content')
<div class="l-wrap--single">
	<div class="l-wrap--title">
        <h1 class="c-headline--screen">レッスン購入完了</h1>
	</div>
	<div class="l-wrap--body">
		<div class="l-wrap--main l-wrap--detail">
			<div class="l-content--detail">
				<div class="l-content--detail__inner">
                    <p class="u-text--sentence u-mb20">購入が完了しました！</p>
                    <form method="POST" action="{{ route('lessons.application.complete.post') }}">
                        @csrf
                        <button class="u-text--link" >購入済みレッスン一覧へ</button>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@extends(($user_status == 0)?'layouts.user-single':'layouts.teacher-single')

<!-- タイトル・メタディスクリプション -->
@section('title', 'キャンセル完了')
@section('description', 'キャンセル完了')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/lessonCancel.css') }}">
@endpush

<!-- 本文 -->
@section('content')
    <div class="l-wrap--single">
        <div class="l-wrap--title">
            <h1 class="c-headline--screen">キャンセル完了</h1>
        </div>
        <div class="l-wrap--body">
            <div class="l-wrap--main l-wrap--detail">
                <div class="l-content--detail">
                    <div class="l-content--detail__inner">
                        <p class="u-text--sentence u-mb20">キャンセルが完了しました。<br>キャンセルの返金額は、クレジットカード会社によって返金されます。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

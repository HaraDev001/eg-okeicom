@extends(($user_status == 0)?'layouts.user-single':'layouts.teacher-single')

{{-- タイトル・メタディスクリプション --}} 
@section('title', '退会') 
@section('description', '退会') 

{{-- CSS --}} 
@push('css') 
@endpush 

{{-- 本文 --}} 
@section('content') 
{{-- エラーメッセージ --}} 
@if ($errors->any())
<div class="l-alart errorAlart" role="alert">
    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@endif

<div class="l-wrap--single">
    <div class="l-wrap--title">
        <a class="c-link--back u-mb5" href="{{ url()->previous() }}">前の画面に戻る</a>
        <h1 class="c-headline--screen">退会手続き</h1>
    </div>
    <div class="l-wrap--body">
        <div class="l-wrap--main l-wrap--detail">
            <div class="l-content--detail">
                <div class="l-content--detail__inner">
                    <p class="u-text--sentence u-mb20">退会した場合、以下のことができなくなってしまいます。</p>
                    <ul class="c-list--dot">
                        <li>契約済みレッスンが全て見れなくなる（返金不可）</li>
                        <li>現在保有しているお金が全てなくなる</li>
                        <li>メッセージが全て削除される</li>
                        <li>レッスンの予約</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="l-button--submit">

        <a class="c-button--square__pink" href="{{ route('mypage.u.withdrawal.store') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
        {{ __('Withdrawal') }}
        </a>

        <form id="logout-form" action="{{ route('mypage.u.withdrawal.store') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>
@endsection
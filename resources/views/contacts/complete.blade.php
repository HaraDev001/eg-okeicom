@extends('layouts.single')

<!-- タイトル・メタディスクリプション -->
@section('title', 'お問い合わせ完了 | おけいcom')
@section('description', 'お問い合わせ完了')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
@if (session('verify_failed'))
    <div class="l-alart errorAlart">
        <p> {{ session('verify_failed') }}</p>
    </div>
@endif
<div class="l-wrap--single login">
    <div class="l-wrap--title">
        <h1 class="c-headline--screen u-textAlign__center">お問い合わせ完了</h1>
    </div>
    <div class="l-wrap--body">
        <div class="l-wrap--main l-wrap--detail">
            <div class="l-content--detail">
                <div class="l-content--detail__inner">
                    <p class="u-text--sentence u-mb20">お問い合わせいただき、有難うございます。</p>
                    <p class="u-text--sentence">3営業日以内に、お返事させていただきます。</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

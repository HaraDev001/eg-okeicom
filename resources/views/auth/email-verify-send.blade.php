@extends('layouts.single')

<!-- タイトル・メタディスクリプション -->
@section('title', '新規登録 | おけいcom')
@section('description', '新規登録')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
<div class="l-wrap--single login">
    <div class="l-wrap--title">
        <h1 class="c-headline--screen u-textAlign__center">仮会員登録完了</h1>
    </div>
    <div class="l-wrap--body">
        <div class="l-wrap--main l-wrap--detail">
            <div class="l-content--detail">
                <div class="l-content--detail__inner">
                    <p class="u-text--sentence u-mb20">ご登録いただき、誠にありがとうございます。<br>ご本人様確認のため、ご登録いただいたメールアドレスに、本登録のご案内のメールが届きます。
                    <p class="u-text--sentence u-mb20">{{ $hours }}時間以内にメールに記載されているリンクにアクセスし、アカウントの本登録を完了させてください。</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

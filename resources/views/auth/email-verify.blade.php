@extends('layouts.single')

<!-- タイトル・メタディスクリプション -->
@section('title', '新規登録 | おけいcom')
@section('description', '新規登録')

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
        <h1 class="c-headline--screen u-textAlign__center">新規登録</h1>
    </div>
    <div class="l-wrap--body">
        <div class="l-wrap--main l-wrap--detail">
        <div class="l-wrap--main l-wrap--detail">

            <div class="l-content--detail">

                <div class="l-content--detail__inner">
                    <form method="POST" action="{{ route('email.verify.send') }}">
                    @csrf
                        <div class="l-content--input">
                            <p class="l-content--input__headline">メールアドレス</p>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="u-color--red" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="l-button--submit">
                            <button class="c-button--square__pink" type="submit">仮登録</button>
                        </div>
                        <div class="l-content--inputLink">
                            <ul>
                                <li><a href="{{ route('login') }}" class="u-text--link">ログインはコチラ</a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

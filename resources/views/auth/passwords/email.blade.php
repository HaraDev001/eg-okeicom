{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}



@extends('layouts.single')

{{-- タイトル・メタディスクリプション --}}
@section('title', 'パスワード再設定完了 | おけいcom')
@section('description', 'パスワード再設定完了')

{{-- CSS --}}
@push('css')
@endpush

{{-- 本文 --}}
@section('content')
    @error('email')
        <div class="l-alart errorAlart" role="alert">
            <p>メールアドレスの登録がありません。</p>
        </div>
    @enderror
    <div class="l-wrap--single login">
        <div class="l-wrap--title">
            <h1 class="c-headline--screen u-textAlign__center">パスワードを忘れた方</h1>
        </div>
        <div class="l-wrap--body">
            <div class="l-wrap--main l-wrap--detail">
                <div class="l-content--detail">
                    <div class="l-content--detail__inner">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="l-content--input">
                                <p class="l-content--input__headline">メールアドレス</p>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                            <div class="l-button--submit">
                                <button type="submit" class="c-button--square__pink">パスワード再登録URL送信</button>
                            </div>
                            <div class="l-content--inputLink">
                                <ul>
                                    <li class="u-mb10"><a href="{{ route('login') }}" class="u-text--link">ログイン画面はコチラ</a></li>
                                    <li><a href="{{ route('email.verify') }}" class="u-text--link">新規登録はコチラ</a></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

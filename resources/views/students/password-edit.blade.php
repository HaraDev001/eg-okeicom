@extends('layouts.user')

{{--  タイトル・メタディスクリプション  --}}
@section('title', 'プロフィール')
@section('description', 'プロフィール')

{{--  CSS  --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/teacher.css') }}">
@endpush

{{--  本文  --}}
@section('content')
@error('old_password')
    <div class="l-alart errorAlart" role="alert">
        <p>{{ $message }}</p>
    </div>
@enderror
@error('password')
    <div class="l-alart errorAlart" role="alert">
        <p>{{ $message }}</p>
    </div>
@enderror
    <form method="POST" action="{{ route('mypage.u.profile.password.update') }}">
        @csrf
        <div class="c-list--table">
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">旧パスワード</p>
                </div>
                <div class="c-list--td">
                    <input type="password" name="old_password" class="c-input--fixed" required>
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">新パスワード</p>
                    <p class="sub">英数字6文字以上です。</p>
                </div>
                <div class="c-list--td">
                    <input type="password" name="password" class="c-input--fixed" required>
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">新パスワード確認用</p>
                </div>
                <div class="c-list--td">
                    <input type="password" name="password_confirm" class="c-input--fixed" required>
                </div>
            </div>
        </div>
        <div class="l-button--submit">
            <button type="subit" class="c-button--square__pink">変更内容を保存する</button>
        </div>
    </form>
@endsection



{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>パスワード変更</h2>
            <form method="POST" action="{{ route('mypage.u.profile.password.update') }}">
                @csrf

                <div class="form-group row">
                    <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                    <div class="col-md-6">
                        <input type="password" id="old_password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" required>

                        @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input type="password" id="password_confirm" name="password_confirmation" class="form-control" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
 --}}

@extends('layouts.app')

<!-- タイトル・メタディスクリプション -->
@section('title', '退会完了')
@section('description', '退会完了')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
    <div class="l-wrap--single">
        <div class="l-wrap--title">
            <h1 class="c-headline--screen">退会完了</h1>
        </div>
        <div class="l-wrap--body">
            <div class="l-wrap--main l-wrap--detail">
                <div class="l-content--detail">
                    <div class="l-content--detail__inner">
                        <p class="u-text--sentence u-mb20">退会完了しました！<br>引き続き、おけい.comをお楽しみくださいませ！</p>
                        <a href="{{ route('home') }}" class="u-text--link">トップページへ戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>退会完了</h2>
                <p>退会完了しました！</p>
                <p>引き続き、おけい.comをお楽しみくださいませ！</p>
                <a class="" href="{{ route('home') }}">
                    トップページに戻る
                </a>
            </div>
        </div>
    </div>

@endsection --}}

@extends('layouts.single')

<!-- タイトル・メタディスクリプション -->
@section('title', '新規登録フォーム | おけいcom')
@section('description', '新規登録フォーム')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
<div class="l-wrap--single">
    <div class="l-wrap--title">
        <h1 class="c-headline--screen u-textAlign__center">新規登録</h1>
        <p style="margin-top: 1em;">受講者及び講師としての登録になります。<br>登録完了後、「コース」を作成すれば、自動的に講師としての登録が完了します。</p>
    </div>
    <div class="l-wrap--body">
        <div class="l-wrap--main l-wrap--detail">

            <div class="l-content--detail">
                <form method="POST" action="{{ route('sign-up.store', ['token' => $token]) }}">
                @csrf
                    <div class="l-content--detail__inner">
                        <div class="l-content--input">
                            <p class="l-content--input__headline must">アカウント名（ログインするときに使用する名前 / ローマ字・半角数字のみ）</p>
                            <input id="account" type="text" class="form-control @error('account') is-invalid @enderror" name="account" value="{{ old('account') }}" required autocomplete="account" autofocus placeholder="例）okeicom">
                            @error('account')
                                <span class="u-color--red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline must">ユーザーネーム（プロフィールで表示される名前）</p>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="ユーザーネーム">
                            @error('name')
                                <span class="u-color--red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline must">メールアドレス</p>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email }}" required autocomplete="email" readonly>
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline must">電話番号</p>
                            <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel" placeholder="00011112222">
                        </div>
                        <!--
                            メールアドレスは、認証で設定したメールアドレスを使用したいです！そのため、入力不要にしたいです。
                        -->
                        <div class="l-content--input">
                            <p class="l-content--input__headline must">パスワード（半角数字8文字以上）</p>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="u-color--red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline must">確認用パスワード</p>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline must">性別</p>
                            <div class="c-selectBox u-w150">
                                <select id="sex" name="sex" class="form-control @error('sex') is-invalid @enderror" required autocomplete="sex">
                                    @foreach ($sexes as $key => $value)
                                        <option value="{{ $key }}" @if(old('sex') == $key) selected  @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('sex')
                                <span class="u-color--red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="l-content--input">
                            <p class="l-content--input__headline">国籍</p>
                            <input type="" name="" placeholder="国籍">
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline">言語</p>
                            <input type="" name="" placeholder="言語">
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline">都道府県</p>
                            <input type="" name="" placeholder="都道府県">
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline">カテゴリー（最低1つ）</p>
                            <div class="c-selectBox u-mb5">
                                <select>
                                    <option>カテゴリー1</option>
                                    <option>カテゴリー2</option>
                                    <option>カテゴリー3</option>
                                    <option>カテゴリー4</option>
                                    <option>カテゴリー5</option>
                                    <option>カテゴリー6</option>
                                    <option>カテゴリー7</option>
                                </select>
                            </div>
                            <div class="c-selectBox u-mb5">
                                <select>
                                    <option>カテゴリー1</option>
                                    <option>カテゴリー2</option>
                                    <option>カテゴリー3</option>
                                    <option>カテゴリー4</option>
                                    <option>カテゴリー5</option>
                                    <option>カテゴリー6</option>
                                    <option>カテゴリー7</option>
                                </select>
                            </div>
                            <div class="c-selectBox u-mb5">
                                <select>
                                    <option>カテゴリー1</option>
                                    <option>カテゴリー2</option>
                                    <option>カテゴリー3</option>
                                    <option>カテゴリー4</option>
                                    <option>カテゴリー5</option>
                                    <option>カテゴリー6</option>
                                    <option>カテゴリー7</option>
                                </select>
                            </div>
                            <div class="c-selectBox u-mb5">
                                <select>
                                    <option>カテゴリー1</option>
                                    <option>カテゴリー2</option>
                                    <option>カテゴリー3</option>
                                    <option>カテゴリー4</option>
                                    <option>カテゴリー5</option>
                                    <option>カテゴリー6</option>
                                    <option>カテゴリー7</option>
                                </select>
                            </div>
                            <div class="c-selectBox">
                                <select>
                                    <option>カテゴリー1</option>
                                    <option>カテゴリー2</option>
                                    <option>カテゴリー3</option>
                                    <option>カテゴリー4</option>
                                    <option>カテゴリー5</option>
                                    <option>カテゴリー6</option>
                                    <option>カテゴリー7</option>
                                </select>
                            </div>
                        </div> --}}
                        {{-- <div class="l-content--input">
                            <p class="l-content--input__headline">プロフィール画像</p>
                            <div class="imageBox">
                                <div class="imageBox-picture c-img--cover">
                                    <img :src="data.image">
                                </div>
                                <span class="imageBox-icon">
                                    <div class="imageBox-icon__inner">
                                        <img src="/public/img/icon-camera-black.png">
                                        <input type="file" ref="file" @change="setImage"/>
                                    </div>
                                </span>
                            </div>
                        </div> --}}
                        <div class="l-content--input">
                            <p class="l-content--input__headline any">プロフィール</p>
                            <textarea id="profile" class="form-control @error('profile') is-invalid @enderror" name="profile" autocomplete="profile" cols="50" rows="10">{{ old('profile') }}</textarea>
                            @error('profile')
                            <span class="u-color--red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="l-button--submit">
                        <button class="c-button--square__pink" type="subit" name="">新規登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

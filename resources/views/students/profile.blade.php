@extends(($user_status == 0)?'layouts.user':'layouts.teacher')

{{-- タイトル・メタディスクリプション --}}
@section('title', 'プロフィール')
@section('description', 'プロフィール')

{{-- CSS --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/teacher.css') }}">
@endpush

{{-- 本文 --}}
@section('content')
@if($errors->any())
    <div class="l-alart errorAlart" role="alert">
        @foreach ($errors->all() as $error)
            <p>{{ $error ?? '' }}</p>
        @endforeach
    </div>
@endif
@if (session('flash_message'))
    <div class="flash_message">
        <p>{{ session('flash_message') }}</p>
    </div>
@endif

<form method="POST" action="@if(Auth::user()->status == 0) {{ route('mypage.u.profile.update') }} @else {{ route('mypage.t.profile.update') }} @endif" enctype="multipart/form-data">
    @csrf
    <div class="c-list--table">
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">プロフィール画像</p>
            </div>
            <user-profile-upload-img-component
                img="{{ $user['img'] }}"
            />
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">アカウント名</p>
                <p class="sub">アカウント名は変更できません。</p>
            </div>
            <div class="c-list--td">
                <input class="c-input--fixed" disabled type="text" id="account" name="account" class="form-control" value="{{ $user->account }}" readonly>
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">ユーザーネーム</p>
                <p class="sub">サイトに表示する名前です。<br>20文字以内です。</p>
            </div>
            <div class="c-list--td">
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" required>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">メールアドレス</p>
            </div>
            <div class="c-list--td">
                <input type="text" name="email" value="{{ $user->email }}">
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">パスワード</p>
            </div>
            <div class="c-list--td">
                <a href="{{ route('mypage.u.profile.password.edit') }}" class="u-text--link">パスワードを変更する</a>
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">性別</p>
                <p class="sub">性別は変更できません。</p>
            </div>
            <div class="c-list--td">
                <input class="c-input--fixed" disabled type="text" id="sex" name="sex" class="form-control" value="{{ $user->sex_name }}" readonly>
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">国籍</p>
            </div>
            <div class="c-list--td">
                <input type="text" name="country_id" value="{{ $user->country_id }}">
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">言語</p>
            </div>
            <div class="c-list--td">
                <input type="text" name="language_id" value="{{ $user->language_id }}">
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">都道府県</p>
            </div>
            <div class="c-list--td">
                <div class="c-selectBox">
                    <select name="prefecture_id">
                        @foreach ($prefecturies as $prefecture)
                            @if ($user->prefecture_id === $prefecture->id)
                            <option value="{{ $prefecture->id }}" selected="selected">{{ $prefecture->name }}</option>
                            @else
                            <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">カテゴリー</p>
            </div>
            <div class="c-list--td">
                <select-list-category-component
                    :user="{{ json_encode($user) }}"
                    :category-list={{ $categories }}
                />
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">プロフィール</p>
                <p class="sub">1000文字以内です。</p>
            </div>
            <div class="c-list--td">
                <textarea id="profile" name="profile" class="form-control @error('profile') is-invalid @enderror" cols="50" rows="10">{{ $user->profile }}</textarea>
                @error('profile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="l-button--submit">
        <button type="submit" class="c-button--square__pink">変更内容を保存する</button>
    </div>
</form>
@endsection

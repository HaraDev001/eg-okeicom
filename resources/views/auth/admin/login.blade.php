<!DOCTYPE html>
<html>
@include("./../../common/head")
<link rel="stylesheet" href="{{ asset('css/foundation/single/ownerLogin.css') }}">
<body>
    <div id="app" class="l-manage">
        <div class="owner-login-wrap">
            <div class="owner-login-input">
                <form method="POST" action="{{ route('admins.login') }}">
                @csrf
                    <div class="owner-login-input-content">
                        <p>メールアドレス</p>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="u-color--red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="owner-login-input-content">
                        <p>パスワード</p>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="u-color--red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="owner-login-input-content">
                        <button type="submit">ログイン</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include("../common/footer-owner")
</body>

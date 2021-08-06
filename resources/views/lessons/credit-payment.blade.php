@extends(($user_status == 0)?'layouts.user-single':'layouts.teacher-single')

<!-- タイトル・メタディスクリプション -->
@section('title', 'レッスン予約 | おけいcom')
@section('description', 'おけいcomのレッスン予約ページです。')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/lessonApplication.css') }}">
<link rel="stylesheet" href="https://linkpt.cardservice.co.jp/api/token/1.0/zeus_token.css">
@endpush

@push('js')
<script type="text/javascript" src="https://linkpt.cardservice.co.jp/api/token/1.0/zeus_token_cvv.js"></script>
@endpush

<!-- 本文 -->
@section('content')

{{--  エラーメッセージ  --}}
@if ($errors->any())
<div class="l-alart errorAlart" role="alert">
    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@endif
<div class="l-wrap--single">
    <form method="POST" action="{{ route('lessons.credit-payment.post') }}" name="form1">
        @csrf
        <div class="l-wrap--title">
            <a class="c-link--back u-mb5" href="">予約確認画面へ戻る</a>
            <h1 class="c-headline--screen">クレジットカード決済</h1>
        </div>
        <div class="l-wrap--body">
            <div class="l-wrap--main l-wrap--detail">
                <div class="l-content--detail">
                    <div class="c-headline--block">金額</div>
                    <div class="l-content--detail__inner">
                        <p class="u-textAlign__center u-text--big">{{ $lesson->separate_comma_price }}</p>
                    </div>
                </div>
                <div class="l-content--detail">
                    <div class="c-headline--block">クレジットカード情報</div>
                    <div class="l-content--detail__inner">
                        <div class="l-content--input">
                            <p class="l-content--input__headline">クレジットカード番号</p>
                            <input type="text" name="number" pattern="^[1-9][0-9]*$" placeholder="0000111122223333" value="{{ old('number') }}">
                        </div>
                        <div class="l-content--input">
                            <div class="l-flex">
                                <div class="l-content--input__two">
                                    <div class="l-content--input__headline">有効期限（年）</div>
                                    <input type="text" name="year" pattern="^[1-9][0-9]*$" placeholder="2021" value="{{ old('year') }}">
                                </div>
                                <div class="l-content--input__two">
                                    <div class="l-content--input__headline">有効期限（月）</div>
                                    <input type="text" name="month" pattern="^[0-1][0-9]*$" placeholder="00" value="{{ old('month') }}">
                                </div>
                            </div>
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline">カード名義人</p>
                            <input type="text" name="name" placeholder="SAMPLE SAMPLE" value="{{ old('name') }}">
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline">セキュリティコード</p>
                            <input type="text" name="cvv" class="u-w150" pattern="^[0-9][0-9][0-9]*$" placeholder="000" value="{{ old('cvv') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--
        <div class="l-button--confirm">
            <div class="l-button--confirm__inner">
                <input type="checkbox" name="" id="class">
                <label for="class">クレジットカード情報を登録する（自動的にメインになります）</label>
            </div>
        </div>
        -->
        <div class="l-button--submit">
            <button id="btn_go_to_confirm_page" type="submit" class="c-button--square__pink">決済する</button>
        </div>
        <script>
            var zeusTokenIpcode = "2014003669"; // ゼウス発行のIPCODE(10桁または5桁)
            function beforeSubmit() {
                zeusToken.getToken(function(zeus_token_response_data) {
                    // ここにトークン発行後の処理を入れてください。
                    if (!zeus_token_response_data['result']) {
                        alert(zeusToken.getErrorMessage(zeus_token_response_data['error_code'])); // エラーの場合
                    } else {
                        document.form1.submit(); // フォーム送信（カード情報のかわりにトークンキーが送信されます）
                    }
                });
            }
            window.onload = function() {
                document.getElementById('btn_go_to_confirm_page').onclick = function () {
                    beforeSubmit(); // フォーム送信ボタンのonclickイベントで、上記関数を呼出します。
                }
            };
        </script>
    </form>
</div>
@endsection

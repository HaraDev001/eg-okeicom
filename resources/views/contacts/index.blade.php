@extends('layouts.single')

{{--  タイトル・メタディスクリプション  --}}
@section('title', 'お問い合わせ | おけいcom')
@section('description', 'お問い合わせ')

{{--  CSS  --}}
@push('css')
@endpush

{{--  本文  --}}
@section('content')
@if ($errors->any())
<div class="l-alart errorAlart" role="alert">
    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@endif
<div class="l-wrap--single login">
    <div class="l-wrap--title">
        <h1 class="c-headline--screen u-textAlign__center">お問い合わせ</h1>
    </div>
    <div class="l-wrap--body">
        <div class="l-wrap--main l-wrap--detail">
            <div class="l-content--detail">
                <div class="l-content--detail__inner">
                    <form method="POST" action="{{ route('contact.send') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="l-content--input">
                            <p class="l-content--input__headline">メールアドレス</p>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required="required" autocomplete="email">
                            @error('email')
                                <p class="l-alart__text errorAlart u-color--red" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline">お名前／表示名</p>
                            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required="required" autocomplete="name">
                            @error('name')
                                <p class="l-alart__text errorAlart u-color--red" role="alert">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="l-content--input">
                            <p class="l-content--input__headline">区分</p>
                            <ul class="u-pl10">
                                <li class="u-mb15">
                                    <div class="c-checkbox--fashonable">
                                        <label>生徒
                                            <input type="radio" name="class" value="0" required="required" @if(old('class') == 0 || old('class') !== '') checked @endif>
                                            <div class="color-box"></div>
                                        </label>
                                    </div>
                                </li>
                                <li class="u-mb15">
                                    <div class="c-checkbox--fashonable">
                                        <label>講師
                                            <input type="radio" name="class" value="1" @if(old('class') == 1) checked @endif>
                                            <div class="color-box"></div>
                                        </label>
                                    </div>
                                </li>
                                <li class="u-mb15">
                                    <div class="c-checkbox--fashonable">
                                        <label>その他
                                            <input type="radio" name="class" value="2" @if(old('class') == 2) checked @endif>
                                            <div class="color-box"></div>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                            @error('class')
                                <p class="l-alart__text errorAlart u-color--red" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline">件名</p>
                            <div class="c-selectBox u-mb5">
                                <select name="subject" required="required" value="{{ old('subject') ?? 1 }}">
                                    <option value="1">会員登録について</option>
                                    <option value="2">入金確認依頼</option>
                                    <option value="3">講師・レッスンについて</option>
                                    <option value="4">領収書発行依頼</option>
                                    <option value="5">修了証発行依頼</option>
                                    <option value="6">キャンペーンについて</option>
                                    <option value="7">おけいcomへのご要望</option>
                                    <option value="8">規約違反や著作権侵害を報告</option>
                                    <option value="9">スタッフ募集について</option>
                                    <option value="10">法人契約について</option>
                                    <option value="11">コラボ支援サービスについて</option>
                                    <option value="12">退会したい</option>
                                    <option value="13">ベータテストについて</option>
                                    <option value="14">その他</option>
                                </select>
                            </div>
                            @error('subject')
                            <p class="l-alart__text errorAlart u-color--red" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline">画像</p>
                            <input type="file" class="form-control @error('img') is-invalid @enderror" name="img" value="{{ old('img') }}" autocomplete="img">
                            @error('img')
                            <p class="l-alart__text errorAlart u-color--red" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline">内容</p>
                            <textarea id="detail" class="form-control @error('detail') is-invalid @enderror" name="detail" required="required" autocomplete="detail" cols="50" rows="10">{{ old('detail') }}</textarea>
                            @error('detail')
                            <p class="l-alart__text errorAlart u-color--red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline">表示されている文字を入力してください。</p>
                            <div class="u-w50per u-mb10">
                                {!! captcha_img() !!}
                            </div>
                            <input id="captcha" type="text" class="form-control @error('captcha') is-invalid @enderror" name="captcha" value="" required="required" autocomplete="captcha">
                            @error('captcha')
                            <p class="l-alart__text errorAlart u-color--red" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="l-button--submit">
                            <button class="c-button--square__pink" type="submit">お問い合わせ送信</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

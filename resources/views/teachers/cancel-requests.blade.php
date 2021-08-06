@extends('layouts.teacher')

<!-- タイトル・メタディスクリプション -->
@section('title', 'キャンセルリクエスト一覧')
@section('description', 'キャンセルリクエスト一覧')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/teacherParticipant.css') }}">
@endpush

<!-- 本文 -->
@section('content')
    <form method="POST" action="{{ route('mypage.t.cancel.do') }}">
        @csrf
        <div class="l-contentList__list__wrap">
            @if(count($cancels) > 0)
                @foreach($cancels as $cancel)
                <div class="teacher-participant-list">
                    <div class="teacher-participant-list-button">
                        <div class="c-checkbox--fashonable circle">
                            <label>
                                <input type="checkbox" name="cancels[]" value="{{ $cancel->id }}">
                                <div class="color-box"></div>
                            </label>
                        </div>
                    </div>
                    <div class="teacher-participant-list-detail">
                        <div class="teacher-participant-list-profile">
                            <div class="teacher-participant-list-content participant-img">
                                <div class="c-img--cover c-img--round">
                                    <img src="/img/common/screen-top.jpg">
                                </div>
                            </div>
                            <div class="teacher-participant-list-content participant-detail">
                                <p class="participant-detail-content">
                                    <span class="label pc-only">リクエスト</span>
                                    <span>{{ $cancel->created_at }}</span>
                                </p>
                                <p class="participant-detail-content">
                                    <span class="label pc-only">名前</span>
                                    <a href="" class="u-text--link" target="_blank">{{ $cancel->users_name }}</a>
                                </p>
                                <p class="participant-detail-content">
                                    <span class="label pc-only">レッスン</span>
                                    <a href="{{ route('lessons.detail', ['id' => $cancel->lessons_id]) }}" class="u-text--link" target="_blank">{{ route('lessons.detail', ['id' => $cancel->lessons_id]) }}</a>
                                </p>
                            </div>
                        </div>
                        <div class="teacher-participant-list-reason">
                            <div class="reason-inner">
                                <p class="u-color--gray u-text--small u-mb5">キャンセル理由</p>
                                <p>{{ $cancel->reason }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>キャンセルリクエストはありません。</p>
        @endif
    </div>
    @if(count($cancels) > 0)
    <div class="l-button--submit">
        <div class="l-button--submit--two">
            <button name="save" type="submit" class="c-button--square__blue">{{ __('Approval') }}</button>
            {{-- <input type="subit" name="" value="承認" class="c-button--square__blue"> --}}
        </div>
        <div class="l-button--submit--two">
            {{-- <input type="subit" name="" value="拒否" class="c-button--square__pink"> --}}
            <button name="delete" type="submit" class="c-button--square__pink">{{ __('Denial') }}</button>
        </div>
    </div>
    @endif
    </form>
@endsection





{{--
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>キャンセルリクエスト一覧</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('mypage.t.cancel.do') }}">
                @csrf

                @foreach($cancels as $cancel)
                    <input type="checkbox" id="cancels" name="cancels[]" value="{{ $cancel->id }}">
                    <p>
                        {{ $cancel->created_at }}
                    </p>
                    <p>
                        {{ $cancel->users_name }}
                        {{ $cancel->users_img }}
                    </p>
                    レッスン <a class="" href="{{ route('lessons.detail', ['id' => $cancel->lessons_id]) }}">{{ route('lessons.detail', ['id' => $cancel->lessons_id]) }}</a>
                    <p>
                        キャンセル理由<br>
                        {{ $cancel->reason }}
                    </p>
                    <hr>
                @endforeach

                <div class="form-group row mb-0">
                    <div class="col-md-3 offset-md-4">
                        <button name="save" type="submit" class="btn btn-primary">
                            {{ __('Approval') }}
                        </button>
                    </div>
                    <div class="col-md-3">
                        <button name="delete" type="submit" class="btn btn-primary">
                            {{ __('Denial') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection--}}

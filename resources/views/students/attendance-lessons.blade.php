@extends('layouts.user')

{{-- タイトル・メタディスクリプション --}}
@section('title', '受講予定レッスン一覧')
@section('description', '受講予定レッスン一覧')

{{-- CSS --}}
@push('css')
@endpush

{{-- 本文 --}}
@section('content')
    <div class="l-contentList__list__wrap">
        @foreach($lessons as $lesson)
            <div class="c-contentList__box">
                <a class="c-contentList__box__inner" href="{{ route('lessons.detail', ['id' => $lesson->id]) }}">
                    <div class="c-contentList__box__img">
                        <div class="c-img--cover">
                            <img src="/storage/courses/{{ $lesson->courses_img1 }}">
                        </div>
                    </div>
                    <div class="c-contentList__box__info">
                        <div class="number l-flex">
                            <p class="other">
                                <span class="stage">第{{ $lesson->rowNumber }}回</span>
                                <span class="date">{{ $lesson->add_week_date }} {{ $lesson->separate_hyphen_time }}</span>
                            </p>
                            <p class="price">{{ $lesson->separate_comma_price }}</p>
                        </div>
                        <p class="title">{{ $lesson->title }}</p>
                        <p class="detail pc-only">{{ $lesson->detail }}</p>
                        <div class="category">
                            @if ($lesson->category1_name)
                                <span>{{ $lesson->category1_name }}</span>
                            @endif
                            @if ($lesson->category2_name)
                                <span>{{ $lesson->category2_name }}</span>
                            @endif
                            @if ($lesson->category3_name)
                                <span>{{ $lesson->category3_name }}</span>
                            @endif
                            @if ($lesson->category4_name)
                                <span>{{ $lesson->category4_name }}</span>
                            @endif
                            @if ($lesson->category5_name)
                                <span>{{ $lesson->category5_name }}</span>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
        {{--
        <div class="l-pagenation">
            <ul class="l-pagenation__list">
                @for ($i = 1; $i < $lessons->lastPage()+1; $i++)
                    <li class="{{ $i == $lessons->currentPage() ? 'selected disabled' : ''}}">
                        <a href="{{ $lessons->withQueryString()->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
            </ul>
        </div>
        --}}
    </div>
    {{--
    <user-lesson-component
        :status={{ $applications_status }}
        :lessonlists='@json($lessons)'
    >
    </user-lesson-component>
    --}}
@endsection



{{--
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a class="" href="{{ route('mypage.u.attendance-lessons', ['applications_status' => 0]) }}">
                @if($applications_status == 1)@else●@endif 受講予定
            </a>
            <a class="" href="{{ route('mypage.u.attendance-lessons', ['applications_status' => 1]) }}">
                @if($applications_status == 1)●@endif 受講済み
            </a>

            @foreach($lessons as $lesson)
                <p>
                    {{ $lesson->kanji_number }}
                    {{ $lesson->add_week_date }}
                    {{ $lesson->separate_hyphen_time }}
                    {{ $lesson->separate_comma_price }}
                </p>
                <a class="" href="{{ route('lessons.detail', ['id' => $lesson->id]) }}">
                    {{ $lesson->title }}
                </a>
                <p>{{ $lesson->detail }}</p>
                <p>{{ $lesson->category1_name }} {{ $lesson->category2_name }} {{ $lesson->category3_name }}</p>
                <p>{{ $lesson->user_name }}</p>
                <hr>
            @endforeach
            {{ $lessons->links('vendor.pagination.simple-tailwind') }}
        </div>
    </div>
</div>
@endsection
--}}

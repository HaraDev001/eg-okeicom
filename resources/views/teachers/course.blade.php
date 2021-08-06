@extends('layouts.teacher')

{{-- タイトル・メタディスクリプション --}}
@section('title', 'コース一覧')
@section('description', 'コース一覧')

{{-- CSS --}}
@push('css')
@endpush

{{-- 本文 --}}
@section('content')
<div class="l-contentList__wrap l-flex">
    <div class="l-contentList__list">
        <div class="l-contentList__list__wrap">
            @foreach($courses as $course)
                <div class="c-contentList__box">
                    <a class="c-contentList__box__inner" :href="'/mypage/t/courses/detail/' + {{ $course->id }}">
                        <div class="c-contentList__box__img">
                            <div class="c-img--cover">
                                <img src="{{ asset('/storage/courses/' . $course->img1 )}}">
                            </div>
                        </div>
                        <div class="c-contentList__box__info">
                            <div class="number l-flex">
                                <p class="other">
                                    <span class="stage">全{{ $course->course_counts ?? 0 }}回</span>
                                </p>
                            </div>
                            <p class="title">{{ $course->title }}</p>
                            <p class="detail pc-only">{{ $course->detail }}</p>
                            <div class="category">
                                @if ($course->category1_name)
                                    <span>{{ $course->category1_name }}</span>
                                @endif
                                @if ($course->category2_name)
                                    <span>{{ $course->category2_name }}</span>
                                @endif
                                @if ($course->category3_name)
                                    <span>{{ $course->category3_name }}</span>
                                @endif
                                @if ($course->category4_name)
                                    <span>{{ $course->category4_name }}</span>
                                @endif
                                @if ($course->category5_name)
                                    <span>{{ $course->category5_name }}</span>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="l-pagenation">
            <ul class="l-pagenation__list">
                @for ($i = 1; $i < $courses->lastPage()+1; $i++)
                    <li class="{{ $i == $courses->currentPage() ? 'selected disabled' : ''}}">
                        <a href="{{ $courses->withQueryString()->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
            </ul>
        </div>
    </div>
</div>
@endsection




{{--
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($common_cancel_count > 0)
                <a class="" href="{{ route('mypage.t.cancel-requests') }}">
                    未処理のキャンセルリクエストが{{ $common_cancel_count }}件あります。
                </a>
            @endif
            <div>
                <a class="" href="{{ route('mypage.t.courses.create') }}">
                    コースを追加する
                </a>
            </div>
            <h2>コース一覧</h2>
            @foreach($courses as $course)
                <a href="{{ route('mypage.t.courses.detail', ['courses_id' => $course->id]) }}">
                    {{ $course->title }}
                </a>
                <p>{{ $course->detail }}</p>
                <p>{{ $course->category1_name }} {{ $course->category2_name }} {{ $course->category3_name }}</p>
                <hr>
            @endforeach
            {{ $courses->links('vendor.pagination.simple-tailwind') }}
        </div>
    </div>
</div>
@endsection
--}}

@extends('layouts.teacher')

{{-- タイトル・メタディスクリプション --}}
@section('title', 'コース詳細')
@section('description', 'コース詳細')

{{-- CSS --}}
@push('css')
    <link rel="stylesheet" href="{{ asset('/css/foundation/single/teacherCourseAdd.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/foundation/single/teacherCourseDetail.css') }}">
@endpush

{{-- 本文 --}}
@section('content')
    @error('img1')
        <div class="l-alart errorAlart" role="alert">
            <p>画像1</p>
        </div>
    @enderror
    @error('img2')
        <div class="l-alart errorAlart" role="alert">
            <p>画像2</p>
        </div>
    @enderror
    @error('img3')
        <div class="l-alart errorAlart" role="alert">
            <p>画像3</p>
        </div>
    @enderror
    @error('img4')
        <div class="l-alart errorAlart" role="alert">
            <p>画像4</p>
        </div>
    @enderror
    @error('img5')
        <div class="l-alart errorAlart" role="alert">
            <p>画像5</p>
        </div>
    @enderror
    @error('categories')
        <div class="l-alart errorAlart" role="alert">
            <p>カテゴリーが設定されていない、あるいは5つ以上のカテゴリーが設定されています。</p>
        </div>
    @enderror
    @error('title')
        <div class="l-alart errorAlart" role="alert">
            <p>タイトルが未記入です。</p>
        </div>
    @enderror
    @error('detail')
        <div class="l-alart errorAlart" role="alert">
            <p>詳細が未記入です。</p>
        </div>
    @enderror
    @if (session('flash_message'))
        <div class="l-alart errorAlart flash_message">
            {{ session('flash_message') }}
        </div>
    @endif
    <teacher-course-detail-component
        :course="{{ json_encode($course) }}"
        :category-list={{ $categories }}
        :lessons={{ $lessons }}
        :csrf="{{json_encode(csrf_token())}}"
    >
    {{--
    <teacher-course-detail-component
        :course="{{ json_encode($course) }}"
        :categories={{ $categories }}
        :lessons={{ $lessons }}
    >
    </teacher-course-detail-component>
    --}}
    </teacher-course-detail-component>
    {{--
    <form method="POST" action="{{ route('mypage.t.courses.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="courses_id" value="{{ $course->id }}">
        <button name="save" type="submit">送信する</button>
    </form>
    --}}
@endsection

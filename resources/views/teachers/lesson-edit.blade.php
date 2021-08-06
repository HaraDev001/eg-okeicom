@extends('layouts.teacher')

{{-- タイトル・メタディスクリプション --}}
@section('title', 'レッスン詳細')
@section('description', 'レッスン詳細')

{{-- CSS --}}
@push('css')
    <link rel="stylesheet" href="{{ asset('/css/foundation/single/teacherCourseDetail.css') }}">
    <style>
        .vue__time-picker .dropdown ul li[disabled] {
            cursor: pointer !important;
            opacity: 1 !important;
        }
        .vue__time-picker .dropdown ul li[disabled]:hover {
            background: #ddd !important;
        }
        .vdp-datepicker__clear-button {
            position: absolute;
            right: 10px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            line-height: 20px;
            text-align: center;
            border-radius: 50%;
            color: #fff;
            background: #DBDBDB;
        }
        .vdp-datepicker__clear-button span {
            font-style: initial !important;
        }
    </style>
@endpush

{{-- 本文 --}}
@section('content')

    {{--  エラーメッセージ  --}}
    @if ($errors->any())
        <div class="l-alart errorAlart" role="alert">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    {{--  成功メッセージ  --}}
    @if (session('success'))
        <div class="l-alart successAlart" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <form action="{{ route('mypage.t.lessons.update', ['lesson' => $lesson, 'lesson_id' => $lesson->id, 'courses_id' => $lesson->course_id]) }}" method="POST">
        @csrf
        <lesson-edit-component
            :lesson="{{ $lesson }}"
            :applications="{{ json_encode($applications) }}"
            :param="{{ $_GET['param'] ?? 1 }}"
        />
    </form>
@endsection

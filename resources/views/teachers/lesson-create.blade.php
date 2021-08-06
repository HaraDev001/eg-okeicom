@extends('layouts.teacher-single')

{{-- タイトル・メタディスクリプション --}}
@section('title', 'レッスン作成')
@section('description', 'レッスン作成')

{{-- CSS --}}
@push('css')
    <link rel="stylesheet" href="{{ asset('/css/foundation/single/teacherCourseAdd.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/foundation/single/teacherCourseDetail.css') }}">
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
        <div class="l-alart errorAlart" role="alert">
            <p>{{ session('flash_message') }}</p>
        </div>
    @endif
    <div class="l-wrap--single">
        <lesson-create-component
            :old={{ json_encode(Session::getOldInput()) }}
            :csrf={{ json_encode(csrf_token()) }}
        />
    </div>
@endsection

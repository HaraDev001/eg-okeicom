@extends('layouts.app')

{{-- タイトル・メタディスクリプション --}}
@section('title', '講師詳細 | おけいcom')
@section('description', 'おけいcomの講師詳細ページ概要です。')

{{-- CSS --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/teacherDetail.css') }}">
@endpush

{{-- 本文 --}}
@section('content')
    <teacher-show-component :user="{{ $user }}" :lessons="{{ $lessons }}" :evalutions="{{ $evalutions }}"></teacher-show-component>
@endsection

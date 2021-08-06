@extends('layouts.owner')

<!-- タイトル・メタディスクリプション -->
@section('title', 'コース詳細 | おけいcom')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/teacherCourseAdd.css') }}">
@section('description', 'コース詳細')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
	<admin-user-show-course-component></admin-user-show-course-component>
@endsection

@extends('layouts.owner')

<!-- タイトル・メタディスクリプション -->
@section('title', 'ユーザー詳細 | おけいcom')
@section('description', 'ユーザー詳細')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
	<admin-user-edit :user-date="{{ $userDate }}" :category-list={{ $categories }} />
@endsection

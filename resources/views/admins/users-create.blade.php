{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>(管理者専用ページ)</h2>
                <h2>ユーザ作成</h2>
            </div>
        </div>
    </div>
@endsection --}}

@extends('layouts.owner')

<!-- タイトル・メタディスクリプション -->
@section('title', 'ユーザー新規追加 | おけいcom')
@section('description', 'ユーザー追加')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
	<admin-user-create-component></admin-user-create-component>
@endsection
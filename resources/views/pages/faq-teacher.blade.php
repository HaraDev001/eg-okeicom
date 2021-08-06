@extends('layouts.common')

<!-- タイトル・メタディスクリプション -->
@section('title', '講師よくある質問')
@section('description', '講師よくある質問')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
<div class="l-wrap--main">
	<div class="l-page">
		<page-faq-teacher-component></page-faq-teacher-component>
	</div>
</div>
@endsection
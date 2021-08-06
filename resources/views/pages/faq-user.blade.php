@extends('layouts.common')

<!-- タイトル・メタディスクリプション -->
@section('title', '受講者よくある質問')
@section('description', '受講者よくある質問')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
<div class="l-wrap--main">
	<div class="l-page">
		<page-faq-user-component></page-faq-user-component>
	</div>
</div>
@endsection
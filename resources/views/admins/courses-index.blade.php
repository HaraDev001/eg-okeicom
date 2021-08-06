@extends('layouts.owner')

<!-- タイトル・メタディスクリプション -->
@section('title', 'コース一覧 | おけいcom')
@section('description', 'コース一覧')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
    <div class="l-wrap--owner--main">
		<div class="l-wrap--owner--header">
			<div class="l-wrap--owner--header--title">
				<p>コース一覧</p>
			</div>
		</div>
		<div class="l-wrap--owner--body">
			<div class="l-wrap--owner--body--inner">
				<admin-course-list />
			</div>
			{{--  <div class="pagenation-list">
				<ul>
					<li class="now">１</li>
					<?php for($i=2;$i<10;$i++): ?>
						<li><a href=""><?php echo $i; ?></a></li>
					<?php endfor; ?>
				</ul>
			</div>  --}}
		</div>
	</div>
@endsection

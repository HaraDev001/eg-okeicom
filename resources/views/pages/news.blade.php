{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>お知らせ</h2>
            </div>
        </div>
    </div>
@endsection --}}



@extends('layouts.common')

<!-- タイトル・メタディスクリプション -->
@section('title', 'お知らせ一覧')
@section('description', 'パスワード再設定完了')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
<div class="l-wrap--main">
	<div class="l-list--news">
		<?php for($i = 1; $i <= 10; $i++): ?>
			<div class="l-content--teacher">
				<a href="">
					<div class="l-flex">
						<div class="u-w100">
							<div class="c-img--cover">
								<img src="{{ asset('/img/screen-top.jpg') }}">
							</div>
						</div>
						<div class="u-wflex1 u-pl15">
							<p class="u-mb10 u-text--big">お知らせタイトル。お知らせタイトル。お知らせタイトル。</p>
							<p class="u-text--small u-color--gray">2020年12月03日</p>
						</div>
					</div>
				</a>
			</div>
		<?php endfor; ?>
	</div>
	<div class="l-pagenation">
		<ul class="l-pagenation__list">
			<li class="selected"><a>１</a></li>
			<?php for($i = 2; $i <= 9; $i++): ?>
				<li><a href=""><?php echo $i; ?></a></li>
			<?php endfor; ?>
		</ul>
	</div>
</div>
@endsection
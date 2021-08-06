{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>お知らせ詳細</h2>
            </div>
        </div>
    </div>
@endsection --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("../common/head")
<body>
	<div id="app">
		@include("../common/header")
		<main>
			@include("../common/breadcrumbs")
			<div class="l-wrap--single">
				<div class="l-wrap--title">
					<h1 class="c-headline--screen">タイトルタイトル</h1>
					<p class="u-mt10 u-color--gray">2020年2月2日</p>
				</div>
				<div class="l-wrap--body l-page">
					<div class="l-wrap--main l-wrap--detail">
						<div class="l-content--detail">
							<div class="l-content--detail__inner">
								<img src="/img/common/screen-top.jpg">
								<p>ああああああああああああああああああああああああああああああああああああああああああああああああああああああああ</p>
								<p>ああああああああああああああああああああああああああああああああああああああああああああああああああああああああ</p>
								<h2>ああああああああああああああ</h2>
								<p>ああああああああああああああああああああああああああああああああああああああああああああああああああああああああ</p>
								<h3>ああああああああああああああ</h3>
								<p>ああああああああああああああああああああああああああああああああああああああああああああああああああああああああ</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			@include("../common/lead")
		</main>
	</div>
	@include("../common/footer")
</body>
</html>
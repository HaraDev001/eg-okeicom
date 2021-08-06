<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("../common/head")
<body>
	<div id="app">
		<header-component></header-component>
		<main>
            <nav id="breadcrumbs">
                <div class="l-allWrapper">
                    <ol class="breadcrumbs__list l-flex l-start l-v__center">
                        <li><a href="/"><img src="{{ asset('/img/common/icon-home-black.png') }}" alt="ホーム画面のアイコン"></a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div>
            </nav>
			<div class="l-wrap--title">
				<div class="l-wrap">
					<h1 class="c-headline--screen">@yield('title')</h1>
				</div>
			</div>
			<div class="l-wrap--body">
				<div class="l-wrap l-flex">
					@yield('content')
					@include("../common/sidebar-page")
				</div>
			</div>
			@include("../common/lead")
		</main>
	</div>

	 <!-- Global site tag (gtag.js) - Google Analytics -->
	 <script type="application/javascript" async src="https://www.googletagmanager.com/gtag/js?id=G-7YT2K7JN1P"></script>
	 <script>
		 window.dataLayer = window.dataLayer || [];
		 function gtag(){dataLayer.push(arguments);}
		 gtag('js', new Date());
		 gtag('config', 'G-7YT2K7JN1P', { 'send_page_view': false });
	 </script>
	 <!-- End Google Analytics -->
	 
	@include("../common/footer")
</body>
</html>

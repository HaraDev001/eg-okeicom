<nav id="nav-global" class="sp-only" :class="{'open--nav':drawerActive}">
	<div class="nav-global__back">
		<a @click='closeDrawer'><img src="{{ asset('/img/icon-nav-back.png') }}"></a>
	</div>
	<ul class="nav-global__list">
		<li><a href="/">トップページ</a></li>
		<li><a href="/lessons">レッスン一覧</a></li>
		<li><a href="/teachers">講師一覧</a></li>
	</ul>
	<p class="c-sp-headline nav--title">会社情報</p>
	<ul class="nav-global__list">
		<li><a href="/news">お知らせ</a></li>
		<li><a href="/tokushoho">特定商取引法に基づく表記</a></li>
		{{-- <li><a href="{{ url('/flow/') }}">料金決済の流れ</a></li> --}}
		<li><a href="/tokushoho">特定商取引法に基づく表記</a></li>
		<li><a href="{{ route('contact') }}">お問い合わせ</a></li>
	</ul>
	<p class="c-sp-headline nav--title">講師向け</p>
	<ul class="nav-global__list">
		<li><a href="/terms-teacher">講師規約</a></li>
		<li><a href="/cancel-teacher">講師キャンセルポリシー</a></li>
		<li><a href="/faq-teacher">講師よくある質問</a></li>
	</ul>
	<p class="c-sp-headline nav--title">受講者向け</p>
	<ul class="nav-global__list">
		<li><a href="/termsuser">受講者規約</a></li>
		<li><a href="/cancel-user">受講者キャンセルポリシー</a></li>
		<li><a href="/faq-user">受講者よくある質問</a></li>
	</ul>
</nav>

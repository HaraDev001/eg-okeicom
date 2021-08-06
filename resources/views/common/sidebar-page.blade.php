<div id="sidebar" class="other-sidebar">
	<div class="headline pc-only"><p>その他ページ</p></div>
    <ul class="sidebar__list long sp-only">
		{{-- <li class="@if(Request::is('news')) selected @endif"><a href="/news">お知らせ一覧</a></li> --}}
		<li class="@if(Request::is('terms-teacher')) selected @endif"><a href="/terms-teacher">講師規約</a></li>
		<li class="@if(Request::is('cancel-teacher')) selected @endif"><a href="/cancel-teacher">講師キャンセルポリシー</a></li>
		<li class="@if(Request::is('faq-teacher')) selected @endif"><a href="/faq-teacher">講師よくある質問</a></li>
		<li class="@if(Request::is('terms-user')) selected @endif"><a href="/terms-user">受講者規約</a></li>
		<li class="@if(Request::is('cancel-user')) selected @endif"><a href="/cancel-user">受講者キャンセルポリシー</a></li>
		<li class="@if(Request::is('faq-user')) selected @endif"><a href="/faq-user">受講者よくある質問</a></li>
		<li class="@if(Request::is('tokushoho')) selected @endif"><a href="/tokushoho">特定商取引法に基づく表記</a></li>
		{{-- <li class="@if(Request::is('flow')) selected @endif"><a href="/flow">料金決済の流れ</a></li> --}}
	</ul>
	<ul class="sidebar__list pc-only">
		{{-- <li class="@if(Request::is('news')) selected @endif"><a href="/news">お知らせ一覧</a></li> --}}
        <li class="@if(Request::is('terms-teacher')) selected @endif"><a href="/terms-teacher">講師規約</a></li>
		<li class="@if(Request::is('cancel-teacher')) selected @endif"><a href="/cancel-teacher">講師キャンセルポリシー</a></li>
		<li class="@if(Request::is('faq-teacher')) selected @endif"><a href="/faq-teacher">講師よくある質問</a></li>
		<li class="@if(Request::is('terms-user')) selected @endif"><a href="/terms-user">受講者規約</a></li>
		<li class="@if(Request::is('cancel-user')) selected @endif"><a href="/cancel-user">受講者キャンセルポリシー</a></li>
		<li class="@if(Request::is('faq-user')) selected @endif"><a href="/faq-user">受講者よくある質問</a></li>
		<li class="@if(Request::is('tokushoho')) selected @endif"><a href="/tokushoho">特定商取引法に基づく表記</a></li>
		{{-- <li class="@if(Request::is('flow')) selected @endif"><a href="/flow">料金決済の流れ</a></li> --}}
	</ul>
</div>

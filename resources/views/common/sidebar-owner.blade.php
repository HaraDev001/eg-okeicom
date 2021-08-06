<div class="l-wrap--owner--sidebar">
	<ul>
		<li><a href="{{ route('admins.withdraws.request') }}">出金リクエスト</a></li>
		<li><a href="{{ route('admins.withdraws.history') }}">出金履歴</a></li>
		<li><a href="{{ route('admins.users.index') }}">ユーザー一覧</a></li>
		{{-- <li><a href="{{ route('admins.users.create') }}">ユーザー追加</a></li> --}}
		<li><a href="{{ route('admins.courses.index') }}">コース一覧</a></li>
		<li><a href="{{ route('admins.messages.index') }}">メッセージ一覧</a></li>
		<li><a href="{{ route('admins.deails-before.index') }}">取引一覧（確定後）</a></li>
		<li><a href="{{ route('admins.deails-after.index') }}">取引一覧（確定前）</a></li>
		<li><a href="{{ route('admins.news.index') }}">お知らせ一覧</a></li>
		<li><a href="{{ route('admins.news.create') }}">お知らせ作成</a></li>
		<li><a href="{{ route('admins.coupons.index') }}">クーポン一覧</a></li>
		<li><a href="{{ route('admins.coupons.create') }}">クーポン発行</a></li>
	</ul>
</div>

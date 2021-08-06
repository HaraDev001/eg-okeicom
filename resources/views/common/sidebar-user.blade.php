<div id="sidebar" class="pc-only">
	<div class="sidebar-change">
		<a href="{{ route('mypage.u.change') }}" class="u-text--link">講師に切り替える<span style="font-size: 10px; display: block; color: #777; margin-top: 10px;">講師としての活動をご希望の方は下記ボタンを押してください</span></a>
	</div>
	<ul class="sidebar__list">
		<li class="@if(Request::is('mypage/u/attendance-lessons')) selected @endif"><a href="{{ route('mypage.u.attendance-lessons') }}">受講予定レッスン</a></li>
		<li class="@if(Request::is('mypage/u/taken-lessons')) selected @endif"><a href="{{ route('mypage.u.taken-lessons') }}">受講済みレッスン</a></li>
		<li class="@if(Request::is('mypage/u/messages')) selected @endif"><a href="{{ route('mypage.u.messages') }}">メッセージ</a></li>
		<li class="@if(Request::is('mypage/u/profile')) selected @endif"><a href="{{ route('mypage.u.profile') }}">プロフィール</a></li>
		{{-- <li class="@if(Request::is('mypage/u/message')) selected @endif"><a href="{{ route('mypage.u.') }}">支払い管理</a></li> --}}
		{{-- <li class="@if(Request::is('mypage/u/trade')) selected @endif"><a href="{{ route('mypage.u.creditcards') }}">クレジットカード情報</a></li> --}}
		{{-- <li class="@if(Request::is('mypage/u/bank')) selected @endif"><a href="{{ route('mypage.u.bank.show') }}">銀行口座情報</a></li>  --}}
		{{-- <li class="@if(Request::is('mypage/u/trade')) selected @endif"><a href="{{ route('mypage.u.trade') }}">入出金管理</a></li>  --}}
		{{-- <li class="@if(Request::is('mypage/u/withdrawal')) selected @endif"><a href="{{ route('mypage.u.withdrawal.create') }}">退会</a></li>  --}}
	</ul>
</div>

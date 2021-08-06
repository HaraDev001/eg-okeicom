<div id="sidebar" class="pc-only">
	<div class="sidebar-change">
        <a href="{{asset('/manual_pdf/講師マニュアル.pdf')}}" class="u-text--link" download="講師マニュアル">講師マニュアル</a>
    </div>
	<div class="sidebar-change">
		<a href="{{ route('mypage.t.change') }}" class="u-text--link">受講者に切り替える</a>
	</div>
	<ul class="sidebar__list">
		<li class="@if(Request::is('mypage/t/courses*')) selected @endif"><a href="{{ route('mypage.t.courses') }}">コース一覧</a></li>
		<li class="@if(Request::is('mypage/t/courses/add')) selected @endif"><a href="{{ route('mypage.t.courses.create') }}">コース作成</a></li>
		{{-- <li class="@if(Request::is('mypage/t/lesson-participation')) selected @endif"><a href="{{ route('mypage.t.lessons.participation') }}">レッスン参加状況</a></li> --}}
		<li class="@if(Request::is('mypage/t/cancel-requests')) selected @endif"><a href="{{ route('mypage.t.cancel-requests') }}">キャンセル依頼</a></li>
		<li class="@if(Request::is('mypage/t/messages')) selected @endif"><a href="{{ route('mypage.t.messages') }}">メッセージ</a></li>
		<li class="@if(Request::is('mypage/t/profile')) selected @endif"><a href="{{ route('mypage.t.profile') }}">プロフィール</a></li>
		{{-- <li class="@if(Request::is('mypage/u/trade')) selected @endif"><a href="{{ route('mypage.t.creditcards') }}">クレジットカード情報</a></li> --}}
		<li class="@if(Request::is('mypage/t/bank')) selected @endif"><a href="{{ route('mypage.t.bank.show') }}">銀行口座情報</a></li>
		<li class="@if(Request::is('mypage/t/trade')) selected @endif"><a href="{{ route('mypage.t.trade') }}">入出金管理</a></li>
		{{--  <li class="@if(Request::is('mypage/t/withdrawal')) selected @endif"><a href="{{ route('mypage.t.withdrawal.create') }}">退会</a></li>  --}}
	</ul>
</div>

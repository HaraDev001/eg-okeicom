@extends(($user_status == 0)?'layouts.user':'layouts.teacher')

{{-- タイトル・メタディスクリプション --}}
@section('title', 'メッセージ一覧')
@section('description', 'メッセージ一覧')

{{-- CSS --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/userMessage.css') }}">
@endpush

{{-- 本文 --}}
@section('content')
    <div class="message-sidebar">
        @if(!$partner_users->isEmpty())
            @foreach($partner_users as $partner_user)
            <div class="message-user">
                <a href="{{ route('mypage.t.messages.detail', ['partner_users_id' => $partner_user->users_id]) }}">
                    <div class="message-sidebar-list-box l-flex l-v__top">
                        <div class="l-flex l-v__center">
                            <div class="u-w40"><span class="u-color--red">{{ $partner_user->is_all_read ? '既読' : '未読' }}</span></div>
                            <div class="u-w55">
                                <div class="message-sidebar-list-box-img">
                                    <div class="c-img--cover">
                                        <img src="/storage/profile/{{ $partner_user->users_img }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="u-wflex1">
                            <p class="u-text--big" >{{ $partner_user->users_name }}</p>
                            <p class="u-color--gray u-mt5" id = "{{ $partner_user->users_name }}">{{ Str::limit($partner_user->message_detail, 60) }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        @else
            @if(Agent::isMobile())
                <p>メッセージはありません</p>
            @endif
        @endif
    </div>
    <script>
        var names = JSON.parse(localStorage.getItem("users"));
        function iterate(item) {
            document.getElementById(item).innerHTML = localStorage.getItem(item);
        }
        names.forEach(iterate);
    </script>
@endsection

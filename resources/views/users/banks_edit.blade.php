{{--  @extends((Auth::user()->status == 0)?'layouts.user':'layouts.teacher')  --}}
@extends('layouts.teacher')

{{--  タイトル・メタディスクリプション  --}}
@section('title', '銀行情報編集')
@section('description', '銀行情報編集')

{{--  CSS  --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/dashboard.css') }}">
@endpush

{{--  JS  --}}
@push('js')
@endpush

{{--  本文  --}}
@section('content')
    {{--  エラーメッセージ  --}}
    @if ($errors->any())
        <div class="l-alart errorAlart" role="alert">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <form method="post" action="{{ route('mypage.t.bank.update') }}">
    {{--  <form method="post" action="@if(Auth::user()->status == 0) {{ route('mypage.u.bank.update') }} @else(Auth::user()->status == 1) {{ route('mypage.t.bank.update') }} @endif">  --}}
        @csrf
        @if($bank)
            <user-bank-component
              :bank-date={{ $bank }}
              :old="{{ json_encode(Session::getOldInput()) }}"
            />
        @else
            <user-bank-component
              :old="{{ json_encode(Session::getOldInput()) }}"
            />
        @endif
    </form>
@endsection

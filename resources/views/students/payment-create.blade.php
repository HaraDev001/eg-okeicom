{{--  @extends(($user_status == 0)?'layouts.user-single':'layouts.teacher-single')  --}}
@extends('layouts.teacher-single')

{{-- タイトル・メタディスクリプション --}}
@section('title', '出金リクエスト')
@section('description', '出金リクエスト')

{{-- CSS --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/teacher.css') }}">
<link rel="stylesheet" href="{{ asset('/css/foundation/single/userPayment.css') }}">
@endpush

{{-- 本文 --}}
@section('content')
    @if ($errors->any())
    <div class="l-alart errorAlart" role="alert">
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif
    <div class="l-wrap--single">
        <div class="l-wrap--title">
            <a class="c-link--back u-mb5" href="{{ url()->previous() }}">取引一覧へ戻る</a>
            <h1 class="c-headline--screen">出金リクエスト</h1>
        </div>
        <form method="POST" action="{{ route('mypage.t.payment.store') }}">
            @csrf
            <div class="l-wrap--body">
                <div class="l-wrap--main l-wrap--detail">
                    <div class="l-content--detail">
                        <div class="c-headline--block">出金額</div>
                        <div class="l-content--detail__inner">
                            <div class="user-pament-total" style="text-align: center;">
                                <p class="u-textAlign__center u-text--big">¥{{ number_format(Session::get('withdrawal_amount')) }}</p>
                            </div>
                            <p class="u-mt5" style="text-align: center;">手数料：¥{{ number_format(Session::get('commission')) }}（{{ Session::get('fee') }}%）</p>
                        </div>
                    </div>
                    {{--  <user-payment-component
                      :bank-date={{ $bankDate }}
                      target="{{ $target }}"
                    />  --}}
                    @if($bankDate)
                      <user-payment-component
                        :bank-date={{ $bankDate }}
                        :old="{{ json_encode(Session::getOldInput()) }}"
                      />
                    @else
                      <user-payment-component
                        :old="{{ json_encode(Session::getOldInput()) }}"
                      />
                    @endif
                </div>
            </div>
            <div class="l-button--submit">
                <button class="c-button--square__pink" type="submit">出金リクエスト確定</button>
            </div>
        </form>
    </div>
@endsection

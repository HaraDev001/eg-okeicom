@extends((Auth::user()->status == 0)?'layouts.user':'layouts.teacher')

{{--  タイトル・メタディスクリプション  --}}
@section('title', '銀行情報')
@section('description', '銀行情報')

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

    {{--  ゆうちょ銀行  --}}
    <div class="c-list--table">
        @if($bank)
            @if($bank->type === 'japan')
                <div class="c-list--tr">
                    <div class="c-list--th">
                        <p class="main">金融機関名</p>
                    </div>
                    <div class="c-list--td">
                        <p>ゆうちょ銀行</p>
                    </div>
                </div>
                <div class="c-list--tr">
                    <div class="c-list--th">
                        <p class="main">口座記号</p>
                    </div>
                    <div class="c-list--td">
                        <p>@if(isset($bank->japan_mark)) {{ $bank->japan_mark }} @endif</p>
                    </div>
                </div>
                <div class="c-list--tr">
                    <div class="c-list--th">
                        <p class="main">口座番号</p>
                    </div>
                    <div class="c-list--td">
                        <p>@if(isset($bank->number)) {{ $bank->number }} @endif</p>
                    </div>
                </div>
                <div class="c-list--tr">
                    <div class="c-list--th">
                        <p class="main">口座名義人</p>
                    </div>
                    <div class="c-list--td">
                        <p>@if(isset($bank->name)) {{ $bank->name }} @endif</p>
                    </div>
                </div>
            @elseif($bank->type === 'other')
                {{--  その他銀行  --}}
                <div class="c-list--tr">
                    <div class="c-list--th">
                        <p class="main">金融機関名</p>
                    </div>
                    <div class="c-list--td">
                        <p>@if(isset($bank->financial_name)) {{ $bank->financial_name }} @endif</p>
                    </div>
                </div>
                <div class="c-list--tr">
                    <div class="c-list--th">
                        <p class="main">支店名</p>
                    </div>
                    <div class="c-list--td">
                        <p>@if(isset($bank->branch_name)) {{ $bank->branch_name }} @endif</p>
                    </div>
                </div>
                <div class="c-list--tr">
                    <div class="c-list--th">
                        <p class="main">支店番号</p>
                    </div>
                    <div class="c-list--td">
                        <p>@if(isset($bank->branch_number)) {{ $bank->branch_number }} @endif</p>
                    </div>
                </div>
                <div class="c-list--tr">
                    <div class="c-list--th">
                        <p class="main">預金種目</p>
                    </div>
                    <div class="c-list--td">
                        <p>@if($bank->other_type == 0)普通@elseif($bank->other_type == 1)当座@endif</p>
                    </div>
                </div>
                <div class="c-list--tr">
                    <div class="c-list--th">
                        <p class="main">口座番号</p>
                    </div>
                    <div class="c-list--td">
                        <p>@if(isset($bank->number)) {{ $bank->number }} @endif</p>
                    </div>
                </div>
                <div class="c-list--tr">
                    <div class="c-list--th">
                        <p class="main">口座名義人</p>
                    </div>
                    <div class="c-list--td">
                        <p>@if(isset($bank->name)) {{ $bank->name }} @endif</p>
                    </div>
                </div>
            @endif
        @endif
    </div>
    <div class="l-button--submit">
        @if($bank)
            <a class="c-button--square__pink" href="{{ route('mypage.t.bank.edit') }}">銀行情報を変更する</a>
        @else
            <a class="c-button--square__pink" href="{{ route('mypage.t.bank.edit') }}">銀行情報を追加する</a>
        @endif
    </div>
@endsection

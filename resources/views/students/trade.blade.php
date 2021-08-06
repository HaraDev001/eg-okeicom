@extends(($user_status == 0)?'layouts.user':'layouts.teacher')

{{--  タイトル・メタディスクリプション  --}}
@section('title', '入出金管理')
@section('description', '入出金管理')

{{--  CSS  --}}
@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<link rel="stylesheet" href="{{ asset('/css/foundation/single/userDealing.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.1/remodal-default-theme.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.1/remodal.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush

{{--  JS  --}}
@push('js')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.1/remodal.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/l10n/ja.js" defer></script>
<script src="{{asset('/custom/datepicker.js')}}"></script>
@endpush


{{-- 本文  --}}
@section('content')
    <!-- remodal -->
    <div class="remodal w80" data-remodal-id="modal" id="modal">
        <form id='csvform' action="{{ route('mypage.t.trade.csv.export') }}" method="POST" autocomplete="on">
            @csrf
            <div class='row mb-3'>
                <div class="col-md-5">
                    <label class='h6'>Export Start Date</label>
                </div>
                <div class="col-md-2 h2 d-flex justify-content-center align-items-center"></div>
                <div class="col-md-5">
                    <label class='h6'>Export End Date</label>
                </div>
            </div> <!-- row -->
            <div class='row mb-3'>
                <!--datepicker-->
                <div class="col-md-5">
                    <input id="datepicker" data-provide="datepicker" class="form-control datepicker js-start-date" type="datetime"
                    placeholder="出力開始日" name="start_date" value="" dusk='datepicker_first' autocomplete="off">
                </div>
                <div class="col-md-2 h2 d-flex justify-content-center align-items-center">
                    〜
                </div>
                <div class="col-md-5">
                    <input id="datepickers" data-provide="datepicker" class="form-control datepicker js-end-date" type="datetime" placeholder="出力終了日"
                    name="end_date" value="" dusk='datepicker_last' autocomplete="off">
                </div>
            </div> <!-- row -->

            <button data-remodal-action="cancel" class="btn btn-secondary">キャンセル</button>
            <button type='submit' class="btn btn-primary">ダウンロード</button>
        </form>
    </div> <!-- remodal -->

    <div class="user-detaling-total">
        <div class="user-detaling-total--price">
            <span>¥{{ number_format($holding_amount) }}</span>
        </div>
        <div class="user-detaling-total--request">
            <a href="{{ route('mypage.t.payment.create') }}" @if($holding_amount === 0) class="disabled" disabled="disabled" tabindex="-1" @endif>出金リクエスト</a>
            {{--  <form method="POST" action="{{ route('mypage.u.payment.create') }}">
                <button type="submit" class="c-button--square__pink" @if($holding_amount->separate_comma_amount == '¥0') disabled @endif>出金リクエスト</button>
            </form>  --}}
        </div>
    </div>
    {{--  tab：ゆうちょ  --}}
    <div class="l-list--deal">
        {{-- <div class="l-list--deal--period">
            <p class="u-color--grayNavy u-text--small">表示対象期間</p>
            <div class="c-selectBox">
                <select id="months" name="months" class="form-control" autocomplete="months">
                    @foreach ($trade_months as $trade_month)
                        <option value="{{ $trade_month->months }}" @if ($loop->first) selected  @endif>{{ date("Y年n月j日" ,strtotime($trade_month->months)) }}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}
        <div class="l-list--deal--period">
            <p class="u-color--grayNavy u-text--small"><a href="#modal" class="btn btn-primary">取引履歴をCSVファイルでダウンロード</a></p>
        </div>
        {{--  スマホ  --}}
        <div class="l-list--deal--detail sp-only">
            @foreach ($trade_details as $trade_detail)
            <div class="l-list--deal--detail--content">
                <div class="price">

                    @if($trade_detail->add_sign_amount < 0)
                        <p class="trade minus">{{ $trade_detail->separate_comma_point_add_sign_amount }}</p>
                    @else
                        <p class="trade add">{{ $trade_detail->separate_comma_point_add_sign_amount }}</p>
                    @endif
                    {{--  <p class="trade minus">{{ $trade_detail->separate_comma_point_add_sign_amount }}</p>  --}}
                    <p class="balance">（残 {{ $trade_detail->separate_comma_point_amount }}）</p>
                </div>
                <div class="detail">
                    <p class="time">{{ $trade_detail->formated_ymd_created_at }}</p>
                    @if($trade_detail->lessons_title == '出金')
                    <p class="item">出金</p>
                    <p class="deal"></p>
                    @else
                    <p class="item">売上</p>
                    <p class="deal">「レッスンタイトルタイトル」</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        {{--  PC  --}}
        <div class="l-list--deal--detail pc-only">
            <table>
                <thead>
                    <tr>
                        <td>日付</td>
                        <td>対象レッスン</td>
                        <td>入金</td>
                        <td>出金</td>
                        <td>残高</td>
                    </tr>
                </thead>
                @foreach ($trade_details as $trade_detail)
                <tr>
                    <td>{{ $trade_detail->formated_ymd_created_at }}</td>
                    @if($trade_detail->lessons_title == '出金')
                    <td>出金依頼 <-> {{ $trade_detail->lessons_title }}</td>
                    <td>1</td>
                    <td class="u-textAlign__right">{{ $trade_detail->separate_comma_amount }}</td>
                    @else
                    <td>「{{ $trade_detail->lessons_title }}」</td>
                    <td class="u-textAlign__right">{{ $trade_detail->separate_comma_amount }}</td>
                    <td></td>
                    @endif
                    <td class="u-textAlign__right">{{ $trade_detail->separate_comma_point_amount }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection

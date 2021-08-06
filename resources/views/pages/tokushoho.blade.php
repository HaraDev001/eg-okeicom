{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>特商法に基づく表示</h2>
            </div>
        </div>
    </div>
@endsection --}}




@extends('layouts.common')

<!-- タイトル・メタディスクリプション -->
@section('title', '特定商取引法に基づく表記')
@section('description', 'パスワード再設定完了')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')

<div class="l-wrap--main">
	<div class="l-page">
		<table>
			<tr>
				<th>サービス名称</th>
				<td>おけいcom</td>
			</tr>
			<tr>
				<th>事業者名</th>
				<td>株式会社アイリック</td>
			</tr>
			<tr>
				<th>代表者名</th>
				<td>遠藤　洋</td>
			</tr>
			<tr>
				<th>所在地</th>
				<td>〒600-8412<br>京都市下京区二帖半敷町６４６番地ダイマルヤ四条烏丸ビル７階</td>
			</tr>
			<tr>
				<th>URL</th>
				<td>https://okeicom.com</td>
			</tr>
			<tr>
				<th>電話番号</th>
				<td>075-352-0282</td>
			</tr>
			<tr>
				<th>メールアドレス</th>
				<td>info@okeicom.com</td>
			</tr>
			<tr>
				<th>業務内容</th>
				<td>各種オンラインレッスンの提供</td>
			</tr>
			<tr>
				<th>販売価格</th>
				<td>各講師が設定した料金</td>
			</tr>
			<tr>
				<th>お支払い方法</th>
				<td>お支払い方法：<br><br>・銀行振込<br>・クレジットカード決済<br>・コンビニ決済<br>クレジットカードでの決済はVISA、MASTER、JCB、AMEX、Dinersがご利用いただけます。<br><br>お支払い時期：前払い
				</td>
			</tr>
			<tr>
				<th>商品代金以外の必要料金</th>
				<td>・銀行振込、コンビニ決済の場合の手数料（クレジットカード決済にかかる手数料は弊社が負担いたします。）<br>・本サービスを利用し、またはレッスンを受講する際にかかる通信料および接続料<br>・ヘッドセット、マイク、イヤホン等弊社システムを利用するために必要な機器の購入費用
				</td>
			</tr>
			<tr>
				<th>サービス開始手続き</th>
				<td>弊社のサービスをご利用いただくには会員登録が必要です。<br>会員登録後、受講者がレッスン契約の申し込みをした後に、サービスの提供が開始されます。</td>
			</tr>
			<tr>
				<th>料金の返還・アカウント削除</th>
				<td>アカウント削除をご希望される場合には、弊社所定の手続きに従い申請ください。<br>受講者規約第25条第2項に定める場合を除き、料金の払戻は行わないものとします。</td>
			</tr>
		</table>
	</div>
</div>

@endsection
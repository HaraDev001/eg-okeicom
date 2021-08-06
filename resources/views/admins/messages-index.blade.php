
@extends('layouts.owner')

<!-- タイトル・メタディスクリプション -->
@section('title', 'メッセージ一覧 | おけいcom')
@section('description', 'メッセージ一覧')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
	<div class="l-wrap--owner--main">
		<div class="l-wrap--owner--header">
			<div class="l-wrap--owner--header--title">
				<p>メッセージ一覧</p>
			</div>
		</div>
		<div class="l-wrap--owner--body">
			<div class="l-wrap--owner--body--inner">
                <admin-message-list />
				{{--  <table>
					<thead>
						<tr>
							<td>送り先</td>
							<td>受け取り先</td>
							<td>メッセージ内容</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php for($i=0;$i<20;$i++): ?>
							<tr>
								<td style="white-space: nowrap;"><a href="" class="u-text--link">中澤　寛</a></td>
								<td style="white-space: nowrap;"><a href="" class="u-text--link">田中　達也</a></td>
								<td>メッセージ詳細メッセージ詳細メッセージ詳細メッセージ詳細メッセージ詳細メッセージ詳細メッセージ詳細メッセージ詳細メッセージ詳細メッセージ詳細メッセージ詳細メッセージ詳細メッセージ詳細メッセージ詳細メッセージ詳細メッセージ詳細メッセージ詳細メッセージ詳細</td>
								<td>
									<div class="c-button--edit">
										<a href="" class="c-button--edit--link delete">削除</a>
									</div>
								</td>
							</tr>
						<?php endfor; ?>
					</tbody>
				</table>  --}}
			</div>
			{{--  <div class="pagenation-list">
				<ul>
					<li class="now">１</li>
					<?php for($i=2;$i<10;$i++): ?>
						<li><a href=""><?php echo $i; ?></a></li>
					<?php endfor; ?>
				</ul>
			</div>  --}}
		</div>
	</div>
@endsection

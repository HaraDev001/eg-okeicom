@extends('layouts.owner')

<!-- タイトル・メタディスクリプション -->
@section('title', '取引一覧（確定前） | おけいcom')
@section('description', '取引一覧（確定前）')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
	<div class="l-wrap--owner--main">
		<div class="l-wrap--owner--header">
			<div class="l-wrap--owner--header--title">
				<p>取引一覧（確定前）</p>
			</div>
		</div>
		<div class="l-wrap--owner--body">
			<div class="l-wrap--owner--body--inner">
                <admin-application-before-list />
				{{--  <table>
					<thead>
						<tr>
							<td>支払い者</td>
							<td>受け取り者</td>
							<td>金額</td>
							<td>内容</td>
							<td>詳細</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<!-- レッスン受講料、取り消し可能 -->
						<?php for($i=0;$i<5;$i++): ?>
							<tr>
								<td style="white-space: nowrap;"><a href="" class="u-text--link">中澤　寛</a></td>
								<td style="white-space: nowrap;"><a href="" class="u-text--link">田中　達也</a></td>
								<td>¥3,000</td>
								<td>レッスン受講</td>
								<td>レッスンタイトルレッスンタイトル</td>
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
			{{-- <div class="pagenation-list">
				<ul>
					<li class="now">１</li>
					<?php for($i=2;$i<10;$i++): ?>
						<li><a href=""><?php echo $i; ?></a></li>
					<?php endfor; ?>
				</ul>
			</div> --}}
		</div>
	</div>
@endsection

@extends('layouts.owner')

<!-- タイトル・メタディスクリプション -->
@section('title', 'お知らせ一覧 | おけいcom')
@section('description', 'お知らせ一覧')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
	<div class="l-wrap--owner--main">
		<div class="l-wrap--owner--header">
			<div class="l-wrap--owner--header--title">
				<p>お知らせ一覧</p>
			</div>
		</div>
		<div class="l-wrap--owner--body">
			<div class="l-wrap--owner--body--inner">
				<table>
					<thead>
						<tr>
							<td>日時</td>
							<td>タイトル</td>
							{{--  <td>配信内容</td>  --}}
							<td></td>
						</tr>
					</thead>
					<tbody>
                        @foreach($announcements as $announcement)
                        <tr>
                            <td style="white-space: nowrap;">{{ $announcement->created_at }}</td>
                            <td>{{ $announcement->title }}</></td>
                            {{--  <td>$announcement->detail</td>  --}}
                            <td>
                                <form action="{{ route('admins.news.delete', ['id' => $announcement->id]) }}" method="post">
                                    @csrf
                                    <div class="c-button--edit two-button">
                                        <a href="/owner-admin/news/edit/{{ $announcement->id }}" class="c-button--edit--link edit">編集</a>
                                        <button type="submit" class="c-button--edit--link delete">
                                            削除
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
					</tbody>
				</table>
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

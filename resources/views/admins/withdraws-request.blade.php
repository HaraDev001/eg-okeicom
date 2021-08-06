
@extends('layouts.owner')

{{--  タイトル・メタディスクリプション  --}}
@section('title', '出金リクエスト | おけいcom')
@section('description', '出金リクエスト')

{{--  CSS  --}}
@push('css')
@endpush

{{--  本文  --}}
@section('content')
	<div class="l-wrap--owner--main">
		<div class="l-wrap--owner--main--inner">
			<div class="l-wrap--owner--header">
				<div class="l-wrap--owner--header--title">
					<p>出金リクエスト一覧</p>
				</div>
            </div>
			<div class="l-wrap--owner--body">
				<div class="l-wrap--owner--body--inner">
                    <admin-withdrawal-list />
                </div>
			</div>
		</div>
	</div>
@endsection

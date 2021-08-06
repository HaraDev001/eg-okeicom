@extends('layouts.app')

{{--  タイトル・メタディスクリプション  --}}
@section('title', 'レッスン詳細')
@section('description', 'おけいcomの詳細ページです。')

{{--  CSS  --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/lessonDetail.css') }}">
@endpush

{{-- 本文  --}}
@section('content')
    {{--
    <lesson-show-component></lesson-show-component>
    --}}
    {{--  エラーメッセージ  --}}
    @if ($errors->any())
    <div class="l-alart errorAlart" role="alert">
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    {{--  本文  --}}
	<div class="l-lessonDetail">
        @if($checkPurchase)
        <div class="l-lessonDetail__browsing">
			<div class="l-allWrapper">
                {{-- 終了時間による条件分岐 --}}
                @if($currentDate <= $finishDate)
                    @if($currentDate >= $basicDate)
                        @if($lesson->type == 2)
                            @if($checkPurchase->status == 0)
                                <a href="{{ route('lessons.browsing', $lesson->id) }}" target="_blank" rel="noopener noreferrer">レッスンを見る</a>
                            @endif
                        @else
                            @if($checkPurchase->status == 0)
                            <a href="{{ $lesson->url }}" target="_blank" rel="noopener noreferrer">レッスンを見る</a>
                            @endif
                        @endif
                    @else
                        <p class="lesson-wait">レッスン開始までお待ちください。</p>
                    @endif
                @else
                    <p class="lesson-fin">レッスンは終了しています。</p>
                @endif
            </div>
        </div>
        @endif
		<div class="l-lessonDetail__header">
			<div class="l-allWrapper">
				<div class="l-lessonDetail__header__inner cf">
					<div class="c-lessonDetail__headline">
						<p class="title">{{ $lesson->title }}</p>
						<div class="sub">
							<span class="application">申込人数：{{ $lesson->applicants_number ? $lesson->applicants_number : '0'}}人</span>
							<span class="evaluation"><img src="/img/common/icon-star.png">{{ $lesson->round_avg_point }}</span>
						</div>
                    </div>
                    <detail-img-list-component
                        :img-lists='@json($courseImgLists)'
                    >
                    </detail-img-list-component>
					<div class="c-lessonDetail__info">
						<div class="other l-flex l-v__center @if($currentDate >= $basicDate) l-start @endif">
							<div class="other__price">
								<p class="price">{{ $lesson->separate_comma_price }}</p>
								<p class="cancel">キャンセル手数料：{{ $lesson->cancel_rate }}%（¥{{ $lesson->comma_cancel_price }}）</p>
							</div>
							<div class="other__date">
								<p class="date">{{ $lesson->date_slash }}<span class="week">({{ $lesson->week }})</span><br>{{ $lesson->separate_hyphen_time}}</p>
                            </div>
                            @if($checkPurchase)
                                @if($currentDate <= $basicDate)
                                    <div class="other_reserve">
                                        <a href="{{ route('lessons.cancel') }}">キャンセルする</a>
                                    </div>
                                @endif
                            @else
                                @if($currentDate <= $finishDate)
                                    <div class="other_reserve">
                                        <a href="{{ route('lessons.application') }}">予約する</a>
                                    </div>
                                @else
                                @endif
                            @endif
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="l-lessonDetail__body">
        <div class="l-allWrapper">
            <div class="l-lessonDetail__body__inner l-flex">
                <div class="l-lessonDetail__body__main">
                    <div class="c-lessonDetail__content">
                        <div class="c-lessonDetail__content__title">
                            <h2>レッスン詳細</h2>
                        </div>
                        <div class="c-lessonDetail__content__wrap lesson-detail">
                            <p class="detail">{{ $lesson->detail}}</p>
                            <table>
                                <tr>
                                    <th>タイプ</th>
                                    <td>
                                        @if($lesson->type == 0) LIVE
                                        @elseif($lesson->type == 1) 動画
                                        @elseif($lesson->type == 2) 資料
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>カテゴリー</th>
                                    <td>
                                        @isset($lesson->category1_name)
                                        <span class="category">{{ $lesson->category1_name }}</span>
                                        @endisset
                                        @isset($lesson->category2_name)
                                        <span class="category">{{ $lesson->category2_name }}</span>
                                        @endisset
                                        @isset($lesson->category3_name)
                                        <span class="category">{{ $lesson->category3_name }}</span>
                                        @endisset
                                        @isset($lesson->category4_name)
                                        <span class="category">{{ $lesson->category4_name }}</span>
                                        @endisset
                                        @isset($lesson->category5_name)
                                        <span class="category">{{ $lesson->category5_name }}</span>
                                        @endisset
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="c-lessonDetail__content">
                        <div class="c-lessonDetail__content__title">
                            <h2>講師の口コミ</h2>
                        </div>
                        <div class="c-lessonDetail__content__wrap lesson-comment">
                            @foreach ($evaluations as $evaluation)
                            <div class="c-userComment__box">
                                <div class="c-userComment__human l-flex l-start l-v__center">
                                    <div class="img">
                                        <div class="c-img--round c-img--cover">
                                            <img src="{{ asset('/storage/profile/' . $evaluation->img) }}">
                                        </div>
                                    </div>
                                    <div class="info">
                                        <p class="name">{{ $evaluation->name }}</p>
                                        <p class="other">
                                            <span class="evaluation"><img src="/img/common/icon-star.png">{{ $evaluation->point }}</span>
                                            <span class="date">{{ $evaluation->created_at }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="c-userComment__content">
                                    <p>{{ $evaluation->comment }}</p>
                                </div>
                            </div>
                            @endforeach
                            {{--  <div class="c-userComment__box">
                                <div class="c-userComment__human l-flex l-start l-v__center">
                                    <div class="img">
                                        <div class="c-img--round c-img--cover">
                                            <img src="/img/common/screen-top.jpg">
                                        </div>
                                    </div>
                                    <div class="info">
                                        <p class="name">TANAKA ATSUSHI</p>
                                        <p class="other">
                                            <span class="evaluation"><img src="/img/common/icon-star.png">4.8</span>
                                            <span class="date">2020-12-13 23:00</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="c-userComment__content">
                                    <p>レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細</p>
                                </div>
                            </div>  --}}
                        </div>
                    </div>
                </div>
                <div class="l-lessonDetail__body__sidebar">
                    <div class="l-lessonDetail__body__sidebar__title sp-only">
                        <h2>講師紹介</h2>
                    </div>
                    <div class="l-lessonDetail__body__sidebar__wrap">
                        <div class="teacher__img">
                            <a href="/teachers/detail/{{ $user->id }}">
                                <div class="teacher__img__inner c-img--round c-img--cover">
                                    <img src="{{ asset('/storage/profile/' . $user->img ) }}">
                                </div>
                            </a>
                        </div>
                        <div class="teacher__profile">
                            <div class="teacher__profile__detail">
                                <p class="name"><a class="u-text--link" href="/teachers/detail/{{ $user->id }}">{{ $user->name}}</a></p>
                                <p class="evaluation"><img src="/img/common/icon-star.png">{{ $lesson->round_avg_point }}</p>
                            </div>
                            <ul class="c-teacher--box__category l-flex l-center">
                                @isset($user->category1_name)
                                <li><span>{{ $user->category1_name }}</span></li>
                                @endisset
                                @isset($user->category2_name)
                                <li><span>{{ $user->category2_name }}</span></li>
                                @endisset
                                @isset($user->category3_name)
                                <li><span>{{ $user->category3_name }}</span></li>
                                @endisset
                                @isset($user->category4_name)
                                <li><span>{{ $user->category4_name }}</span></li>
                                @endisset
                                @isset($user->category5_name)
                                <li><span>{{ $user->category5_name }}</span></li>
                                @endisset
                            </ul>
                        </div>
                        <div class="techer__detail">
                            <p>{{ $user->profile }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="l-scroll lessonDetailVersion">
		<div class="l-allWrapper">
			<div class="l-scroll__wrap">
				<div class="l-scroll__box">
					<div class="c-scroll__title l-flex l-v__center">
						<h2>関連コース</h2>
					</div>
					<div class="l-scroll__list">
						<div class="l-scroll__list__wrap l-flex l-start">

                            @foreach ($relatedLessons as $relate)
                            <div class="c-scroll__box">
								<a class="c-scroll__box__inner" href="/lessons/detail/{{ $relate->id }}">
									<div class="c-scroll__box__img c-img--cover">
                                        <img src="{{ asset('/storage/courses/' . $courseImgLists['img1']) }}">
									</div>
									<div class="c-scroll__box__teacher l-flex l-v__bottom">
										<div class="c-scroll__box__teacher__img">
											<div class="scroll__box__teacher__img__inner c-img--round c-img--cover">
                                                <img src="{{ asset('/storage/profile/' . $user->img) }}">
											</div>
										</div>
										<div class="c-scroll__box__teacher__evaluation">
											<img src="/img/common/icon-star.png">
											<span class="evaluationNumber">{{ $relate->round_avg_point}}</span>
										</div>
									</div>
									<div class="c-scroll__box__detail l-flex">
										<span class="number">第{{ $relate->rowNumber}}回</span>
										<span class="price">{{ $relate->separate_comma_price}}</span>
									</div>
									<div class="c-scroll__box__text">
										<p>{{ $relate->title }}</p>
									</div>
									<p class="c-scroll__box__time">
										<span class="date">{{ $lesson->add_week_date }}</span>
										<time>{{ $lesson->separate_hyphen_time }}</time>
									</p>
								</a>
                            </div>
                            @endforeach
							{{--  <div class="c-scroll__box" v-for="i in 5">
								<a class="c-scroll__box__inner" href="">
									<div class="c-scroll__box__img c-img--cover">
										<img src="/img/common/screen-top.jpg">
									</div>
									<div class="c-scroll__box__teacher l-flex l-v__bottom">
										<div class="c-scroll__box__teacher__img">
											<div class="scroll__box__teacher__img__inner c-img--round c-img--cover">
												<img src="/img/common/screen-top.jpg">
											</div>
										</div>
										<div class="c-scroll__box__teacher__evaluation">
											<img src="/img/common/icon-star.png">
											<span class="evaluationNumber">4.8</span>
										</div>
									</div>
									<div class="c-scroll__box__detail l-flex">
										<span class="number">第一回</span>
										<span class="price">¥30,000</span>
									</div>
									<div class="c-scroll__box__text">
										<p>【特別】コロナ時代に生き延びるフリーランの仕</p>
									</div>
									<p class="c-scroll__box__time">
										<span class="date">12月1日</span>
										<time>10:00-12:00</time>
									</p>
								</a>
							</div>  --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

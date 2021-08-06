@extends('layouts.app')

<!-- タイトル・メタディスクリプション -->
@section('title', '検索結果')
@section('description', 'おけいcomの検索結果ページです。')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/searchResult.css') }}">
@endpush

<!-- 本文 -->
@section('content')
    {{-- <search-component
        keyword="{{ $keyword }}"
        :lessons="{{ $lessons }}"
        :categories="{{ $categories }}"
    >
    </search-component> --}}
	<div class="l-screen">
		<div class="l-screen__title">
			<div class="l-allWrapper">
                <h1 class="headline">検索結果一覧</h1>
			</div>
		</div>
		<div class="l-searchResult">
			<div class="l-allWrapper">
				<div class="l-searchResult__wrap l-flex">
					<div class="c-searchResult__block tab l-flex l-v__center">
                        <form action="{{ route('search.index') }}" method="get">
                            <ul class="c-tab">
                                <li class="c-tab--button @if(isset($params['is_target']) && $params['is_target'] == 'lessons') selected @elseif(!isset($params['is_target'])) selected @endif">
                                    <button type="submit" name="is_target" value="lessons">レッスンから選択</button>
                                </li>
                                <li class="c-tab--button @if(isset($params['is_target']) && $params['is_target'] == 'teachers') selected @endif">
                                    <button type="submit" name="is_target" value="teachers">講師から検索</button>
                                </li>
                            </ul>
                        </form>
					</div>
					<div class="c-searchResult__block input l-flex l-v__center">
						<form action="{{ route('search.index') }}" method="get">
                            @foreach ($params as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
							<div class="c-searchResult__block__inner l-flex">
								<div class="searchText">
                                    <input type="text" name="keyword" value="{{ $params['keyword'] ?? '' }}">
                                </div>
                                @if(isset($params['is_target']) && $params['is_target'] == 'teachers')
                                @else
                                    <div class="searchDate pc-only">
                                        <vuejs-datepicker-component name="select_date" value="{{ $params['select_date'] ?? '' }}"></vuejs-datepicker-component>
                                    </div>
                                @endif
								<div class="searchSubmit pc-only">
                                    <button type="submit">検索</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="l-contentList">
        <div class="l-allWrapper">
            <div class="l-contentList__wrap l-flex">
                <sidebar-component
                    :categories="{{ $categories }}"
                    categories_id="{{ $params['categories_id'] ?? '' }}"
                    path="{{ '/search' }}"
                    target="{{ $params['is_target'] ?? '' }}"
                >
                </sidebar-component>
                <div class="l-contentList__list">
                    <div class="l-contentList__list__headline l-flex">
                        <div class="headlineContent info">
                            @if($teachers)
                                <h2 class="title">講師一覧を表示</h2>
                                <p class="number">{{ $teachers->total() ?? '0' }}件中 {{ $teachers->firstItem() ?? '0' }}-{{ $teachers->lastItem() ?? '0' }}件を表示</p>
                            @else
                                <h2 class="title">レッスン一覧を表示</h2>
                                <p class="number">{{ $lessons->total() ?? '0' }}件中 {{ $lessons->firstItem() ?? '0' }}-{{ $lessons->lastItem() ?? '0' }}件を表示</p>
                            @endif
                        </div>
                        <div class="headlineContent sort l-flex l-v__center">
                            <span>並び替え</span>
                            <div class="c-selectBox">
                                <form action="{{ route('search.index') }}" method="get">
                                    @foreach ($params as $key => $value)
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endforeach
                                    @if($lessons)
                                    <select name="sort_param" class="c-input--gray" onchange="submit(this.form)">
                                        <option value="newDate" @if(isset($params['sort_param']) && $params['sort_param'] == 'newDate') selected @endif>新着順</option>
                                        <option value="dateLate" @if(isset($params['sort_param']) && $params['sort_param'] == 'dateLate') selected @endif>開催日が近い順</option>
                                        <option value="participantHigh" @if(isset($params['sort_param']) && $params['sort_param'] == 'participantHigh') selected @endif>参加者が多い順</option>
                                        <option value="evaluationHigh" @if(isset($params['sort_param']) && $params['sort_param'] == 'evaluationHigh') selected @endif>評価が高い順</option>
                                        <option value="priceLow" @if(isset($params['sort_param']) && $params['sort_param'] == 'priceLow') selected @endif>料金が安い順</option>
                                    </select>
                                    @elseif($teachers)
                                    <select name="sort_param" class="c-input--gray" onchange="submit(this.form)">
                                        <option value="new" @if(isset($params['sort_param']) && $params['sort_param'] == 'new') selected @endif>新着順</option>
                                        <option value="evaluation" @if(isset($params['sort_param']) && $params['sort_param'] == 'evaluation') selected @endif>評価が高い順</option>
                                    </select>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="l-contentList__list__wrap">
                        @if($teachers)
                            @foreach($teachers as $teacher)
                                <div class="l-content--teacher">
                                    <a href="/teachers/detail/{{ $teacher->id }}">
                                        <div class="l-content--teacher__inner l-flex">
                                            <div class="u-w100">
                                                <div class="c-img--round c-img--cover">
                                                    <img src="{{ $teacher->public_path_img }}">
                                                </div>
                                            </div>
                                            <div class="u-wflex1 u-pl10">
                                                <p class="u-text--big u-mb10">
                                                    @if($teacher->sex == 0)
                                                        <span class="c-text--sex gender u-mr10">不明</span>
                                                    @elseif($teacher->sex == 1)
                                                        <span class="c-text--sex man u-mr10">男性</span>
                                                    @elseif($teacher->sex == 2)
                                                        <span class="c-text--sex woman u-mr10">女性</span>
                                                    @endif
                                                    <a>{{ $teacher->name }}</a>
                                                </p>
                                                <div class="c-text--evaluation">
                                                    <div class="star">
                                                        <img src="/img/common/icon-star.png">
                                                        <span class="evaluation">{{ $teacher->round_avg_point }}</span>
                                                    </div>
                                                    <p class="review">レビュー {{ $teacher->count }}件</p>
                                                </div>
                                                <ul class="c-text--category u-mt10">
                                                    @if ($teacher->category1_name)
                                                        <li>{{ $teacher->category1_name }}</li>
                                                    @endif
                                                    @if ($teacher->category2_name)
                                                        <li>{{ $teacher->category2_name }}</li>
                                                    @endif
                                                    @if ($teacher->category3_name)
                                                        <li>{{ $teacher->category3_name }}</li>
                                                    @endif
                                                    @if ($teacher->category4_name)
                                                        <li>{{ $teacher->category4_name }}</li>
                                                    @endif
                                                    @if ($teacher->category5_name)
                                                        <li>{{ $teacher->category5_name }}</li>
                                                    @endif
                                                </ul>
                                                <p class="u-text--sentence u-mt10 pc-only">{{ $teacher->profile }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            @foreach($lessons as $lesson)
                                <div class="c-contentList__box">
                                    <a class="c-contentList__box__inner" href="/lessons/detail/{{ $lesson->id }}">
                                        <div class="c-contentList__box__img">
                                            <div class="c-img--cover">
                                                <img src="{{ $lesson->public_path_course_img1 }}">
                                            </div>
                                        </div>
                                        <div class="c-contentList__box__info">
                                            <div class="number l-flex">
                                                <p class="other">
                                                    <span class="stage">第{{ $lesson->rowNumber }}回</span>
                                                    <span>{{ $lesson->user_point }}</span>
                                                    <span class="date">{{ $lesson->add_week_date }} {{ $lesson->separate_hyphen_time }}</span>
                                                </p>
                                                <p class="price">{{ $lesson->separate_comma_price }}</p>
                                            </div>
                                            <p class="title">{{ $lesson->title }}</p>
                                            <p class="detail pc-only">{{ $lesson->detail }}</p>
                                            <div class="category">
                                                @if ($lesson->category1_name)
                                                    <span>{{ $lesson->category1_name }}</span>
                                                @endif
                                                @if ($lesson->category2_name)
                                                    <span>{{ $lesson->category2_name }}</span>
                                                @endif
                                                @if ($lesson->category3_name)
                                                    <span>{{ $lesson->category3_name }}</span>
                                                @endif
                                                @if ($lesson->category4_name)
                                                    <span>{{ $lesson->category4_name }}</span>
                                                @endif
                                                @if ($lesson->category5_name)
                                                    <span>{{ $lesson->category5_name }}</span>
                                                @endif
                                            </div>
                                            <div class="teacher l-flex l-start l-v__center pc-only">
                                                <div class="teacherImg">
                                                    <div class="teacherImgInner c-img--round c-img--cover">
                                                        <img src="{{ $lesson->public_path_users_img }}">
                                                    </div>
                                                </div>
                                                <div class="teacherEvaluation">
                                                    <img src="/img/common/icon-star.png">
                                                    <span class="evaluationNumber">{{ $lesson->round_avg_point}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="l-pagenation">
                        <ul class="l-pagenation__list">
                            @if($teachers)
                                @for ($i = 1; $i < $teachers->lastPage()+1; $i++)
                                    <li class="{{ $i == $teachers->currentPage() ? 'selected disabled' : ''}}">
                                        <a href="{{ $teachers->withQueryString()->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                            @else
                                @for ($i = 1; $i < $lessons->lastPage()+1; $i++)
                                    <li class="{{ $i == $lessons->currentPage() ? 'selected disabled' : ''}}">
                                        <a href="{{ $lessons->withQueryString()->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

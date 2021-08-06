@extends('layouts.app')

@section('content')

<div class="topScreen">
  <div class="l-allWrapper">
    <div class="topScreen__text">
      <p class="topScreen__title">自宅で好きな時に<br>習い事！</p>
      <p class="topScreen__sub">オンライン学習サイト<br>「おけい.com」</p>
      @if( !Auth::check() )
      <div class="topScreen__link">
          <a class="c-button--round right-arrow-round" href="{{ route('email.verify') }}">新規登録</a>
      </div>
      @endif
    </div>
  </div>
</div>
<div class="l-scroll">
    <div class="l-allWrapper">
        <div class="l-scroll__wrap">
            <div class="l-scroll__box">
                <div class="c-scroll__title l-flex l-v__center">
                    <h2>本日の放送するレッスン</h2>
                    <a href="{{ route('lessons.index') }}">一覧へ</a>
                </div>
                <div class="l-scroll__list">
                    <div class="l-scroll__list__wrap l-flex l-start">
                        @foreach($today_lessons as $today_lesson)
                        <div class="c-scroll__box">
                            <a class="c-scroll__box__inner" href="{{ route('lessons.detail', ['id' => $today_lesson->id]) }}">
                                <div class="c-scroll__box__img c-img--cover">
                                    <img src="{{ $today_lesson->public_path_course_img1 }}">
                                </div>
                                <div class="c-scroll__box__teacher l-flex l-v__bottom">
                                    <div class="c-scroll__box__teacher__img">
                                        <div class="scroll__box__teacher__img__inner c-img--round c-img--cover">
                                            <img src="{{ $today_lesson->public_path_users_img }}">
                                        </div>
                                    </div>
                                    <div class="c-scroll__box__teacher__evaluation">
                                        <img src="{{ asset('/img/common/icon-star.png') }}">
                                        <span class="evaluationNumber">{{ $today_lesson->round_avg_point }}</span>
                                    </div>
                                </div>
                                <div class="c-scroll__box__detail l-flex">
                                    <span class="number">第{{ $today_lesson->rowNumber }}回</span>
                                    <span class="price">{{ $today_lesson->separate_comma_price }}</span>
                                </div>
                                <div class="c-scroll__box__text">
                                    <p>{{ $today_lesson->title }}</p>
                                </div>
                                <p class="c-scroll__box__time">
                                    <span class="date">{{ $today_lesson->formated_md_date }}</span>
                                    <time>{{ $today_lesson->separate_hyphen_time }}</time>
                                </p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="l-scroll__box">
                <div class="c-scroll__title">
                    <h2>参加者が多いレッスン</h2>
                </div>
                <div class="l-scroll__list">
                    <div class="l-scroll__list__wrap l-flex l-start">
                        @foreach($popular_lessons as $popular_lesson)
                        <div class="c-scroll__box">
                            <a class="c-scroll__box__inner" href="{{ route('lessons.detail', ['id' => $popular_lesson->id]) }}">
                                <div class="c-scroll__box__img c-img--cover">
                                    <img src="{{ $popular_lesson->public_path_course_img1 }}">
                                </div>
                                <div class="c-scroll__box__teacher l-flex l-v__bottom">
                                    <div class="c-scroll__box__teacher__img">
                                        <div class="scroll__box__teacher__img__inner c-img--round c-img--cover">
                                            <img src="{{ $popular_lesson->public_path_users_img }}">
                                        </div>

                                    </div>
                                    <div class="c-scroll__box__teacher__evaluation">
                                        <img src="{{ asset('/img/common/icon-star.png') }}">
                                        <span class="evaluationNumber">{{ $popular_lesson->round_avg_point }}</span>
                                    </div>
                                </div>
                                <div class="c-scroll__box__detail l-flex">
                                    <span class="number">第{{ $popular_lesson->rowNumber }}回</span>
                                    <span class="price">{{ $popular_lesson->separate_comma_price }}</span>
                                </div>
                                <div class="c-scroll__box__text">
                                    <p>{{ $popular_lesson->title }}</p>
                                </div>
                                <p class="c-scroll__box__time">
                                    <span class="date">{{ $popular_lesson->formated_md_date }}</span>
                                    <time>{{ $popular_lesson->separate_hyphen_time }}</time>
                                </p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="l-scroll__box">
                <div class="c-scroll__title">
                    <h2>講師の評価が高いレッスン</h2>
                </div>
                <div class="l-scroll__list">
                    <div class="l-scroll__list__wrap l-flex l-start">
                        @foreach($highly_rated_lessons as $highly_rated_lesson)
                        <div class="c-scroll__box">
                            <a class="c-scroll__box__inner" href="{{ route('lessons.detail', ['id' => $highly_rated_lesson->id]) }}">
                                <div class="c-scroll__box__img c-img--cover">
                                    <img src="{{ $highly_rated_lesson->public_path_course_img1 }}">
                                </div>
                                <div class="c-scroll__box__teacher l-flex l-v__bottom">
                                    <div class="c-scroll__box__teacher__img">
                                        <div class="scroll__box__teacher__img__inner c-img--round c-img--cover">
                                            <img src="{{ $highly_rated_lesson->public_path_users_img }}">
                                        </div>

                                    </div>
                                    <div class="c-scroll__box__teacher__evaluation">
                                        <img src="{{ asset('/img/common/icon-star.png') }}">
                                        <span class="evaluationNumber">{{ $highly_rated_lesson->round_avg_point }}</span>
                                    </div>
                                </div>
                                <div class="c-scroll__box__detail l-flex">
                                    <span class="number">第{{ $highly_rated_lesson->rowNumber }}回</span>
                                    <span class="price">{{ $highly_rated_lesson->separate_comma_price }}</span>
                                </div>
                                <div class="c-scroll__box__text">
                                    <p>{{ $highly_rated_lesson->title }}</p>
                                </div>
                                <p class="c-scroll__box__time">
                                    <span class="date">{{ $highly_rated_lesson->formated_md_date }}</span>
                                    <time>{{ $highly_rated_lesson->separate_hyphen_time }}</time>
                                </p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="l-scroll__box">
                <div class="c-scroll__title">
                    <h2>新着レッスン</h2>
                </div>
                <div class="l-scroll__list">
                    <div class="l-scroll__list__wrap l-flex l-start">
                        @foreach($new_arrival_lessons as $new_arrival_lesson)
                        <div class="c-scroll__box">
                            <a class="c-scroll__box__inner" href="{{ route('lessons.detail', ['id' => $new_arrival_lesson->id]) }}">
                                <div class="c-scroll__box__img c-img--cover">
                                    <img src="{{ $new_arrival_lesson->public_path_course_img1 }}">
                                </div>
                                <div class="c-scroll__box__teacher l-flex l-v__bottom">
                                    <div class="c-scroll__box__teacher__img">
                                        <div class="scroll__box__teacher__img__inner c-img--round c-img--cover">
                                            <img src="{{ $new_arrival_lesson->public_path_users_img }}">
                                        </div>
                                    </div>
                                    <div class="c-scroll__box__teacher__evaluation">
                                        <img src="{{ asset('/img/common/icon-star.png') }}">
                                        <span class="evaluationNumber">{{ $new_arrival_lesson->round_avg_point }}</span>
                                    </div>
                                </div>
                                <div class="c-scroll__box__detail l-flex">
                                    <span class="number">第{{ $new_arrival_lesson->rowNumber }}回</span>
                                    <span class="price">{{ $new_arrival_lesson->separate_comma_price }}</span>
                                </div>
                                <div class="c-scroll__box__text">
                                    <p>{{ $new_arrival_lesson->title }}</p>
                                </div>
                                <p class="c-scroll__box__time">
                                    <span class="date">{{ $new_arrival_lesson->formated_md_date }}</span>
                                    <time>{{ $new_arrival_lesson->separate_hyphen_time }}</time>
                                </p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="l-scroll__box">
                <div class="c-scroll__title l-flex l-v__center">
                    <h2>人気の講師</h2>
                    <a href="{{ route('teachers.index') }}">一覧へ</a>
                </div>
                <div class="l-scroll__list">
                    <div class="l-scroll__list__wrap l-flex l-start">
                        @foreach($popular_teachers as $popular_teacher)
                        <div class="c-scroll__box c-teacher--box">
                            <a class="c-teacher--box__inner" href="{{ route('teachers.detail', ['id' => $popular_teacher->id]) }}">
                                <div class="c-teacher--box__img c-img--cover">
                                    <img src="{{ $popular_teacher->public_path_img }}">
                                </div>
                                <p class="c-teacher--box__name">{{ $popular_teacher->name }}</p>
                                <div class="c-teacher--box__evaluation l-flex l-center l-v__center">
                                    <img src="{{ asset('/img/common/icon-star.png') }}">
                                    <span class="evaluationNumber">{{ $popular_teacher->round_avg_point }}</span>
                                </div>
                                <ul class="c-teacher--box__category l-flex l-center">
                                    @if ($popular_teacher->category1_name)
                                        <li>{{ $popular_teacher->category1_name }}</li>
                                    @endif
                                    @if ($popular_teacher->category2_name)
                                        <li>{{ $popular_teacher->category2_name }}</li>
                                    @endif
                                    @if ($popular_teacher->category3_name)
                                        <li>{{ $popular_teacher->category3_name }}</li>
                                    @endif
                                    @if ($popular_teacher->category4_name)
                                        <li>{{ $popular_teacher->category4_name }}</li>
                                    @endif
                                    @if ($popular_teacher->category5_name)
                                        <li>{{ $popular_teacher->category5_name }}</li>
                                    @endif
                                </ul>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="l-scroll__box">
                <div class="c-scroll__title l-flex l-v__center">
                    <h2>新着の講師</h2>
                </div>
                <div class="l-scroll__list">
                    <div class="l-scroll__list__wrap l-flex l-start">
                        @foreach($new_arrival_teachers as $new_arrival_teacher)
                        <div class="c-scroll__box c-teacher--box">
                            <a class="c-teacher--box__inner" href="{{ route('teachers.detail', ['id' => $new_arrival_teacher->id]) }}">
                                <div class="c-teacher--box__img c-img--cover">
                                    <img src="{{ $new_arrival_teacher->public_path_img }}">
                                </div>
                                <p class="c-teacher--box__name">{{ $new_arrival_teacher->name }}</p>
                                <div class="c-teacher--box__evaluation l-flex l-center l-v__center">
                                    <img src="{{ asset('/img/common/icon-star.png') }}">
                                    <span class="evaluationNumber">{{ $new_arrival_teacher->round_avg_point }}</span>
                                </div>
                                <ul class="c-teacher--box__category l-flex l-center">
                                    @if ($new_arrival_teacher->category1_name)
                                        <li>{{ $new_arrival_teacher->category1_name }}</li>
                                    @endif
                                    @if ($new_arrival_teacher->category2_name)
                                        <li>{{ $new_arrival_teacher->category2_name }}</li>
                                    @endif
                                    @if ($new_arrival_teacher->category3_name)
                                        <li>{{ $new_arrival_teacher->category3_name }}</li>
                                    @endif
                                    @if ($new_arrival_teacher->category4_name)
                                        <li>{{ $new_arrival_teacher->category4_name }}</li>
                                    @endif
                                    @if ($new_arrival_teacher->category5_name)
                                        <li>{{ $new_arrival_teacher->category5_name }}</li>
                                    @endif
                                </ul>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

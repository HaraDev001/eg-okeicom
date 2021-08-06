@extends('layouts.app')

{{-- タイトル・メタディスクリプション --}}
@section('title', '講師一覧 | おけいcom')
@section('description', 'おけいcomの講師一覧ページ概要です。')

{{-- CSS --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/teacher.css') }}">
@endpush

{{-- 本文 --}}
@section('content')
    <div class="l-wrap--title">
        <div class="l-wrap">
            <h1 class="c-headline--screen">講師一覧</h1>
        </div>
    </div>
    <div class="l-wrap--body">
        <div class="l-wrap l-flex">
            <sidebar-component
                :categories="{{ $categories }}"
                categories_id="{{ $params['categories_id'] ?? '' }}"
                path="{{ '/teachers' }}"
            >
            </sidebar-component>
            <div class="l-wrap--main">
                <div class="l-contentList__list__headline l-flex">
                    <div class="headlineContent info">
                        <h2 class="title">検索結果一覧を表示</h2>
                        <p class="number">{{ $teachers->total() ?? '0' }}件中 {{ $teachers->firstItem() ?? '0' }}-{{ $teachers->lastItem() ?? '0' }}件を表示</p>
                    </div>
                    <div class="headlineContent sort l-flex l-v__center">
                        <span>並び替え</span>
                        <div class="c-selectBox">
                            <form action="{{ url('teachers') }}" method="get">
                                @foreach ($params as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach
                                <select name="sort_param" class="c-input--gray" onchange="submit(this.form)">
                                    <option value="new" @if(isset($params['sort_param']) && $params['sort_param'] == 'new') selected @endif>新着順</option>
                                    <option value="evaluation" @if(isset($params['sort_param']) && $params['sort_param'] == 'evaluation') selected @endif>評価が高い順</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="l-list--teacher">
                    <form action="{{ url('teachers') }}" method="get">
                        <div class="l-list--teacher__tab three-tab">
                            @foreach ($params as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                            {{-- <button class="tab-box" type="submit" name="is_sex" value="all">
                                <div class="@empty($params['is_sex']) selected @endempty @if(isset($params['is_sex']) && $params['is_sex'] == 'all') selected @endif">全て</div>
                            </button> --}}
                            <button class="tab-box @empty($params['is_sex']) selected @endempty @if(isset($params['is_sex']) && $params['is_sex'] == 'all') selected @endif" type="submit" name="is_sex" value="all">全て</button>
                            <button class="tab-box @if(isset($params['is_sex']) && $params['is_sex'] == 'man') selected @endif" type="submit" name="is_sex" value="man">男性</button>
                            <button class="tab-box @if(isset($params['is_sex']) && $params['is_sex'] == 'female') selected @endif" type="submit" name="is_sex" value="female">女性</button>
                        </div>
                    </form>
                    @if($teachers)
                        @foreach($teachers as $teacher)
                        <div class="l-content--teacher">
                            <a href="/teachers/detail/{{ $teacher->id }}">
                                <div class="l-content--teacher__inner l-flex">
                                    <div class="u-w100">
                                        <div class="c-img--round c-img--cover">
                                            <img src="{{ asset('/storage/profile/' . $teacher->img)}}">
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
                                            {{ $teacher->name }}
                                        </p>
                                        <div class="c-text--evaluation">
                                            <div class="star">
                                                <img src="/img/common/icon-star.png">
                                                <span class="evaluation">{{ $teacher->round_avg_point ? $teacher->round_avg_point : 0 }}</span>
                                            </div>
                                            <p class="review">レビュー {{ $teacher->count ? $teacher->count : 0 }}件</p>
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
                        <p>講師がいません。</p>
                    @endif
                </div>
                <div class="l-pagenation">

                    <ul class="l-pagenation__list">
                        @for ($i = 1; $i < $teachers->lastPage()+1; $i++)
                            <li class="{{ $i == $teachers->currentPage() ? 'selected disabled' : ''}}">
                                <a href="{{ $teachers->withQueryString()->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- <teacher-index-component
        :count={{ $count }}
        :order={{ $order }}
        :page={{ $page }}
        :sex='{{ $sex }}'
        :start={{ $start }}
        :end={{ $end }}
        :page_cnt={{ $page_cnt }}
        :users={{ $users }}
        :categories={{ $categories }}
        :selected_category={{ $selected_category }}></teacher-index-component> --}}
@endsection

<template>
  <div>
    <div class="l-wrap--title">
      <div class="l-wrap">
        <h1 class="c-headline--screen">
          レッスン一覧
        </h1>
      </div>
    </div>
    <div class="l-contentList">
      <div class="l-allWrapper">
        <div class="l-contentList__wrap l-flex">
          <sidebar-component
            :categories="categories"
          />
          <div class="l-contentList__list">
            <div class="l-contentList__list__headline l-flex">
              <div class="headlineContent info">
                <h2 class="title">
                  全てのカテゴリーから検索結果一覧を表示
                </h2>
                <p class="number">
                  {{ lessons.length.toLocaleString() }}件中 1-20件を表示
                </p>
              </div>
              <div class="headlineContent sort l-flex l-v__center">
                <span>並び替え</span>
                <div class="c-selectBox">
                  <select class="c-input--gray">
                    <option>新着順</option>
                    <option>開催日が近い順</option>
                    <option>参加者が多い順</option>
                    <option>評価が高い順</option>
                    <option>料金が安い順</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="l-contentList__list__wrap">
              <div
                v-for="(lesson, index) of lessons"
                :key="index.id"
                class="c-contentList__box"
              >
                <a
                  class="c-contentList__box__inner"
                  :href="`/lessons/detail/${lesson.id}`"
                >
                  <div class="c-contentList__box__img">
                    <div class="c-img--cover">
                      <img src="">
                    </div>
                  </div>
                  <div class="c-contentList__box__info">
                    <div class="number l-flex">
                      <p class="other">
                        <span class="stage">第{{ lesson.number }}回</span>
                        <span class="date">{{ moment(lesson.date).format('M/D') }}({{ moment(lesson.date).format('ddd') }}) {{ moment(lesson.start).format('H:mm') }}-{{ moment(lesson.finish).format('H:mm') }}</span>
                      </p>
                      <p class="price">{{ lesson.separate_comma_price }}</p>
                    </div>
                    <p class="title">{{ lesson.title }}</p>
                    <p class="detail pc-only">{{ lesson.detail }}</p>
                    <div class="category">
                      <span v-if="lesson.category1_name">{{ lesson.category1_name }}</span>
                      <span v-if="lesson.category2_name">{{ lesson.category2_name }}</span>
                      <span v-if="lesson.category3_name">{{ lesson.category3_name }}</span>
                      <span v-if="lesson.category4_name">{{ lesson.category4_name }}</span>
                      <span v-if="lesson.category5_name">{{ lesson.category5_name }}</span>
                    </div>
                    <div class="teacher l-flex l-start l-v__center pc-only">
                      <div class="teacherImg">
                        <div class="teacherImgInner c-img--round c-img--cover">
                          <!-- <img src="{{ lesson.user_img }}"> -->
                        </div>
                      </div>
                      <div class="teacherEvaluation">
                        <img src="/img/common/icon-star.png">
                        <span class="evaluationNumber">{{ lesson.round_avg_point }}</span>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
            <!-- <div class="l-pagenation">
              <ul class="l-pagenation__list">
                <li class="selected"><a>１</a></li>
                <li v-for="i in 9"><a href=""></a></li>
              </ul>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import SidebarComponent from './../../components/common/sidebarComponent.vue'
  import moment from "moment";
  import 'moment/locale/ja';

  export default {
    components: {
      'sidebar-component': SidebarComponent,
    },
    // props:{
    //     lessons: Array,
    //     categories: Array
    // },
    // props: ['lessons', 'categories', 'paganations'],
    // props: ['lessons', 'categories', 'info'],

    props: {
      lessons: {
        type: Array,
        required: true
      },
      categories: {
        type: Array,
        required: true
      },
      info: {
        type: String,
        required: true
      },
    },
    // props: ['lessons', 'categories', 'info'],
    data() {
      return {
        moment: moment,
        sampleaaa: this.info,
      }
    },
    created: function() {
        // 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義
    },
    beforeUpdate() {
      console.log('beforeUpdate')
    },
    updated() {
      console.log('updated')
    },
  }
</script>

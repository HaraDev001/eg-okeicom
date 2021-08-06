<template>
  <div>
    <div class="c-button--tab top-tab two-tab">
      <div class="c-button--tab--inner u-w400_pc">
        <div
          :class="{'selected': isBarTab === '1'}"
          class="c-button--tab--box"
          @click.prevent="changeTab('1')"
        >
          受講予定
        </div>
        <div
          :class="{'selected': isBarTab === '2'}"
          class="c-button--tab--box"
          @click.prevent="changeTab('2')"
        >
          受講済み
        </div>
      </div>
    </div>
    <!-- tab：受講予定 -->
    <div
      v-if="isBarTab === '1'"
      class="l-contentList__list__wrap"
    >
      <div
        v-for="(lesson, index) in lessonlistsDate['data']"
        :key="index"
        class="c-contentList__box"
      >
        <a
          :href="`/lessons/detail/${lesson.id}`"
          class="c-contentList__box__inner"
        >
          <div class="c-contentList__box__img">
            <div class="c-img--cover">
              <img src="/img/common/screen-top.jpg">
            </div>
          </div>
          <div class="c-contentList__box__info">
            <div class="number l-flex">
              <p class="other">
                <span class="stage">第回</span>
                <span class="date">{{ moment(lesson.date).format('M/D') }}({{ moment(lesson.date).format('ddd') }}) {{ moment(lesson.start).format('H:mm') }}-{{ moment(lesson.finish).format('H:mm') }}</span>
              </p>
              <p class="price">¥{{ lesson.price.toLocaleString() }}</p>
            </div>
            <p class="title">{{ lesson['title'] }}</p>
            <p class="detail pc-only">{{ lesson['detail'] }}</p>
            <div class="category">
              <span v-if="lesson.category1_name">{{ lesson.category1_name }}</span>
              <span v-if="lesson.category2_name">{{ lesson.category2_name }}</span>
              <span v-if="lesson.category3_name">{{ lesson.category3_name }}</span>
              <span v-if="lesson.category4_name">{{ lesson.category4_name }}</span>
              <span v-if="lesson.category5_name">{{ lesson.category5_name }}</span>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
  <!-- tab：受講済み -->
  <!-- <div class="l-contentList__list__wrap" v-else-if="isBarTab === '2'">
    <div class="c-contentList__box" v-for="(lesson, index) in this.lessonLists" :key="lesson.id">
      <a class="c-contentList__box__inner" href="">
        <div class="c-contentList__box__img">
          <div class="c-img--cover">
            <img src="/img/common/screen-top.jpg">
          </div>
        </div>
        <div class="c-contentList__box__info">
          <div class="number l-flex">
            <p class="other">
              <span class="stage">第二回</span>
              <span class="date">2/12(金) 17:00-20:00</span>
            </p>
            <p class="price">￥3,000</p>
          </div>
          <p class="title">タイトルタイトルタイトルタイトルタイトルタイトル</p>
          <p class="detail pc-only">詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細</p>
          <div class="category">
            <span>書道</span>
            <span>バレエ</span>
          </div>
        </div>
      </a>
    </div>
  </div> -->
</template>
<script>
  import moment from "moment";
  import 'moment/locale/ja';

	export default {
    components: {
    },
    // props: ['appstatus', 'lessons'],

    props: {
      lessonlists: {
        type: Array,
        required: true
      },
      appstatus: {
        type: String,
        required: true,
      },
    },
    // props: ['appstatus', 'lessonlists'],
		data() {
			return {
        isBarTab: '1',
        moment: moment,
        // status: this.appstatuss,
        lessonlistsDate: this.lessonlists,
        statusDate: this.appstatus,
			}
		},
    mounted: function() {
      console.log(this.lessonlistsDate)
    },
		methods: {
			// 講師詳細：
			changeTab: function(num){
				this.isBarTab = num
			},
		},
	}
</script>

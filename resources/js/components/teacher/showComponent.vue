<template>
  <div>
    <div class="l-wrap--title profile">
      <div class="l-wrap">
        <div class="teacherDetail-profile">
          <div class="teacherDetail-profile-detail">
            <div class="c-img--shadow">
              <div
                v-if="user.img!=null"
                class="c-img--cover c-img--round"
              >
                <img :src="'/storage/profile/' + user.img">
              </div>
            </div>
            <p class="u-text--big u-mb10">
              {{ user.name }}
            </p>
            <div class="c-text--evaluation u-mb5">
              <div class="star">
                <img src="/img/common/icon-star.png">
                <span class="evaluation">{{ Math.floor(user.evaluations_avg_point) }}</span>
              </div>
              <p class="review">
                レビュー {{ evalutions.length ? evalutions.length : 0 }}件
              </p>
            </div>
            <ul class="c-text--category u-mb5">
              <li v-if="user.cat1!=null">{{ user.cat1 }}</li>
              <li v-if="user.cat2!=null">{{ user.cat2 }}</li>
              <li v-if="user.cat3!=null">{{ user.cat3 }}</li>
              <li v-if="user.cat4!=null">{{ user.cat4 }}</li>
              <li v-if="user.cat5!=null">{{ user.cat5 }}</li>
            </ul>
            <div class="teacherDetail-profile-detail-tab u-mb10">
              <div class="tabBox">
                <span>国籍</span>{{ user.country_id ? user.country_id : '未設定' }}
              </div>
              <div class="tabBox">
                <span>言語</span>{{ user.language_id ? user.language_id : '未設定'}}
              </div>
              <div class="tabBox">
                <span>都道府県</span>{{ user.pref ? user.pref : '未設定' }}
              </div>
            </div>
            <a
              :href="message"
              class="c-button--square__pink"
            >
              メッセージを送る
            </a>
          </div>
          <div class="teacherDetail-profile-text">
            <p class="u-text--sentence">
              {{ user.profile }}
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="l-wrap--body">
      <div class="l-wrap l-flex">
        <div
          id="sidebar"
          class="sidebar__tab"
        >
          <div class="headline pc-only">
            <p>メニュー</p>
          </div>
          <ul class="sidebar__list">
            <li :class="{'selected': isBarTab === '1'}">
              <a @click.prevent="changeTab('1')">レッスン一覧</a>
            </li>
            <li :class="{'selected': isBarTab === '2'}">
              <a @click.prevent="changeTab('2')">口コミ</a>
            </li>
          </ul>
        </div>
        <div class="l-wrap--main">
          <!-- tab：レッスン一覧 -->
          <div
            v-if="isBarTab === '1'"
            class="l-contentList__list__wrap"
          >
            <div
              v-for="(lesson, index) in lessons"
              :key="index"
              class="c-contentList__box"
            >
              <a
                class="c-contentList__box__inner"
                :href="`/lessons/detail/${lesson.id}`"
              >
                <div class="c-contentList__box__img">

                  <div
                    v-if="lesson.courses_img1!=null"
                    class="c-img--cover c-img--round"
                  >
                    <img :src="'/storage/courses/' + lesson.courses_img1">
                  </div>
                </div>
                <div class="c-contentList__box__info">
                  <div class="number l-flex">
                    <p class="other">
                      <span class="stage">第{{ lesson.rowNumber }}回</span>
                      <span class="date">{{ lesson.formated_md_date }} {{ lesson.separate_hyphen_time }}</span>
                    </p>
                    <p class="price">￥{{ lesson.price }}</p>
                  </div>
                  <p class="title">{{ lesson.title }}</p>
                  <p class="detail pc-only">{{ lesson.detail }}</p>
                  <div class="category">
                    <span v-if="lesson.category1_name != null">{{ lesson.category1_name }}</span>
                    <span v-if="lesson.category2_name != null">{{ lesson.category2_name }}</span>
                    <span v-if="lesson.category3_name != null">{{ lesson.category3_name }}</span>
                    <span v-if="lesson.category4_name != null">{{ lesson.category4_name }}</span>
                    <span v-if="lesson.category5_name != null">{{ lesson.category5_name }}</span>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <!-- tab：口コミ -->
          <div
            v-else-if="isBarTab === '2'"
            class="l-list--review"
          >
            <div
              v-for="(evalution, index) in evalutions"
              :key="index"
              class="l-content--review"
            >
              <div class="l-content--review--detail l-flex l-start">
                <div class="l-content--review--img u-mr20_pc u-mr10_sp">
                  <div class="c-img--shadow">
                    <div
                      v-if="evalution.user_img!=null"
                      class="c-img--cover c-img--round"
                    >
                      <img :src="'/storage/profile/' + evalution.user_img">
                    </div>
                  </div>
                </div>
                <div class="l-content--review--text">
                  <p class="u-mb5">
                    {{ evalution.user_name }}
                  </p>
                  <div class="c-text--evaluation">
                    <div class="star u-mr10">
                      <img src="/img/common/icon-star.png">
                      <span class="evaluation">{{ evalution.point }}</span>
                    </div>
                    <span class="u-color--gray u-text--small">{{ evalution.date }}</span>
                  </div>
                  <div class="c-text--attention bg-gray u-mt15">
                    <p>{{ evalution.comment }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    // import SidebarComponent from './../../components/common/sidebarComponent.vue'

	export default {
    // components: {
    //   'sidebar-component': SidebarComponent,
    // },
		props: {
      user: {
        type: Array,
        required: true
      },
      lessons: {
        type: Array,
        required: true
      },
      evalutions: {
        type: Array,
        required: true
      },
    },
		data() {
			return {
        isBarTab: '1',
        message: '',
			}
		},
		created: function() {
      // 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義

      // メッセージ詳細ページへのリンク生成
      var messageUrl = '';
      // var talkUser = this.user.id;
      if(this.user.status === 0) {
        messageUrl = '/mypage/u/messages/';
      } else if(this.user.status === 1) {
        messageUrl = '/mypage/t/messages/';
      }
      this.message = messageUrl + this.user.id
    },
		methods: {
			// 講師詳細のタブ切り替え
			changeTab: function(num){
				this.isBarTab = num
			},
		},
	}
</script>

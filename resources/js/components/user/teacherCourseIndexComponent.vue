<template>
  <div class="l-wrap--main--inner">

    <div class="c-button--tab top-tab two-tab">
      <div class="c-button--tab--inner u-w400_pc">
        <div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '1'}" @click.prevent="changeTab('1')">公開中</div>
        <div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '2'}" @click.prevent="changeTab('2')">削除済み</div>
      </div>
    </div>
    <!-- tab：受講予定 -->
    <div class="l-contentList__list__wrap" v-if="isBarTab === '1'">
      <div class="c-contentList__box" v-for="i in 10">
        <a class="c-contentList__box__inner" href="">
          <div class="c-contentList__box__img">
            <div class="c-img--cover">
              <img src="/img/common/screen-top.jpg">
            </div>
          </div>
          <div class="c-contentList__box__info">
            <div class="number l-flex">
              <p class="other">
                <span class="stage">全三回</span>
              </p>
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
    </div>
    <!-- tab：受講済み -->
    <div
      v-else-if="isBarTab === '2'"
      class="l-contentList__list__wrap"
    >
      <div
        v-for="(i, index) in 10"
        :key="index"
        class="c-contentList__box"
      >
        <a
          class="c-contentList__box__inner"
          href=""
        >
          <div class="c-contentList__box__img">
            <div class="c-img--cover">
              <img src="/img/common/screen-top.jpg">
            </div>
          </div>
          <div class="c-contentList__box__info">
            <div class="number l-flex">
              <p class="other">
                <span class="stage">全二回</span>
              </p>
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
    </div>
  </div>
</template>
<script>
	export default {
        components: {
        },
		data() {
			return {
				isBarTab: '1',
			}
		},
		created: function() {
			// 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義

		},
		methods: {
			// 講師詳細：
			changeTab: function(num){
				this.isBarTab = num
			},
		},
	}
</script>

<template>
  <div>
    <div
      class="l-modal"
      :class="{open: isParticipantDetail}"
      @click.self="openDetail"
    >
      <div class="l-modal--wrap">
        <div class="close-button">
          <span
            class="close-icon"
            @click.prevent="openDetail"
          >
            <img src="/img/common/icon-batsu-white.png">
          </span>
        </div>
        <div
          v-if="currentUser"
          class="l-modal--wrap--inner"
        >
          <div class="l-modal--content">
            <div class="l-modal--header">
              <div class="l-modal--header--img">
                <div class="c-img--cover c-img--round">
                  <img :src="'/storage/profile/' + currentUser.img">
                </div>
              </div>
              <div class="l-modal--header--button">
                <ul>
                  <li class="message">
                    <a :href="`/mypage/t/messages/${ currentUser.user_id }`">メッセージを送る</a>
                  </li>
                  <li class="reject">
                    <a @click="remove()">参加を拒否する</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="l-modal--content">
            <div class="l-modal--name">
              <p class="sub">
                アカウント名
              </p>
              <p class="main">
                {{ currentUser.name }}
              </p>
            </div>
          </div>
          <div class="l-modal--detail">
            <div class="l-modal--detail--box l-modal--content">
              <p class="sub">
                性別
              </p>
              <p class="main">
                <span v-if="currentUser.sex == 0">不明</span>
                <span v-eif="currentUser.sex == 1">男性</span>
                <span v-if="currentUser.sex == 2">女性</span>
              </p>
            </div>
            <!-- <div class="l-modal--detail--box l-modal--content">
                <p class="sub">年齢</p>
                <p class="main">{{ currentUser.age }}歳</p>
            </div> -->
            <div class="l-modal--detail--box l-modal--content">
              <p class="sub">
                都道府県
              </p>
              <p class="main">
                {{ currentUser.pref }}
              </p>
            </div>
          </div>
          <div class="l-modal--content border-none">
            <div class="l-modal--profile">
              <p class="sub">
                プロフィール
              </p>
              <p class="main">
                {{ currentUser.profile }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="l-wrap--main--inner">
      <div class="c-button--tab top-tab two-tab">
        <div class="c-button--tab--inner u-w400_pc">
          <div
            class="c-button--tab--box"
            :class="{'selected': isBarTab === 1}"
            @click.prevent="changeTab(1)"
          >
            レッスン詳細
          </div>
          <div
            class="c-button--tab--box"
            :class="{'selected': isBarTab === 2}"
            @click.prevent="changeTab(2)"
          >
            参加者一覧
          </div>
        </div>
      </div>
      <!-- tab：レッスン詳細 -->
      <!-- <div class="c-list--table" v-if="isBarTab === '1'"> -->
      <div
        v-if="isBarTab === 1"
        class="c-list--table"
      >
        <div class="c-list--tr">
          <div class="c-list--th">
            <p class="main">
              タイトル
            </p>
          </div>
          <div class="c-list--td">
            <input
              v-model="lessonTitle"
              type="text"
              name="title"
              placeholder="タイトルを入力してください"
            >
          </div>
        </div>
        <!-- case：放送タイプが動画埋め込みの場合 -->
        <div
          v-if="lesson.type !== 2"
          class="c-list--tr"
        >
          <div class="c-list--th">
            <p class="main">
              URL
            </p>
          </div>
          <div class="c-list--td">
            <input
              v-model="lessonUrl"
              type="text"
              name="url"
              placeholder="https://www.youtube.com/"
            >
          </div>
        </div>
        <!-- case：放送タイプがスライドの場合 -->
        <div
          v-else-if="lesson.type === 2"
          class="c-list--tr"
        >
          <div class="c-list--th">
            <p class="main">
              スライドファイル（powerpoint）
            </p>
          </div>
          <div class="c-list--td">
            <input
              type="file"
              name="slide"
              placeholder="スライドファイル"
              accept="application/vnd.openxmlformats-officedocument.presentationml.presentation,.pptx,application/vnd.ms-powerpoint,.ppt"
              @change="onImageUploaded"
            >
          </div>
        </div>
        <div class="c-list--tr">
          <div class="c-list--th">
            <p class="main">
              開催日時
            </p>
          </div>
          <div class="c-list--td">
            <div class="l-flex">
              <div class="l-content--input__three u-w100per_sp u-mb21_sp">
                <div class="l-content--input__headline">
                  開始日
                </div>
                <vue-datepicker
                  v-model="lessonDate"
                  name="date"
                  type="date"
                  :format="customFormatter"
                  :language="ja"
                  :disabled-dates="disabledDates"
                  @closed="pickerClosed"
                />
              </div>
              <div class="l-content--input__three u-w49per_sp">
                <div class="l-content--input__headline">
                  開始時間
                </div>
                <vue-timepicker
                  v-model="lessonStart"
                  name="start"
                  format="HH:mm"
                  hour-label="時間"
                  minute-label="分"
                  :minute-interval="5"
                  :highlighted="highlighted"
                />
              </div>
              <div class="l-content--input__three u-w49per_sp">
                <div class="l-content--input__headline">
                  終了時間
                </div>
                <vue-timepicker
                  v-model="lessonFinish"
                  name="finish"
                  format="HH:mm"
                  hour-label="時間"
                  minute-label="分"
                  :minute-interval="5"
                />
                <!-- <vue-timepicker
                    name="finish"
                    hour-label="時間"
                    minute-label="分"
                    :value="lessonFinish"
                    @input="val => lessonFinish = val"
                    :minute-interval="5"
                >
                </vue-timepicker> -->
              </div>
              <!-- <div class="l-content--input__two">
                  <div class="l-content--input__headline">開始時間</div>
                  <vue-timepicker
                      hour-label="時間"
                      minute-label="分"
                      :value="lessonStart"
                      @input="val => lessonStart = val"
                      :minute-interval="5"
                  ></vue-timepicker>

              </div>
              <div class="l-content--input__two">
                  <div class="l-content--input__headline">終了時間</div>

                  <vue-timepicker
                      hour-label="時間"
                      minute-label="分"
                      :value="lessonFinish"
                      @input="val => lessonFinish = val"
                      :minute-interval="5"
                  >
                  </vue-timepicker>
              </div> -->
            </div>
          </div>
        </div>
        <div class="c-list--tr">
          <div class="c-list--th">
            <p class="main">
              詳細
            </p>
          </div>
          <div class="c-list--td">
            <textarea
              v-model="lessonDetail"
              name="detail"
            />
          </div>
        </div>
        <div class="c-list--tr">
          <div class="c-list--th">
            <p class="main">
              金額
            </p>
          </div>
          <div class="c-list--td">
            <div class="accesary-yen l-content--input__three">
              <input
                v-model="lessonPrice"
                type="text"
                name="price"
                placeholder="半角数字を入力してください"
                @input="priceValidate"
              >
            </div>
            <!-- <input type="" name="" placeholder="半角数字を入力してください"> -->
          </div>
        </div>
        <div class="c-list--tr">
          <div class="c-list--th">
            <p class="main">
              キャンセル手数料
            </p>
          </div>
          <div class="c-list--td">
            <div class="c-selectBox u-w100">
              <!-- <select>
                <option v-for="item in 100">{{item}}%</option>
              </select> -->
              <select
                v-model="lessonCancelRate"
                name="cancel_rate"
              >
                <option
                  v-for="(rate, index) in 100"
                  :key="rate.id"
                >
                  {{ index }}
                </option>
              </select>
            </div>
          </div>
        </div>
        <div class="l-button--submit">
          <button
            type="submit"
            class="c-button--square__pink"
          >
            変更内容を保存する
          </button>
          <!-- <input type="subit" name="" value="変更内容を保存する" class="c-button--square__pink"> -->
        </div>
      </div>
      <!-- tab：参加者一覧 -->
      <div
        v-if="isBarTab === 2"
        class="l-contentList__list__wrap"
      >
        <div
          v-for="(application, index) in applications"
          :key="index"
          class="c-list--courseLesson"
        >
          <div class="c-list--courseLesson--num">
            <div class="c-img--round c-img--cover">
              <img :src="'/storage/profile/' + application.img">
            </div>
          </div>
          <div class="c-list--courseLesson--title u-pl10">
            <p class="title u-text--big u-mb5">{{ application.name }}</p>
            <p class="date u-color--grayNavy u-text--small">
              {{ datetotime(application.created_at) }}
            </p>
          </div>
          <!-- 開催日を超えた現場は削除 -->
          <div class="c-button--edit">
            <a
              class="c-button--edit--link edit"
              @click.prevent="openDetail(application)"
            >
              詳細
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import axios from 'axios'
  import moment from "moment"
  import 'moment/locale/ja'
  import VueDatepicker from 'vuejs-datepicker'
  import VueTimepicker from 'vue2-timepicker'
  import 'vue2-timepicker/dist/VueTimepicker.css'
  import {ja} from 'vuejs-datepicker/dist/locale'
  // import VueTimepicker from './../../components/common/Vue2TimepickerComponent.vue'
  // import VuejsDatepickerComponent from "./../../components/common/VuejsDatepickerComponent.vue"

  export default {
    components: {
      'vue-datepicker': VueDatepicker,
      'vue-timepicker': VueTimepicker,
    },
    props: {
      lesson: {
        type: Object,
        required: true
      },
      applications: {
        type: Array,
        required: true
      },
      param: {
        type: Number,
        required: true
      }
    },
		data() {
			return {
        // Datepickerを日本語化する
        ja:ja,
        // レッスンの日付を今日以降にする
        disabledDates: {
          to: new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate())
        },
        // ハイライトを付与する
        highlighted: {
          to: new Date
        },
        // isBarTab: '1',
        isBarTab: this.param,
        // 参加者詳細モーダル
        isParticipantDetail: false,
        currentUser: null,
        checkLesson: true,
        // レッスン情報を代入
        lessonTitle      : this.lesson.title ?? '',
        lessonUrl        : this.lesson.url ?? '',
        lessonDetail     : this.lesson.detail ?? '',
        lessonDate       : this.lesson.date ?? '',
        lessonStart      : moment(this.lesson.start).format() ?? '',
        lessonFinish     : moment(this.lesson.finish).format() ?? '',
        lessonPrice      : this.lesson.price ?? '',
        lessonCancelRate : this.lesson.cancel_rate ?? '',
      }
		},
		created: function() {
      // [レッスン追加]ボタンのバリデーションチェック
      this.$watch(
        () => [this.$data.lessonTitle, this.$data.lessonDate, this.$data.lessonStart, this.$data.lessonFinish, this.$data.lessonPrice, this.$data.lessonCancelRate],
        // (type, date, start, finish, price, cancel, title) => {
        () => {
          if(!this.lessonTitle == '' && !this.lessonDate == '' && !this.lessonStart == '' && !this.lessonFinish == '' && !this.lessonPrice == '' && !this.lessonCancelRate == '') {
            this.checkLesson = false;
          } else {
            this.checkLesson = true;
          }
        }
      )
    },
		methods: {
      // 開始日のフォーマット
      customFormatter: function(date) {
        return moment(date).format('YYYY/MM/DD')
      },
      pickerClosed: function() {
        if(this.lessonDate){
          this.lessonDate = moment(this.lessonDate).format('YYYY/MM/DD');
        }
      },
      changeTab(tab) {
        this.isBarTab = tab
      },
      // 参加者詳細モーダル
			openDetail: function(currentUser) {
        this.isParticipantDetail =! this.isParticipantDetail
        this.currentUser = currentUser
			},
      remove() {
        axios.post('/mypage/t/block-application', {userId: this.currentUser.id, lessonId: this.lesson.id})
          .then(result => {
            console.log(result);
            location.reload();
          })
          .catch(result => {
            console.log(result);
          })
      },
      // レッスンスライドを追加する
      onImageUploaded(e) {
        // event(=e)から画像データを取得する
        const image = e.target.files[0]
        this.createImage(image)
      },
      // 金額：半角数字のみのバリデーション
      priceValidate: function() {
        this.lessonPrice = this.lessonPrice.replace(/\D/g, '')
      },
    },
	}
</script>

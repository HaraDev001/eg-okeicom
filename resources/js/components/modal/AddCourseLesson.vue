<template>
  <!-- <form
    method="post"
    action="/mypage/t/courses/lesson/create"
    enctype="multipart/form-data"
  > -->
  <form
    method="post"
    :action="postURL"
    enctype="multipart/form-data"
  >
    <input
      type="hidden"
      name="_token"
      :value="csrf"
    >
    <input
      type="hidden"
      name="courses_id"
      :value="course.id"
    >
    <div class="c-button--add c-list--courseLesson">
      <a @click="showModal">
        レッスンを追加
      </a>
    </div>
    <div
      v-show="isLessonModal"
      ref="lesson_add_modal"
      class="lesson-add-modal"
      @click.self="closeModal"
    >
      <div class="lesson-add-modal-inner">
        <div class="l-content--detail">
          <div class="l-content--detail__inner">
            <div class="l-wrap--title">
              <h1 class="c-headline--screen">
                レッスンを追加する
              </h1>
              <button
                type="button"
                class="close-modal"
                @click="closeModal"
              >
                <img src="/img/common/icon-batsu-white.png">
              </button>
            </div>
            <div class="l-content--input">
              <p class="l-content--input__headline">
                タイトル
              </p>
              <input
                v-model="lesson.title"
                type="text"
                name="title"
                placeholder="タイトルを入力してください"
              >
            </div>
            <div class="l-content--input">
              <p class="l-content--input__headline">
                公開タイプ
              </p>
              <ul class="u-pl10">
                <li class="u-mb15">
                  <div class="c-checkbox--fashonable">
                    <label>公開
                      <input
                        v-model="lesson.public"
                        type="radio"
                        name="public"
                        value="0"
                        :checked="true"
                      >
                      <div class="color-box" />
                    </label>
                  </div>
                </li>
                <li class="u-mb15">
                  <div class="c-checkbox--fashonable">
                    <label>非公開
                      <input
                        v-model="lesson.public"
                        type="radio"
                        name="public"
                        value="1"
                      >
                      <div class="color-box" />
                    </label>
                  </div>
                </li>
              </ul>
            </div>
            <div class="l-content--input">
              <p class="l-content--input__headline">
                放送タイプ
              </p>
              <ul class="u-pl10">
                <li class="u-mb15">
                  <div class="c-checkbox--fashonable">
                    <label>生放送
                      <input
                        v-model="lesson.type"
                        type="radio"
                        name="type"
                        value="0"
                        :checked="true"
                        @change.prevent="changeBroadcastType(1)"
                      >
                      <div class="color-box" />
                    </label>
                  </div>
                </li>
                <li class="u-mb15">
                  <div class="c-checkbox--fashonable">
                    <label>動画埋め込み
                      <input
                        v-model="lesson.type"
                        type="radio"
                        name="url"
                        value="1"
                        @change.prevent="changeBroadcastType(2)"
                      >
                      <div class="color-box" />
                    </label>
                  </div>
                </li>
                <li>
                  <div class="c-checkbox--fashonable">
                    <label>スライド
                      <input
                        v-model="lesson.type"
                        type="radio"
                        name="type"
                        value="2"
                        @change.prevent="changeBroadcastType(3)"
                      >
                      <div class="color-box" />
                    </label>
                  </div>
                </li>
              </ul>
            </div>
            <div
              v-if="isBroadcastType != 3"
              class="l-content--input"
            >
              <p class="l-content--input__headline">
                動画もしくはZOOM URL
              </p>
              <input
                v-model="lesson.url"
                type="text"
                name="url"
                placeholder="https://www.youtube.com/"
              >
            </div>
            <div
              v-if="isBroadcastType === 3"
              class="l-content--input"
            >
              <p class="l-content--input__headline">
                スライドファイル（powerpoint）
              </p>
              <input
                type="file"
                name="slide"
                placeholder="スライドファイル"
                accept="application/vnd.openxmlformats-officedocument.presentationml.presentation,.pptx,application/vnd.ms-powerpoint,.ppt,.pot"
                @change="onImageUploaded"
              >
            </div>
            <!-- <div class="l-content--input">
                      <p class="l-content--input__headline">開催日時</p>
                      <vuejs-datepicker-component name="select_date" value=""></vuejs-datepicker-component>
                  </div> -->
            <div class="l-content--input">
              <div class="l-flex">
                <div class="l-content--input__three u-w100per_sp u-mb21_sp">
                  <div class="l-content--input__headline">
                    開始日
                  </div>
                  <vue-datepicker
                    v-model="lesson.date"
                    type="date"
                    name="date"
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
                    v-model="lesson.start"
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
                    v-model="lesson.finish"
                    name="finish"
                    format="HH:mm"
                    hour-label="時間"
                    minute-label="分"
                    :minute-interval="5"
                  />
                </div>
              </div>
            </div>
            <div class="l-content--input">
              <p class="l-content--input__headline">
                詳細
              </p>
              <textarea
                v-model="lesson.detail"
                name="detail"
              />
            </div>
            <div class="l-content--input">
              <div class="l-content--input__three">
                <p class="l-content--input__headline">
                  金額
                  <span class="u-text--small u-color--grayNavy">
                    （半角数字のみ）
                  </span>
                </p>
                <div class="accesary-yen">
                  <input
                    v-model="lesson.price"
                    type="text"
                    name="price"
                    placeholder="半角数字を入力してください"
                    @input="priceValidate"
                  >
                </div>
              </div>
            </div>
            <div class="l-content--input">
              <div class="l-content--input__three">
                <p class="l-content--input__headline">
                  キャンセル手数料
                </p>
                <div class="accesary-percent">
                  <select
                    v-model="lesson.cancel_rate"
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
              <!-- <button v-if="!changeModalEdit" type="button" @click="addLesson" class="c-button--square__pink" :disabled="checkLesson">レッスンを追加する</button> -->
              <button
                v-if="!changeModalEdit"
                type="submit"
                class="c-button--square__pink"
                :disabled="checkLessonSubmit"
                @click="addLesson"
              >
                レッスンを追加する
              </button>
              <button
                v-else-if="changeModalEdit"
                type="submit"
                class="c-button--square__pink"
                :disabled="checkLessonSubmit"
                @click="updateLesson"
              >
                編集内容を保存する
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>
<script>
  import moment from "moment"
  import 'moment/locale/ja'
  import VueDatepicker from 'vuejs-datepicker'
  import VueTimepicker from 'vue2-timepicker'
  import 'vue2-timepicker/dist/VueTimepicker.css'
  import {ja} from 'vuejs-datepicker/dist/locale'

  export default {
    components: {
      'vue-datepicker': VueDatepicker,
      'vue-timepicker': VueTimepicker,
    },
    props: {
      course: {
        type: Object,
        required: true
      },
      csrf: {
        type: String,
        required: true
      },
    },
    emits: [
      'catch-lessons'
    ],
    data() {
      return {
        ja:ja,
        // レッスンモーダル
        isLessonModal: false,
        changeModalEdit: false,
        // ブロードキャストナンバー
        isBroadcastType: 1,
        // 編集時にどのlessonsを変更するか定義する処理
        changeNumber: '',
        // レッスンの日付を今日以降にする
        disabledDates: {
          to: new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate())
        },
        highlighted: {
          to: new Date
        },
        // レッスンの配列
        lessons: [],
        // モーダルの初期設定
        lesson: {
          title: '',
          public: 0,
          type: 0,
          url: '',
          slide: '',
          date : moment(new Date).format('YYYY/MM/DD'),
          start: '12:00',
          finish: '12:00',
          detail: '',
          price: 100,
          cancel_rate: 20,
        },
        postURL: '',
      }
    },
    computed: {
      // レッスン追加のバリデーションチェック
      checkLessonSubmit: function() {
        if(this.lesson.title == '') {
          return true
        } else {
          return false
        }
      }
    },
    methods: {
      // 開始日のフォーマット
      customFormatter: function(date) {
        return moment(date).format('YYYY/MM/DD')
      },
      // Datapickerを閉じる処理
      pickerClosed: function() {
        if(this.lesson.date){
          this.lesson.date = moment(this.lesson.date).format('YYYY/MM/DD');
        }
      },
      // モーダル：表示
      showModal: function() {
        this.isLessonModal = true;
      },
      // モーダル：非表示
      closeModal: function() {
        // モーダルを閉じる
        this.isLessonModal = false;
        this.$refs.lesson_add_modal.scrollTop = 0;

        // 編集モードをオフにする
        this.changeModalEdit = false

        // レッスンを初期化
        this.changeNumber = ''
        this.lesson = []
        this.lesson = {
          public: 0,
          type: 0,
          date: moment(new Date).format('YYYY/MM/DD'),
          start: '12:00',
          finish: '12:00',
          // start: {
          //   HH: '12',
          //   mm: '00'
          // },
          // finish: {
          //   HH: '12',
          //   mm: '00'
          // },
          price: 100,
          cancel_rate: 20,
        }
      },
      // レッスン：追加する
      addLesson: function() {
        // 連想配列を追加する
        // this.lessons.push(this.lesson)

        // モーダルのトップに移動させる
        // this.$refs.lesson_add_modal.scrollTop = 0

        // モーダルを閉じる
        // this.isLessonModal = false

        // // lessons連想配列の中身を日付順に並び替える
        // this.lessons.sort((a, b) => {
        //   // dateの昇順
        //   if(a.date > b.date) return 1;
        //   if(a.date < b.date) return -1;
        //   // startの降順
        //   if(a.start > b.start) return -1;
        //   if(a.start < b.start) return 1;
        //   // finishの降順
        //   if(a.finish > b.finish) return 1;
        //   if(a.finish < b.finish) return -1;
        //   return 0;
        // });

        // // レッスンを初期化
        // this.lesson = [],
        // this.lesson = {
        //   public: 0,
        //   type: 0,
        //   date: moment(new Date).format('YYYY/MM/DD'),
        //   start: '12:00',
        //   finish: '12:00',
        //   // start: {
        //   //   HH: '12',
        //   //   mm: '00'
        //   // },
        //   // finish: {
        //   //   HH: '12',
        //   //   mm: '00'
        //   // },
        //   price: 100,
        //   cancel_rate: 20,
        // }

        // formにsubmit
        this.postURL = "/mypage/t/courses/lesson/create";
      },
      // レッスン：編集する
      editLesson: function(index) {
        // 編集モードにする
        this.changeModalEdit = true
        // モーダルを表示する
        this.isLessonModal = true
        // 登録済みの値を入れる
        this.lesson = {
          title: this.lessons[index].title,
          public: this.lessons[index].public,
          type: this.lessons[index].type,
          url: this.lessons[index].url,
          slide: this.lessons[index].slide,
          date : moment(this.lessons[index].date).format('YYYY/MM/DD'),
          start: '12:00',
          finish: '12:00',
          // start: {
          //   HH: this.lessons[index].start['HH'],
          //   mm: this.lessons[index].start['mm']
          // },
          // finish: {
          //   HH: this.lessons[index].start['HH'],
          //   mm: this.lessons[index].start['mm']
          // },
          detail: this.lessons[index].detail,
          price: this.lessons[index].price,
          cancel_rate: this.lessons[index].cancel_rate,
        }
        // 変更するlessonsを定義する
        this.changeNumber = index

        // formにsubmit
        this.postURL = "/mypage/t/courses/lesson/update";
      },
      // レッスン：更新する
      updateLesson: function() {
        // 編集モードをオフにする
        // this.changeModalEdit = false
        // モーダルを表示する
        // this.isLessonModal = false

        // レッスンを更新する
        // this.lessons[this.changeNumber] = {
        //   title: this.lesson.title,
        //   public: this.lesson.public,
        //   type: this.lesson.type,
        //   url: this.lesson.url,
        //   slide: this.lesson.slide,
        //   date : moment(this.lesson.date).format('YYYY/MM/DD'),
        //   start: '12:00',
        //   finish: '12:00',
        //   // start: {
        //   //   HH: this.lesson.start['HH'],
        //   //   mm: this.lesson.start['mm']
        //   // },
        //   // finish: {
        //   //   HH: this.lesson.start['HH'],
        //   //   mm: this.lesson.start['mm']
        //   // },
        //   detail: this.lesson.detail,
        //   price: this.lesson.price,
        //   cancel_rate: this.lesson.cancel_rate,
        // }

        // lessons連想配列の中身を日付順に並び替える
        // this.lessons.sort((a, b) => {
        //   // dateの昇順
        //   if(a.date > b.date) return 1;
        //   if(a.date < b.date) return -1;
        //   // startの降順
        //   if(a.start > b.start) return 1;
        //   if(a.start < b.start) return -1;
        //   // finishの降順
        //   if(a.finish > b.finish) return 1;
        //   if(a.finish < b.finish) return -1;
        //   return 0;
        // });

        // レッスンを初期化
        // this.changeNumber = ''
        // this.lesson = []
        // this.lesson = {
        //   date: moment(new Date).format('YYYY/MM/DD'),
        //   start: '12:00',
        //   finish: '12:00',
        //   // start: {
        //   //   HH: '12',
        //   //   mm: '00'
        //   // },
        //   // finish: {
        //   //   HH: '12',
        //   //   mm: '00'
        //   // },
        //   price: 100,
        //   cancel_rate: 20,
        // }

        // formにsubmit
        this.postUrl = "/mypage/t/courses/lesson/update";
      },
      // レッスン：削除する
      deleteLesson: function(index) {
        this.lessons.splice(index, 1);

        // 親に値を送る
        this.$emit('catch-lessons', this.lessons)
      },
      // レッスンスライドを追加する
      onImageUploaded(e) {
        // event(=e)から画像データを取得する
        const image = e.target.files[0]
        this.createImage(image)
      },
      createImage(image) {
        const reader = new FileReader()
        // imageをreaderにDataURLとしてattachする
        reader.readAsDataURL(image)
        // readAdDataURLが完了したあと実行される処理
        reader.onload = () => {
          this.lesson.slide = reader.result
        }
      },
      changeBroadcastType: function(type) {
        this.isBroadcastType = type
        this.lesson.url = ''
        this.lesson.slide = ''
      },
      // 金額：半角数字のみのバリデーション
      priceValidate: function() {
        this.lesson.price = this.lesson.price.replace(/\D/g, '')
      },
    }
  }
</script>

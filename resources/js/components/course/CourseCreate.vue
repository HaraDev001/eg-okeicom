<template>
  <form
    method="POST"
    action="/mypage/t/courses/store"
    enctype="multipart/form-data"
    @submit="checkForm"
  >
    <input
      type="hidden"
      name="_token"
      :value="csrf"
    >
    <div
      v-if="errors.length"
      class="flash_message"
    >
      <ul>
        <li
          v-for="(error, index) in errors"
          :key="index"
        >
          {{ error }}
        </li>
      </ul>
    </div>
    <div class="l-wrap--title">
      <a
        href="/mypage/t/courses"
        class="c-link--back u-mb5"
      >
        コース一覧へ戻る
      </a>
      <h1 class="c-headline--screen">
        コースを作成する
      </h1>
    </div>
    <div class="l-wrap--body">
      <div class="l-wrap--main l-wrap--detail">
        <div class="l-content--detail">
          <div class="c-headline--block">
            詳細
          </div>
          <div class="l-content--detail__inner">
            <div class="l-content--input">
              <p class="l-content--input__headline">
                タイトル
              </p>
              <!-- <input
                id="title"
                v-model="course.title"
                name="title"
                class="form-control"
                type="text"
                placeholder="タイトルを入力してください"
                @keyup="validationCheck"
              > -->
              <input
                id="title"
                v-model="course.title"
                name="title"
                class="form-control"
                type="text"
                placeholder="タイトルを入力してください"
              >
            </div>
            <div class="l-content--input">
              <p class="l-content--input__headline">
                コース詳細
              </p>
              <textarea
                id="detail"
                v-model="course.detail"
                class="form-control"
                name="detail"
              />
            </div>
          </div>
        </div>
        <div class="l-content--detail">
          <div class="c-headline--block">
            画像を選択
          </div>
          <div class="l-content--detail__inner">
            <select-image
              :old="old"
              @add="addImage"
              @remove="removeImage"
            />
          </div>
        </div>
        <div class="l-content--detail">
          <div class="c-headline--block">
            カテゴリーを選択
          </div>
          <div class="l-content--detail__inner">
            <!-- <select-category
              :categories-list="categoriesList"
              :categories="old.categories"
              @addCategory="addCheckbox"
              @reduceCategory="reduceCheckbox"
            /> -->
            <select-category
              :category-list="categoryList"
              @addCategory="addCheckbox"
              @reduceCategory="reduceCheckbox"
            />
          </div>
        </div>
      </div>
    </div>
    <div class="l-button--submit">
      <button
        class="c-button--square__pink"
        type="submit"
        :disabled="checkSubmit"
      >
        コースを登録する
      </button>
    </div>
  </form>
</template>
<script>
  // ajax通信
  import SelectCategory from './../store/SelectListCategoryComponent.vue'
  import SelectImage from './../store/SelectListImageComponent.vue'

  export default {
    components: {
      'select-category': SelectCategory, // カテゴリー選択のコンポーネント
      'select-image': SelectImage, // 画像選択のコンポーネント
    },
    props: {
      categoryList: {
        type: Array,
        required: true
      },
      old: {
        type: Array,
        required: true
      },
      csrf: {
        type: String,
        required: true,
      },
    },
    data() {
      return {
        errors: [],
        // コース
        course : {
          title   : this.old.title ?? '', // タイトル
          detail  : this.old.detail ?? '', // 詳細
          category: this.old.category ?? 0 // カテゴリー
        },
        validationNumber: 0,
      }
    },
    computed: {
      checkSubmit: function() {
        if(this.course.title == '' || this.course.category == 0 || this.validationNumber == 0) {
          return true
        } else {
          return false
        }
      },
    },
    created: function() {
      // コースを登録するボタンのバリデーションチェック
      this.$watch(
        () => [
          this.$data.course.title,
          this.$data.course.category,
          this.validationNumber
        ],
        // valueやoldValueの型は上で返した配列になる
        () => {
          if(this.course.title == '' || this.course.category == 0 || this.validationNumber == 0) {
            this.checkSubmit = true;
          } else if (!this.course.title == '' && this.course.category > 0 && this.validationNumber > 0) {
            this.checkSubmit = false;
          }
        }
      )
    },
    methods: {
      // カテゴリーのチェックボックス処理：追加
      addCheckbox: function() {
        if (this.course.category < 5) {
          this.course.category += 1;
        }
      },
      // カテゴリーのチェックボックス処理：削除
      reduceCheckbox: function() {
        this.course.category -= 1;
      },
      // 画像の処理：追加
      addImage: function() {
        this.validationNumber += 1
      },
      // 画像の処理：削除
      removeImage: function() {
        this.validationNumber -= 1
      },
      // コースを登録するバリデーションチェック
      checkForm: function (e) {
        if (this.course.title && this.course.category) {
          return true;
        }
        this.errors = [];
        if (!this.course.title) {
          this.errors.push('タイトルは必須です。');
        }
        if (!this.course.category) {
          this.errors.push('カテゴリーは必須です。');
        }
        e.preventDefault();
      }
    },
  }
</script>

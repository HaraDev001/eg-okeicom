<template>
  <div class="l-wrap--owner--main single-page">
    <div class="l-wrap--owner--main--inner">
      <div class="l-wrap--owner--header">
        <div class="l-wrap--owner--header--title">
          <a
            href="/owner-admin/users/"
            class="c-link--back"
          >
            ユーザー一覧へ戻る
          </a>
          <p>ユーザー詳細</p>
        </div>
        <div class="l-wrap--owner--header--button">
          <div class="c-button--minus">
            <button
              type="button"
              @click.prevent="deleteUser(user.id)"
            >
              ユーザーを削除する
            </button>
          </div>
        </div>
      </div>
      <div class="l-wrap--owner--body">
        <div class="l-wrap--owner--body--inner">
          <div class="c-list--table">
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  プロフィール画像
                </p>
              </div>
              <div class="c-list--td">
                <div class="c-img--preview u-ml0_pc">
                  <div class="c-img--preview--image c-img--cover">
                    <!-- <img :src="data.image"> -->
                    <img :src="`/storage/profile/${user.img}`">
                  </div>
                  <!-- <span class="c-img--preview--button">
                    <div class="c-img--preview--button--inner">
                      <img src="/img/common/icon-camera-black.png">
                      <input
                        ref="file"
                        type="file"
                        name="img"
                        @change="setImage"
                      >
                    </div>
                  </span> -->
                </div>
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  アカウント名
                </p>
                <p class="sub">
                  アカウント名は変更できません。
                </p>
              </div>
              <div class="c-list--td">
                <input
                  v-model="user.account"
                  type="text"
                  name="account"
                  class="c-input--fixed"
                  disabled
                >
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  ユーザーネーム
                </p>
                <p class="sub">
                  サイトに表示する名前です。
                  <br>
                  20文字以内です。
                </p>
              </div>
              <div class="c-list--td">
                <input
                  v-model="user.name"
                  type="text"
                  name="name"
                  class="c-input--fixed"
                  disabled
                >
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  メールアドレス
                </p>
              </div>
              <div class="c-list--td">
                <input
                  v-model="user.email"
                  type="text"
                  name="email"
                  class="c-input--fixed"
                  disabled
                >
              </div>
            </div>
            <!-- <div class="c-list--tr">
                  <div class="c-list--th">
                      <p class="main">
                      パスワード
                      </p>
                  </div>
                  <div class="c-list--td">
                      <input
                      v-model="user.password"
                      type="password"
                      name="password"
                      class="c-input--fixed"
                      disabled
                      >
                  </div>
              </div> -->
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  性別
                </p>
              </div>
              <div class="c-list--td">
                <input
                  v-model="user.sex"
                  type="text"
                  name="sex"
                  class="c-input--fixed"
                  disabled
                >
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  国籍
                </p>
              </div>
              <div class="c-list--td">
                <input
                  v-model="user.country_id"
                  type="text"
                  name="country_id"
                  class="c-input--fixed"
                  disabled
                >
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  言語
                </p>
              </div>
              <div class="c-list--td">
                <input
                  v-model="user.language_id"
                  type="text"
                  name="language_id"
                  class="c-input--fixed"
                  disabled
                >
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  都道府県
                </p>
              </div>
              <div class="c-list--td">
                <!-- <div class="c-selectBox">
                  <select v-model="user.prefecture_id">
                    <option
                      v-for="(prefecture, index) in prefectures"
                      :key="index"
                      :value="prefecture.id"
                    >
                      {{ prefecture.name }}
                    </option>
                  </select>
                </div> -->
                <input
                  v-model="userDate.pref"
                  type="text"
                  name="language_id"
                  class="c-input--fixed"
                  disabled
                >
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  出金時の手数料
                </p>
                <p class="sub">
                  100以下の半角数字のみです。
                </p>
              </div>
              <div class="c-list--td">
                <input
                  v-model="user.commition_rate"
                  type="number"
                  name="commition_rate"
                >
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  カテゴリー
                </p>
              </div>
              <div class="c-list--td">
                <span v-if="user.category1_id">{{ userDate.category1_name }}</span>
                <span v-if="user.category2_id"> / {{ userDate.category2_name }}</span>
                <span v-if="user.category3_id"> / {{ userDate.category3_name }}</span>
                <span v-if="user.category4_id"> / {{ userDate.category4_name }}</span>
                <span v-if="user.category5_id"> / {{ userDate.category5_name }}</span>
                <!-- <select-list-category-component
                  :user="user"
                  :category-list="categoryList"
                /> -->
                <!-- <div class="c-selectBox u-mb5">
                  <select v-m odel="user.category1_id">
                    <option
                      v-for="(category, index) in categories"
                      :key="index"
                      :value="category.id"
                    >
                      {{ category.name }}
                    </option>
                  </select>
                </div>
                <div class="c-selectBox u-mb5">
                  <select v-model="user.category2_id">
                    <option
                      v-for="(category, index) in categories"
                      :key="index"
                      :value="category.id"
                    >
                      {{ category.name }}
                    </option>
                  </select>
                </div>
                <div class="c-selectBox u-mb5">
                  <select v-model="user.category3_id">
                    <option
                      v-for="(category, index) in categories"
                      :key="index"
                      :value="category.id"
                    >
                      {{ category.name }}
                    </option>
                  </select>
                </div>
                <div class="c-selectBox u-mb5">
                  <select v-model="user.category4_id">
                    <option
                      v-for="(category, index) in categories"
                      :key="index"
                      :value="category.id"
                    >
                      {{ category.name }}
                    </option>
                  </select>
                </div>
                <div class="c-selectBox u-mb5">
                  <select v-model="user.category5_id">
                    <option
                      v-for="(category, index) in categories"
                      :key="index"
                      :value="category.id"
                    >
                      {{ category.name }}
                    </option>
                  </select>
                </div> -->
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  プロフィール
                </p>
                <p class="sub">
                  1000文字以内です。
                </p>
              </div>
              <div class="c-list--td">
                <textarea
                  v-model="user.profile"
                  name="profile"
                  class="c-input--fixed"
                  disabled
                />
              </div>
            </div>
          </div>
        </div>
        <div class="l-button--submit">
          <button
            type="button"
            class="c-button--square__pink"
            @click.prevent="updateUser(user.id)"
          >
            出金手数料を設定する
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import axios from 'axios'
  // import selectListCategoryComponent from './../../store/SelectListCategoryComponent.vue'

	export default {
    components: {
      // 'select-list-category-component': selectListCategoryComponent,
    },
    props: {
      userDate: {
        type: Object,
        required: true
      },
      categoryList: {
        type: Array,
        required: true
      },
      // lessons: {
      //   type: Array,
      //   required: false,
      //   default: () => []
      // }
    },
		data() {
			return {
        // 新規登録画像
        user: {},
        // user: this.userDate,
				data: {
					image: "/img/sample-human.png",
					name: "",
        },
        prefectures: [],
        categories: [],
			}
		},
    created: function() {
      // ユーザー詳細取得API
      axios.get(`/api/v1/users/${this.userDate.id}`)
        .then(result => {
          // 管理者の承認が実行されていない出金リクエストを取得する
          this.user = result.data
          if(this.user.sex === 0) {
            this.user.sex = '不明'
          } else if(this.user.sex === 1) {
            this.user.sex = '男性'
          } else if(this.user.sex === 2) {
            this.user.sex = '女性'
          }
          console.log(this.user)
        })
        .catch(error => {
          console.log(error)
          alert('ユーザー詳細取得時にエラーが発生しました。')
        })

      // 都道府県一覧取得API
      axios.get('/api/v1/prefectures')
        .then(result => {
          // 管理者の承認が実行されていない出金リクエストを取得する
          this.prefectures = result.data;
        })
        .catch(error => {
          console.log(error)
          alert('都道府県一覧取得時にエラーが発生しました。')
        })

      // カテゴリーを配列に入れる
      this.user['categories'] = []
      for(let i = 1; i < 6; i++) {
        if(this.user['category' + i + '_id'] !== null) {
          this.user['categories'].push(this.user['category' + i + '_id'])
        }
      }

      // 数字が小さい順に並び替える
      this.user['categories'].sort(function(first, second){
        return first - second;
      });
    },
    methods: {
     // ユーザー削除
      deleteUser: function(id) {
        axios.delete(`/api/v1/users/${id}`)
          .then(result => {
            alert(result.data)
            // リロード
            location.reload()
          })
          .catch(error => {
            alert('ユーザーの削除に失敗しました。')
            console.log(error)
          })
      },
      // ユーザー更新API
      updateUser() {
        console.log(this.user['categories'])
        axios
          .put(`/api/v1/users/${this.user.id}`, this.user)
          .then(result => {
            alert('ユーザーの更新に成功しました。')
            // console.log(result)
            location.reload()
          })
          .catch(error => {
            alert('ユーザーの更新に失敗しました。')
            console.log(error)
          })
      },
			// ユーザーの画像
			setImage() {
				const files = this.$refs.file;
				const fileImg = files.files[0];
				if (fileImg.type.startsWith("image/")) {
					this.data.image = window.URL.createObjectURL(fileImg);
					this.data.name = fileImg.name;
					this.data.type = fileImg.type;
				}
			},
		},
	}
</script>

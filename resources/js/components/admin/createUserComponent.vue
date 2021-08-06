<template>
  <div class="l-wrap--owner--main single-page">
    <div class="l-wrap--owner--main--inner">
      <div class="l-wrap--owner--header">
        <div class="l-wrap--owner--header--title">
          <a href="" class="c-link--back">ユーザー一覧へ戻る</a>
          <p>ユーザー追加</p>
        </div>
      </div>
      <div class="l-wrap--owner--body">
        <div class="l-wrap--owner--body--inner">
          <div class="c-list--table">
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">プロフィール画像</p>
              </div>
              <div class="c-list--td">
                <div class="c-img--preview u-ml0_pc">
                  <div class="c-img--preview--image c-img--cover">
                    <img :src="data.image">
                  </div>
                  <span class="c-img--preview--button">
                    <div class="c-img--preview--button--inner">
                      <img src="/img/common/icon-camera-black.png">
                      <input type="file" ref="file" @change="setImage"/>
                    </div>
                  </span>
                </div>
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">アカウント名</p>
                <p class="sub">アカウント名は後で変更できません。</p>
              </div>
              <div class="c-list--td">
                <input type="" name="" value="中澤　寛">
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">ユーザーネーム</p>
                <p class="sub">サイトに表示する名前です。<br>20文字以内です。</p>
              </div>
              <div class="c-list--td">
                <input type="" name="" value="中澤　寛">
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">パスワード</p>
              </div>
              <div class="c-list--td">
                <input type="" name="" value="中澤　寛">
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">性別</p>
                <p class="sub">性別は後で変更できません。</p>
              </div>
              <div class="c-list--td">
                <div class="c-selectBox">
                  <select>
                    <option>男性</option>
                    <option>女性</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">国籍</p>
              </div>
              <div class="c-list--td">
                <input type="" name="" value="日本">
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">言語</p>
              </div>
              <div class="c-list--td">
                <input type="" name="" value="日本語">
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">都道府県</p>
              </div>
              <div class="c-list--td">
                <div class="c-selectBox">
                  <select>
                    <option>東京</option>
                    <option>北海道</option>
                    <option>北海道</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">カテゴリー</p>
              </div>
              <div class="c-list--td">
                <div class="c-selectBox u-mb5">
                  <select>
                    <option>カテゴリー1</option>
                    <option>カテゴリー2</option>
                    <option>カテゴリー3</option>
                  </select>
                </div>
                <div class="c-selectBox u-mb5">
                  <select>
                    <option>カテゴリー1</option>
                    <option>カテゴリー2</option>
                    <option>カテゴリー3</option>
                  </select>
                </div>
                <div class="c-selectBox u-mb5">
                  <select>
                    <option>カテゴリー1</option>
                    <option>カテゴリー2</option>
                    <option>カテゴリー3</option>
                  </select>
                </div>
                <div class="c-selectBox u-mb5">
                  <select>
                    <option>カテゴリー1</option>
                    <option>カテゴリー2</option>
                    <option>カテゴリー3</option>
                  </select>
                </div>
                <div class="c-selectBox">
                  <select>
                    <option>カテゴリー1</option>
                    <option>カテゴリー2</option>
                    <option>カテゴリー3</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">プロフィール</p>
                <p class="sub">1000文字以内です。</p>
              </div>
              <div class="c-list--td">
                <textarea value="あああ"></textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="l-button--submit">
          <input type="subit" name="" value="変更内容を保存する" class="c-button--square__pink">
        </div>
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
				// 新規登録画像
				data: {
					image: "/img/sample-human.png",
					name: "",
				},
			}
		},
		created: function() {},
		computed: {},
		methods: {
			// ユーザーの画像
			setImage(e) {
				const files = this.$refs.file;
				const fileImg = files.files[0];
				if (fileImg.type.startsWith("image/")) {
					this.data.image = window.URL.createObjectURL(fileImg);
					this.data.name = fileImg.name;
					this.data.type = fileImg.type;
				}
			},
		},
		watch: {},
	}
</script>

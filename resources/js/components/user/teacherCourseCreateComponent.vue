<template>
  <div class="l-wrap--single">
    <div class="l-wrap--title">
      <a class="c-link--back u-mb5">レッスン一覧へ戻る</a>
      <h1 class="c-headline--screen">
        コースを作成する
      </h1>
    </div>
    <div class="l-wrap--body">
      <div class="l-wrap--main l-wrap--detail">
        <div class="l-content--detail">
          <div class="teacher-course-add-step">
            <div
              class="teacher-course-add-step-panel"
              :class="{'now': stepTab === '1'}"
            >
              <span>ステップ１</span>
              <p>コース情報を登録</p>
            </div>
            <div
              class="teacher-course-add-step-panel"
              :class="{'now': stepTab === '2'}"
            >
              <span>ステップ２</span>
              <p>レッスン情報を登録</p>
            </div>
          </div>
        </div>
        <div class="l-courseCreate--wrap" v-if="stepTab === '1'">
          <div class="l-content--detail">
            <div class="c-headline--block">画像を選択</div>
            <div class="l-content--detail__inner">
              <ul class="c-input--file--five">
                <li class="c-input--file--five--inner" v-for="(item, index) in couseDetailFiles" :key="index">
                  <div class="c-img--cover">
                    <img :src="item.url" v-if="item.url !== ''">
                    <span class="delete-file pc-only" :class="{active: item.isDelete}" @click="deleteFile(index)"></span>
                    <span class="add-file" :class="{active: item.isAdd}">
                      <input
                        type="file"
                        name=""
                        ref="file"
                        @change="uploadFile(index)"
                      >
                    </span>
                  </div>
                  <span class="change-file" :class="{active: item.isDelete}">
                    <span class="change-file-inner">
                      <img src="/img/common/icon-camera-black.png">
                      <input type="file" name="" ref="change" @change.self="changeFile(index)">
                    </span>
                  </span>
                  <span class="delete-icon sp-only" :class="{active: item.isDelete}" @click="deleteFile(index)">
                    <img src="/img/common/icon-dust-black.png">
                  </span>
                </li>
              </ul>
            </div>
          </div>
          <div class="l-content--detail">
            <div class="c-headline--block">カテゴリーを選択</div>
            <div class="l-content--detail__inner">
              <ul class="c-list--category">
                <li><input type="checkbox" name=""><label>語学</label></li>
                <li><input type="checkbox" name=""><label>家庭教師</label></li>
                <li><input type="checkbox" name=""><label>音楽</label></li>
                <li><input type="checkbox" name=""><label>アートデザイン</label></li>
                <li><input type="checkbox" name=""><label>美容</label></li>
                <li><input type="checkbox" name=""><label>健康</label></li>
                <li><input type="checkbox" name=""><label>ダンス</label></li>
                <li><input type="checkbox" name=""><label>バレエ</label></li>
                <li><input type="checkbox" name=""><label>フィットネス</label></li>
                <li><input type="checkbox" name=""><label>武道</label></li>
                <li><input type="checkbox" name=""><label>書道</label></li>
                <li><input type="checkbox" name=""><label>お茶</label></li>
                <li><input type="checkbox" name=""><label>お花</label></li>
                <li><input type="checkbox" name=""><label>手芸</label></li>
                <li><input type="checkbox" name=""><label>パソコン</label></li>
                <li><input type="checkbox" name=""><label>趣味</label></li>
                <li><input type="checkbox" name=""><label>教養</label></li>
                <li><input type="checkbox" name=""><label>その他</label></li>
              </ul>
            </div>
          </div>
          <div class="l-content--detail">
            <div class="c-headline--block">詳細</div>
            <div class="l-content--detail__inner">
              <div class="l-content--input">
                <p class="l-content--input__headline">タイトル</p>
                <input type="" name="" placeholder="タイトルを入力してください">
              </div>
              <div class="l-content--input">
                <p class="l-content--input__headline">詳細</p>
                <textarea></textarea>
              </div>
            </div>
          </div>
          <div class="l-button--submit">
            <button class="c-button--square__pink" @click="nextTab">ステップ2：レッスン登録</button>
          </div>
        </div>
        <div class="l-courseCreate--wrap" v-else-if="stepTab === '2'">
          <div class="l-content--detail">
            <div class="teacher-course-add-lesson">
              <div class="c-button--add u-mb0">
                <a href="">レッスンを追加</a>
              </div>
              <div class="teacher-course-add-lesson-list">
                <div class="teacher-course-add-lesson-list-detail">
                  <p class="date">2020-12-13　10:00-12:00</p>
                  <p class="title">レッスンタイトルレッスンタイトルレッスンタイトル</p>
                </div>
                <div class="c-button--edit">
                  <a class="c-button--edit--link delete">削除</a>
                  <a class="c-button--edit--link edit">編集</a>
                </div>
              </div>
              <div class="teacher-course-add-lesson-list">
                <div class="teacher-course-add-lesson-list-detail">
                  <p class="date">2020-12-13　10:00-12:00</p>
                  <p class="title">レッスンタイトルレッスンタイトルレッスンタイトル</p>
                </div>
                <div class="c-button--edit">
                  <a class="c-button--edit--link delete">削除</a>
                  <a class="c-button--edit--link edit">編集</a>
                </div>
              </div>
              <div class="teacher-course-add-lesson-list">
                <div class="teacher-course-add-lesson-list-detail">
                  <p class="date">2020-12-13　10:00-12:00</p>
                  <p class="title">レッスンタイトルレッスンタイトルレッスンタイトル</p>
                </div>
                <div class="c-button--edit">
                  <a class="c-button--edit--link delete">削除</a>
                  <a class="c-button--edit--link edit">編集</a>
                </div>
              </div>
            </div>
          </div>
          <div class="l-button--submit">
            <button class="c-button--square__pink u-mb10_sp" type="submit">コースを登録する</button>
            <button class="c-button--square__gray" type="submit" @click="backTab">ステップ1へ戻る</button>
          </div>
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
				couseDetailFiles: [
					{ url: "", isAdd: true, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
				],
				stepTab: '1',
			}
		},
		created: function() {
			// 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義

		},
		computed: {},
		methods: {
			// 次のステップへ
			nextTab: function() {
				this.stepTab = '2'
				// トップに戻る
				window.scrollTo({
					top: 0,
				});
			},
			// 前のステップへ
			backTab: function() {
				this.stepTab = '1'
			},
			// 画像のアップロード
			uploadFile: function(index) {
				let files = this.$refs.file[index]
				let fileImg = files.files[0]
				if (fileImg.type.startsWith("image/")) {
					if(index === 4) {
						this.couseDetailFiles[index].isAdd = false
						this.couseDetailFiles[index].isDelete = true
						this.couseDetailFiles[index].url = window.URL.createObjectURL(fileImg)
					} else {
						this.couseDetailFiles[index].isAdd = false
						this.couseDetailFiles[index].isDelete = true
						this.couseDetailFiles[index].url = window.URL.createObjectURL(fileImg)
						// 次の画像アップロード箇所追加
						this.couseDetailFiles[index+1].isAdd = true
					}
				}

			},
			// 画像の変更
			changeFile: function(index) {
				let files = this.$refs.change[index]
				let fileImg = files.files[0]
				if (fileImg.type.startsWith("image/")) {
					this.couseDetailFiles[index].url = window.URL.createObjectURL(fileImg)
				}
			},
			// 画像の削除
			deleteFile: function(index) {
				// 選択した画像が5枚目の場合
				this.couseDetailFiles[index].url = ""
				if(index === 4) {
					this.couseDetailFiles[index].isAdd = true
					this.couseDetailFiles[index].isDelete = false
				} else {
					let i = 1
					while(i < 6) {
						if(!this.couseDetailFiles[index+i].url == "") {
							this.couseDetailFiles[index+i-1].url = this.couseDetailFiles[index+i].url
							// 次に配列が存在しない場合
							if(!this.couseDetailFiles[index+i+1]) {
								this.couseDetailFiles[index+i].url = ""
								this.couseDetailFiles[index+i].isAdd = true
								this.couseDetailFiles[index+i].isDelete = false
								break
							}
							i += 1

						} else {
							this.couseDetailFiles[index+i-1].url = ""
							this.couseDetailFiles[index+i-1].isAdd = true
							this.couseDetailFiles[index+i-1].isDelete = false
							this.couseDetailFiles[index+i].isAdd = false
							i = 1
							break
						}
					}
				}
			},
		},
		watch: {},
	}
</script>

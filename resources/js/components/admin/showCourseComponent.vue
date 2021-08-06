<template>
  <!-- 本文 -->
  <div class="l-wrap--owner--main single-page">
    <div class="l-wrap--owner--main--inner">
      <div class="l-wrap--owner--header">
        <div class="l-wrap--owner--header--title">
          <p>コース詳細</p>
        </div>
        <div class="l-wrap--owner--header--button">
          <div class="c-button--minus">
            <a href="">コースを削除する</a>
          </div>
        </div>
      </div>
      <div class="l-wrap--owner--body">
        <div class="l-wrap--owner--body--inner">
          <div class="c-button--tab top-tab two-tab">
            <div class="c-button--tab--inner u-w400_pc">
              <div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '1'}" @click.prevent="changeTab('1')">コース詳細</div>
              <div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '2'}" @click.prevent="changeTab('2')">レッスン一覧</div>
            </div>
          </div>
          <div class="c-list--table" v-if="isBarTab === '1'">
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">URL</p>
              </div>
              <div class="c-list--td">
                <input type="" name="" class="c-input--fixed" disabled value="aaaa">
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">画像</p>
              </div>
              <div class="c-list--td">
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
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">カテゴリー</p>
              </div>
              <div class="c-list--td">
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
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">タイトル</p>
              </div>
              <div class="c-list--td">
                <input placeholder="1234567">
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">詳細</p>
              </div>
              <div class="c-list--td">
                <textarea></textarea>
              </div>
            </div>
            <div class="l-button--submit">
              <input type="subit" name="" value="変更内容を保存する" class="c-button--square__pink">
            </div>
          </div>
          <!-- tab：その他 -->
          <div class="l-contentList__list__wrap" v-else-if="isBarTab === '2'">
            <div class="c-list--courseLesson" v-for="i in 10">
              <div class="c-list--courseLesson--num">
                <span># {{ i }}</span>
              </div>
              <div class="c-list--courseLesson--title">
                <p class="title u-text--big u-mb5">タイトルタイトルタイトルタイトル</p>
                <p class="date u-color--grayNavy u-text--small">10/20(土) 17:00-20:00</p>
              </div>
              <!-- 開催日を超えた現場は削除 -->
              <div class="c-button--edit">
                <a href="" class="c-button--edit--link delete">削除</a>
                <a href="" class="c-button--edit--link edit">編集</a>
              </div>
            </div>
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
				// 新規登録画像
				data: {
					image: "/img/sample-human.png",
					name: "",
				},
				// コースの画像
				couseDetailFiles: [
					{ url: "", isAdd: true, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
				],
				isBarTab: '1',
			}
		},
		created: function() {},
		computed: {},
		methods: {
			// コース詳細：タブ切り替え
			changeTab: function(num){
				this.isBarTab = num
			},
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
						// 次の画像がない場合
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

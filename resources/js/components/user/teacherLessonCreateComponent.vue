<template>
	<div class="l-wrap--single">
		<div class="l-wrap--title">
			<a class="c-link--back u-mb5">レッスン一覧</a>
			<h1 class="c-headline--screen">レッスン詳細を登録</h1>
		</div>
		<div class="l-wrap--body">
			<div class="l-wrap--main l-wrap--detail">
				<!-- <div class="l-content--detail">
					<div class="teacher-course-add-step">
						<div class="teacher-course-add-step-panel">
							<span>ステップ１</span>
							<p>コース情報を登録</p>
						</div>
						<div class="teacher-course-add-step-panel now">
							<span>ステップ２</span>
							<p>レッスン情報を登録</p>
						</div>
					</div>
				</div> -->
				<div class="l-content--detail">
					<div class="l-content--detail__inner">
						<div class="l-content--input">
							<p class="l-content--input__headline">タイトル</p>
							<input type="" name="" placeholder="タイトルを入力してください">
						</div>
						<div class="l-content--input">
							<p class="l-content--input__headline">放送タイプ</p>
							<ul class="u-pl10">
								<li class="u-mb15">
									<div class="c-checkbox--fashonable">
										<label>生放送
											<input type="radio" name="type" :checked="true" @change.prevent="changeType('1')">
											<div class="color-box"></div>
										</label>
									</div>
								</li>
								<li class="u-mb15">
									<div class="c-checkbox--fashonable">
										<label>動画埋め込み
											<input type="radio" name="type" @change.prevent="changeType('2')">
											<div class="color-box"></div>
										</label>
									</div>
								</li>
								<li>
									<div class="c-checkbox--fashonable">
										<label>スライド
											<input type="radio" name="type" @change.prevent="changeType('3')">
											<div class="color-box"></div>
										</label>
									</div>
								</li>
							</ul>
						</div>
						<div class="l-content--input" v-if="isType === '2'">
							<p class="l-content--input__headline">URL</p>
							<input type="text" name="" placeholder="https://www.youtube.com/">
						</div>
						<div class="l-content--input" v-if="isType === '3'">
							<p class="l-content--input__headline">スライドファイル（powerpoint）</p>
							<input type="file" name="" placeholder="スライドファイル" accept="application/vnd.openxmlformats-officedocument.presentationml.presentation,.pptx,application/vnd.ms-powerpoint,.ppt">
						</div>
						<div class="l-content--input">
							<p class="l-content--input__headline">開催日時</p>
							<vuejs-datepicker
								:format="DatePickerFormat"
								:language="ja"
							></vuejs-datepicker>
						</div>
						<div class="l-content--input">
							<div class="l-flex">
								<div class="l-content--input__two">
									<div class="l-content--input__headline">開始時間</div>
									<div class="l-flex l-start">
										<div class="l-content--input__two u-w100_pc">
											<select>
												<option v-for="i in 24">{{i}}</option>
											</select>
										</div>
										<div class="l-content--input__two u-w100_pc">
											<select>
												<option v-for="i in 60">{{i}}</option>
											</select>
										</div>
									</div>

								</div>
								<div class="l-content--input__two">
									<div class="l-content--input__headline">終了時間</div>
									<div class="l-flex l-start">
										<div class="l-content--input__two u-w100_pc">
											<select>
												<option v-for="i in 24">{{i}}</option>
											</select>
										</div>
										<div class="l-content--input__two u-w100_pc">
											<select>
												<option v-for="i in 60">{{i}}</option>
											</select>
										</div>
									</div>
								</div>
							</div>

						</div>
						<div class="l-content--input">
							<p class="l-content--input__headline">詳細</p>
							<textarea></textarea>
						</div>
						<div class="l-content--input">
							<p class="l-content--input__headline">金額 <span class="u-text--small u-color--grayNavy">（最高 100万円）</span></p>
							<input type="" name="" placeholder="半角数字を入力してください">
						</div>
						<div class="l-content--input">
							<p class="l-content--input__headline">キャンセル手数料</p>
							<div class="c-selectBox u-w100">
								<select>
									<option v-for="i in 101">{{i}}%</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="l-button--submit">
			<input class="c-button--square__pink" type="subit" name="" value="レッスンを追加">
		</div>
	</div>
</template>
<script>
	export default {
		components: {

		},
		data() {
			return {
				isType: '1',
			}
		},
		created: function() {
			// 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義

		},
		computed: {},
		methods: {
			// 放送タイプ
			changeType: function(type) {
				this.isType = type
			},
		},
		watch: {},
	}
</script>

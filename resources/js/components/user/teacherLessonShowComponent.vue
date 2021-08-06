<template>
	<div class="l-modal" :class="{open: isParticipantDetail}" @click.self="openDetail">
		<div class="l-modal--wrap">
			<div class="close-button">
				<span class="close-icon" @click.prevent="openDetail"><img src="/img/common/icon-batsu-white.png"></span>
			</div>
			<div class="l-modal--wrap--inner">
				<div class="l-modal--content">
					<div class="l-modal--header">
						<div class="l-modal--header--img">
							<div class="c-img--cover c-img--round">
								<img src="/img/common/screen-top.jpg">
							</div>
						</div>
						<div class="l-modal--header--button">
							<ul>
								<li class="message"><a href="">メッセージを送る</a></li>
								<li class="reject"><a href="">参加を拒否する</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="l-modal--content">
					<div class="l-modal--name">
						<p class="sub">アカウント名</p>
						<p class="main">アカウント名アカウント名</p>
					</div>
				</div>
				<div class="l-modal--detail">
					<div class="l-modal--detail--box l-modal--content">
						<p class="sub">性別</p>
						<p class="main">男性</p>
					</div>
					<div class="l-modal--detail--box l-modal--content">
						<p class="sub">年齢</p>
						<p class="main">29歳</p>
					</div>
					<div class="l-modal--detail--box l-modal--content">
						<p class="sub">都道府県</p>
						<p class="main">北海道</p>
					</div>
				</div>
				<div class="l-modal--content border-none">
					<div class="l-modal--profile">
						<p class="sub">プロフィール</p>
						<p class="main">プロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィール</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="l-wrap--main--inner">
		<div class="c-button--tab top-tab two-tab">
			<div class="c-button--tab--inner u-w400_pc">
				<div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '1'}" @click.prevent="changeTab('1')">レッスン詳細</div>
				<div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '2'}" @click.prevent="changeTab('2')">参加者一覧</div>
			</div>
		</div>
		<!-- tab：コース詳細 -->
		<div class="c-list--table" v-if="isBarTab === '1'">
			<div class="c-list--tr">
				<div class="c-list--th">
					<p class="main">タイトル</p>
				</div>
				<div class="c-list--td">
					<input type="" name="" placeholder="タイトルを入力してください">
				</div>
			</div>
			<!-- case：放送タイプが動画埋め込みの場合 -->
			<div class="c-list--tr">
				<div class="c-list--th">
					<p class="main">URL</p>
				</div>
				<div class="c-list--td">
					<input type="" name="" placeholder="https://www.youtube.com/">
				</div>
			</div>
			<!-- case：放送タイプがスライドの場合 -->
			<div class="c-list--tr">
				<div class="c-list--th">
					<p class="main">スライドファイル（powerpoint）</p>
				</div>
				<div class="c-list--td">
					<input type="file" name="" placeholder="スライドファイル" accept="application/vnd.openxmlformats-officedocument.presentationml.presentation,.pptx,application/vnd.ms-powerpoint,.ppt">
				</div>
			</div>
			<div class="c-list--tr">
				<div class="c-list--th">
					<p class="main">開催日時</p>
				</div>
				<div class="c-list--td">
					<div class="l-flex">
						<div class="l-content--input__two">
							<div class="l-content--input__headline">開始時間</div>
							<div class="l-flex l-start">
								<div class="l-content--input__two u-w100_pc">
									<select>
										<option v-for="i in 24">{{ i }}</option>
									</select>
								</div>
								<div class="l-content--input__two u-w100_pc">
									<select>
										<option v-for="i in 60">{{ i }}</option>
									</select>
								</div>
							</div>
						</div>
						<div class="l-content--input__two">
							<div class="l-content--input__headline">終了時間</div>
							<div class="l-flex l-start">
								<div class="l-content--input__two u-w100_pc">
									<select>
										<option v-for="i in 24">{{ i }}</option>
									</select>
								</div>
								<div class="l-content--input__two u-w100_pc">
									<select>
										<option v-for="i in 60">{{ i }}</option>
									</select>
								</div>
							</div>
						</div>
					</div>
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
			<div class="c-list--tr">
				<div class="c-list--th">
					<p class="main">金額</p>
				</div>
				<div class="c-list--td">
					<input type="" name="" placeholder="半角数字を入力してください">
				</div>
			</div>
			<div class="c-list--tr">
				<div class="c-list--th">
					<p class="main">キャンセル手数料</p>
				</div>
				<div class="c-list--td">
					<div class="c-selectBox u-w100">
						<select>
							<option v-for="i in 101">{{i}}}%</option>
						</select>
					</div>
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
					<div class="c-img--round c-img--cover">
						<img src="/img/common/screen-top.jpg">
					</div>
				</div>
				<div class="c-list--courseLesson--title u-pl10">
					<p class="title u-text--big u-mb5">名前名前</p>
					<p class="date u-color--grayNavy u-text--small">10/20(土) 12:00</p>
				</div>
				<!-- 開催日を超えた現場は削除 -->
				<div class="c-button--edit">
					<a class="c-button--edit--link edit" @click.prevent="openDetail">詳細</a>
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
				isBarTab: '1',
				isParticipantDetail: false,
			}
		},
		created: function() {
			// 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義

		},
		computed: {},
		methods: {
			// 講師詳細：
			changeTab: function(num){
				this.isBarTab = num
			},
			openDetail: function() {
				this.isParticipantDetail =! this.isParticipantDetail
			}
		},
		watch: {},
	}
</script>

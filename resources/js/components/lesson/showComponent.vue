<template>
	<div class="l-lessonDetail">
		<div class="l-lessonDetail__header">
			<div class="l-allWrapper">
				<div class="l-lessonDetail__header__inner cf">
					<div class="c-lessonDetail__headline">
						<p class="title">レッスン名レッスン名レッスン名レッスン名レッスン名</p>
						<div class="sub">
							<span class="application">申込人数：</span>
							<span class="evaluation"><img src="/img/common/icon-star.png">4.8</span>
						</div>
					</div>
					<div class="c-lessonDetail__img l-flex">
						<div class="c-lessonDetail__img__thumb c-img--cover">
							<img src="/img/common/screen-top.jpg">
						</div>
						<ul class="c-lessonDetail__img__list">
							<li><img src="/img/common/screen-top.jpg"></li>
							<li><img src="/img/common/screen-top.jpg"></li>
							<li><img src="/img/common/screen-top.jpg"></li>
							<li><img src="/img/common/screen-top.jpg"></li>
							<li><img src="/img/common/screen-top.jpg"></li>
						</ul>
					</div>
					<div class="c-lessonDetail__info">
						<div class="other l-flex l-v__center">
							<div class="other__price">
								<p class="price">¥12,000</p>
								<p class="cancel">キャンセル手数料：30%（¥3,000）</p>
							</div>
							<div class="other__date">
								<p class="date">10/20<span class="week">(土)</span><br>17:00-20:00</p>
							</div>
							<div class="other_reserve">
								<a href="">予約する</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="l-lessonDetail__body">
			<div class="l-allWrapper">
				<div class="l-lessonDetail__body__inner l-flex">
					<div class="l-lessonDetail__body__main">
						<div class="c-lessonDetail__content">
							<div class="c-lessonDetail__content__title">
								<h2>レッスン詳細</h2>
							</div>
							<div class="c-lessonDetail__content__wrap lesson-detail">
								<p class="detail">レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細</p>
								<table>
									<tr>
										<th>タイプ</th>
										<td>LIVE</td>
									</tr>
									<tr>
										<th>カテゴリー</th>
										<td><span class="category">普通</span><span class="category">バレエ</span></td>
									</tr>
								</table>
							</div>
						</div>
						<div class="c-lessonDetail__content">
							<div class="c-lessonDetail__content__title">
								<h2>講師の口コミ</h2>
							</div>
							<div class="c-lessonDetail__content__wrap lesson-comment">
								<div class="c-userComment__box" v-for="i in 3">
									<div class="c-userComment__human l-flex l-start l-v__center">
										<div class="img">
											<div class="c-img--round c-img--cover">
												<img src="/img/common/screen-top.jpg">
											</div>
										</div>
										<div class="info">
											<p class="name">TANAKA ATSUSHI</p>
											<p class="other">
												<span class="evaluation"><img src="/img/common/icon-star.png">4.8</span>
												<span class="date">2020-12-13 23:00</span>
											</p>
										</div>
									</div>
									<div class="c-userComment__content">
										<p>レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="l-lessonDetail__body__sidebar">
						<div class="l-lessonDetail__body__sidebar__title sp-only">
							<h2>講師紹介</h2>
						</div>
						<div class="l-lessonDetail__body__sidebar__wrap">
							<div class="teacher__img">
								<div class="teacher__img__inner c-img--round c-img--cover">
									<img src="/img/common/screen-top.jpg">
								</div>
							</div>
							<div class="teacher__profile">
								<div class="teacher__profile__detail">
									<p class="name">佐藤麻衣</p>
									<p class="evaluation"><img src="/img/common/icon-star.png">4.8</p>
								</div>
								<ul class="c-teacher--box__category l-flex l-center">
									<li><span>アート・デザイン</span></li>
									<li><span>フィットネス</span></li>
									<li><span>家庭教師</span></li>
									<li><span>パソコン</span></li>
									<li><span>その他</span></li>
								</ul>
							</div>
							<div class="techer__detail">
								<p>佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい佐藤まい</p>
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
			return {}
		},
		created: function() {
			// 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義

		},
		computed: {},
		methods: {},
		watch: {},
	}
</script>

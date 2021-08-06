<template>
  <nav id="nav-global" class="sp-only" :class="{'open--nav':drawerActive}">
    <div class="nav-global__back">
      <a @click='closeDrawer'><img src="{{ asset('/img/icon-nav-back.png') }}"></a>
    </div>
    <ul class="nav-global__list">
      <li><a href="/">トップページ</a></li>
      <li><a href="/lessons.php">レッスン一覧</a></li>
      <li><a href="/teachers.php">講師一覧</a></li>
    </ul>
    <p class="c-sp-headline nav--title">会社情報</p>
    <ul class="nav-global__list">
      <li><a href="/news.php">お知らせ</a></li>
      <li><a href="/company.php">会社概要</a></li>
      <!-- <li><a href="/contact-us.php">料金決済の流れ</a></li> -->
      <li><a href="/contact-us.php">特定商取引法に基づく表記</a></li>
      <li><a href="/contact-us.php">お問い合わせ</a></li>
    </ul>
    <p class="c-sp-headline nav--title">講師向け</p>
    <ul class="nav-global__list">
      <li><a href="/terms-service.php">講師規約</a></li>
      <li><a href="/terms-point.php">講師キャンセルポリシー</a></li>
      <li><a href="/terms-user.php">講師よくある質問</a></li>
    </ul>
    <p class="c-sp-headline nav--title">受講者向け</p>
    <ul class="nav-global__list">
      <li><a href="/terms-service.php">受講者規約</a></li>
      <li><a href="/terms-point.php">受講者キャンセルポリシー</a></li>
      <li><a href="/terms-user.php">受講者よくある質問</a></li>
    </ul>
  </nav>
</template>

<script>
	export default {
        components: {},
		data() {
			return {

				drawerActive: false,
			}
		},

		created: function() {
			// 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義

		},
		computed: {},
		methods: {
			// ドロワーを開く
			openDrawer: function() {
				this.drawerActive = true
			},
			// ドロワーを閉じる
			closeDrawer: function() {
				this.drawerActive = false
			},
		},
        watch: {},
    }
</script>

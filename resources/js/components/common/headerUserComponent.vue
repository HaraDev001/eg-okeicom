<template>
  <header id="header">
    <!-- <modal-search
      v-show="searchShow"
      @from-child="closeSearch"
    >
      <form action="">
        <div class="l-modal--search__input">
          <input
            class="c-input--gray"
            type="text"
          >
        </div>
      </form>
    </modal-search> -->
    <div
      class="menu-user"
      :class="{'open': isMenuUser}"
    >
      <div class="menu-user--inner">
        <!-- <div class="menu-user--change">
          <a href="" class="u-text--link">講師に切り替える</a>
        </div> -->
        <ul class="menu-user--content">
          <li><a href="/mypage/u/change">講師の方はこちら</a></li>
          <li><a href="/mypage/u/attendance-lessons">受講予定レッスン</a></li>
          <li><a href="/mypage/u/taken-lessons">受講済みレッスン</a></li>
          <li><a href="/mypage/u/messages/">メッセージ</a></li>
          <li><a href="/mypage/u/profile/">プロフィール</a></li>
          <!-- <li><a href="/mypage/u/">クレジットカード情報</a></li> -->
          <!-- <li><a href="/mypage/u/bank/">銀行口座情報</a></li>
          <li><a href="/mypage/u/trade/">入出金管理</a></li> -->
          <li><a href="/contact">運営にお問い合わせ</a></li>
        </ul>
        <ul class="menu-user--content">
          <li>
            <a
              href="#"
              onclick="event.preventDefault();document.getElementById('logout-form').submit();"
            >
              ログアウト
            </a>
            <form
              id="logout-form"
              action="/logout"
              method="POST"
              style="display: none;"
            >
              <input
                type="hidden"
                name="_token"
                :value="csrf"
              >
            </form>
          </li>
        </ul>
      </div>
    </div>
    <div class="l-flex">
      <div class="header__left l-flex l-v__center">
        <div class="header__logo">
          <a href="/">
            <img
              class="sp-only"
              src="/img/common/okeicom-logo-square.png"
            >
            <img
              class="pc-only"
              src="/img/common/okeicom-logo-side.png"
            >
          </a>
        </div>
        <nav class="header__menu pc-only">
          <ul class="l-flex">
            <li><a href="/lessons/">レッスン一覧</a></li>
            <li><a href="/teachers/">講師一覧</a></li>
            <li><a href="/for-first">初めての方へ</a></li>
            <li><a href="/for-teacher">講師ご希望の方へ</a></li>
          </ul>
        </nav>
      </div>
      <div class="header__right l-flex l-v__center">
        <ul class="header__icon l-flex l-v__bottom sp-only">
          <li>
            <a @click="openSearch">
              <img
                src="/img/common/icon-search-pink.png"
                alt="検索アイコン">
              <span>検索</span>
            </a>
          </li>
          <li>
            <a href="/mypage/u/messages/">
              <img
                src="/img/common/icon-chat-pink.png"
                alt="チャットアイコン">
              <span>チャット</span>
            </a>
          </li>
          <li>
            <a @click="openDrawer">
              <img
                src="/img/common/icon-header-menu-bold-pink.png"
                alt="ハンバーガーメニューアイコン">
              <span>メニュー</span>
            </a>
          </li>
          <!-- <li class="menu-profile">
            <a class="c-img--shadow" @click.prevent="toggleMenuUser">
              <div class="c-img--cover c-img--round">
                <img src="/img/common/screen-top.jpg" alt="メニューアイコン">
              </div>
            </a>
          </li> -->
        </ul>
        <div class="header__search pc-only">
          <form
            class="l-flex"
            action="/search"
            method="GET"
          >
            <div class="header__search__text">
              <input
                class="c-input--gray"
                type="text"
                name="keyword"
                placeholder="キーワードを入力"
              >
            </div>
            <div class="header__search__submit">
              <button type="submit">
                検索
              </button>
            </div>
          </form>
        </div>
        <div class="header__icon pc-only">
          <ul class="l-flex">
            <li>
              <a href="/mypage/u/messages/">
                <img
                  src="/img/common/icon-chat-pink.png"
                  alt="チャットアイコン"
                >
                <span>チャット</span>
              </a>
            </li>
            <li>
              <a @click.prevent="toggleMenuUser">
                <img
                  src="/img/common/icon-header-menu-bold-pink.png"
                  alt="ハンバーガーメニュー"
                >
                <span>メニュー</span>
              </a>
            </li>
            <!-- <li class="humberger-menu">
                <input id="drawer-checkbox" type="checkbox">
                <label id="drawer-icon" @click.prevent="toggleMenuUser">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>
            </li> -->
            <!-- <li class="menu-profile">
              <a class="c-img--shadow" @click.prevent="toggleMenuUser">
                <div class="c-img--cover c-img--round">
                  <img :src="'/storage/profile/' + this.userImg" alt="メニューアイコン">
                </div>
              </a>
            </li> -->
          </ul>
        </div>
      </div>
    </div>
    <nav
      id="nav-global"
      class="sp-only"
      :class="{'open--nav':drawerActive}"
    >
      <div class="nav-global__back">
        <a @click="closeDrawer"><img src="/img/common/icon-nav-back.png"></a>
      </div>
      <!-- <ul class="nav-global__list">
        <li><a href="/">トップページ</a></li>
        <li><a href="/attendance-lessons">レッスン一覧</a></li>
        <li><a href="/teachers.php">講師一覧</a></li>
      </ul>
      <p class="c-sp-headline nav--title">ログイン情報</p>
      <ul class="nav-global__list">
        <li><a href="/mypage/u/attendance-lessons">受講予定レッスン</a></li>
        <li><a href="/mypage/u/taken-lessons">受講済みレッスン</a></li>
        <li><a href="/mypage/u/messages/">メッセージ</a></li>
        <li><a href="/mypage/u/profile/">プロフィール</a></li>
        <li><a href="/mypage/u/trade/">入出金管理</a></li>
        <li>
          <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
          <form id="logout-form" action="/logout" method="POST" style="display: none;">
              <input type="hidden" name="_token" v-bind:value="csrf">
          </form>
        </li>
      </ul>
      <p class="c-sp-headline nav--title">会社情報</p>
      <ul class="nav-global__list">
        <li><a href="/news.php">お知らせ</a></li>
        <li><a href="/company.php">会社概要</a></li>
        <li><a href="/contact-us.php">特定商取引法に基づく表記</a></li>
        <li><a href="/contact-us.php">運営にお問い合わせ</a></li>
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
      </ul> -->
      <ul class="nav-global__list">
        <li><a href="/mypage/u/change">講師向けメニューはこちら</a></li>
        <li><a href="/mypage/u/attendance-lessons">受講予定レッスン</a></li>
        <li><a href="/mypage/u/taken-lessons">受講済みレッスン</a></li>
        <li><a href="/mypage/u/messages/">メッセージ</a></li>
        <li><a href="/mypage/u/profile/">プロフィール</a></li>
        <li><a href="/lessons/">レッスン一覧</a></li>
        <li><a href="/teachers/">講師一覧</a></li>
        <li><a href="/faq-user">受講者よくある質問</a></li>
        <li><a href="/contact">お問い合わせ</a></li>
        <li>
          <a
            href="#"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
          >
            ログアウト
          </a>
          <form
            id="logout-form"
            action="/logout"
            method="POST"
            style="display: none;"
          >
            <input
              type="hidden"
              name="_token"
              :value="csrf"
            >
          </form>
        </li>
      </ul>
    </nav>
  </header>

</template>

<script>
	export default {
    props:  {
      csrf: {
        type: String,
        required: true,
      }
    },
		data() {
			return {
				drawerActive: false,
				searchShow: false,
				isMenuUser: false,
			}
		},
		methods: {

			// 検索画面を開く
			openSearch: function() {
				this.searchShow = !this.searchShow
			},
			// 検索画面を閉じる
			closeSearch: function() {
				this.searchShow = false
			},
			// ドロワーを開く
			openDrawer: function() {
				this.drawerActive = true
			},
			// ドロワーを閉じる
			closeDrawer: function() {
				this.drawerActive = false
			},
			// ユーザーメニューを開く
			toggleMenuUser: function() {
				this.isMenuUser = !this.isMenuUser
			},
		},
	}
</script>

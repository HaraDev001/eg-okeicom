
{{-- 検索モーダル --}}
<div class="l-overlay l-modal--search" @click="closeSearch" v-show="searchShow">
    <div class="l-modal--search__content" @click="stopEvent">
        <form action="">
            <div class="l-modal--search__input">
                <input class="c-input--gray" type="text">
            </div>
        </form>
    </div>
</div>
{{-- header --}}
<header id="header">
    <div class="l-flex">
        <div class="header__left l-flex l-v__center">
            <div class="header__logo">
                <a href="/">
                    <img class="sp-only" src="{{ asset('/img/okeicom-logo-square.png') }}">
                    <img class="pc-only" src="{{ asset('/img/okeicom-logo-side.png') }}">
                </a>
            </div>
            <nav class="header__menu pc-only">
                <ul class="l-flex">
                    <li><a href="{{ url('/lessons') }}">レッスン一覧</a></li>
                    <li><a href="{{ url('/teachers') }}">講師一覧</a></li>
                    <li><a href="">初めての方へ</a></li>
                    <li><a href="">講師登録ご希望の方へ</a></li>
                </ul>
            </nav>
        </div>
        <div class="header__right l-flex l-v__center">
            <ul class="header__icon l-flex l-v__bottom sp-only">
                <li>
                    <a @click="openSearch">
                        <img src="{{ asset('/img/icon-header-search-bold.png') }}" alt="検索アイコン">
                        <span>検索</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/sign-up') }}">
                        <img src="{{ asset('/img/icon-header-add-bold.png') }}" alt="登録アイコン">
                        <span>新規登録</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/login') }}">
                        <img src="{{ asset('/img/icon-header-login-bold.png') }}" alt="ログインアイコン">
                        <span>ログイン</span>
                    </a>
                </li>
                <li>
                    <a @click="openDrawer">
                        <img src="{{ asset('/img/icon-header-menu-bold.png') }}" alt="ハンバーガーメニューアイコン">
                        <span>メニュー</span>
                    </a>
                </li>
            </ul>
            <div class="header__search pc-only">
                <form class="l-flex" action="{{ route('search.index') }}" method="GET">
                    <div class="header__search__text">
                        <input class="c-input--gray" type="text" name="keyword" placeholder="キーワードを入力">
                    </div>
                    <div class="header__search__submit">
                        <input type="submit" value="検索">
                    </div>
                </form>
            </div>
            <div class="header__link pc-only">
                <ul class="l-flex">
                    <li class="header__link__register"><a href="{{ url('/sign-up') }}">新規登録</a></li>
                    <li class="header__link__login"><a href="{{ url('/login') }}">ログイン</a></li>
                </ul>
            </div>
        </div>
    </div>
    <nav id="nav-global" class="sp-only" :class="{'open--nav':drawerActive}">
        <div class="nav-global__back">
            <a @click='closeDrawer'><img src="{{ asset('/img/icon-nav-back.png') }}"></a>
        </div>
        <ul class="nav-global__list">
            <li><a href="/">トップページ</a></li>
            <li><a href="{{ url('/lessons/') }}">レッスン一覧</a></li>
            <li><a href="{{ url('/teachers/') }}">講師一覧</a></li>
        </ul>
        <p class="c-sp-headline nav--title">会社情報</p>
        <ul class="nav-global__list">
            <li><a href="{{ url('/news/') }}">お知らせ</a></li>
            {{-- <li><a href="{{ url('/flow/') }}">料金決済の流れ</a></li> --}}
            <li><a href="{{ url('/tokushoho/') }}">特定商取引法に基づく表記</a></li>
            <li><a href="{{ route('contact') }}">お問い合わせ</a></li>
        </ul>
        <p class="c-sp-headline nav--title">講師向け</p>
        <ul class="nav-global__list">
            <li><a href="{{ url('/terms-teacher/') }}">講師規約</a></li>
            <li><a href="{{ url('/cancel-teacher/') }}">講師キャンセルポリシー</a></li>
            <li><a href="{{ url('/faq-teacher/') }}">講師よくある質問</a></li>
        </ul>
        <p class="c-sp-headline nav--title">受講者向け</p>
        <ul class="nav-global__list">
            <li><a href="{{ url('/terms-user/') }}">受講者規約</a></li>
            <li><a href="{{ url('/cancel-user/') }}">受講者キャンセルポリシー</a></li>
            <li><a href="{{ url('/faq-user/') }}">受講者よくある質問</a></li>
        </ul>
    </nav>
</header>
<script src="{{ mix('js/app.js') }}"></script>
<script>
    const headerapp = new Vue({
        el: "#header",
		data(){
			return {
				// 検索窓を表示
				searchShow: false,
                drawerActive: false,
			}
		},
		methods: {
			// ドロワーを開く
			openDrawer: function() {
				this.drawerActive = true
			},
			// ドロワーを閉じる
			closeDrawer: function() {
				this.drawerActive = false
            },
			// 検索画面を開く
			openSearch: function() {
				this.searchShow = !this.searchShow
			},
			// 検索画面を閉じる
			closeSearch: function() {
				this.searchShow = false
			},
			clickEvent: function() {
				this.$emit('from-child')
			},
			stopEvent: function(){
                event.stopPropagation()
			},
		},
    });
</script>

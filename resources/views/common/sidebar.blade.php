<div id="sidebar">
	<div class="headline pc-only"><p>カテゴリー</p></div>
	<ul class="sidebar__list sp-only" v-if="isActiveCategory">
		<li class="selected"><a href="">全て</a></li>
		<li><a href="">家庭教師</a></li>
		<li><a href="">アート・デザイン</a></li>
		<li><a href="">語学</a></li>
		<li><a href="">家庭教師</a></li>
		<li><a href="">アート・デザイン</a></li>
		<li><a href="">語学</a></li>
		<li><a href="">家庭教師</a></li>
		<li><a href="">アート・デザイン</a></li>
		<li><a href="">語学</a></li>
	</ul>
	<ul class="sidebar__list pc-only" v-if="">
		<li class="selected"><a href="">全て</a></li>
		<li><a href="">家庭教師</a></li>
		<li><a href="">アート・デザイン</a></li>
		<li><a href="">語学</a></li>
		<li><a href="">家庭教師</a></li>
		<li><a href="">アート・デザイン</a></li>
		<li><a href="">語学</a></li>
		<li><a href="">家庭教師</a></li>
		<li><a href="">アート・デザイン</a></li>
		<li><a href="">語学</a></li>
	</ul>
	<div class="c-openButton sp-only">
		<a @click.prevent="swithActiveCategory">
			<span v-if="!isActiveCategory"><img src="{{ asset('/img/icon-arrow-down-blue.png') }}">全てのカテゴリー一覧を見る</span>
			<span class="close" v-else="!isActiveCategory">閉じる</span>
		</a>
	</div>
</div>
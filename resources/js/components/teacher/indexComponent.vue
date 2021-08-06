<template>
  <div>
    <div class="l-wrap--title">
      <div class="l-wrap">
        <h1 class="c-headline--screen">
          講師一覧
        </h1>
      </div>
    </div>
    <div class="l-wrap--body">
      <div class="l-wrap l-flex">
        <sidebar-component
          :categories="categories"
          :link="link"
          :selected_category="selectedCategory"
        />
        <!-- <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/resources/views/common/sidebar.php'); ?> -->
        <div class="l-wrap--main">
          <div class="l-contentList__list__headline l-flex">
            <div class="headlineContent info">
              <h2
                v-if="selected_category==''"
                class="title"
              >
                全てのカテゴリーから検索結果一覧を表示
              </h2>
              <h2
                v-else
                class="title"
              >
                {{ selected_category.name }}から検索結果一覧を表示
              </h2>
              <p class="number">
                {{ count }}件中 {{ start }}-{{ end }}件を表示
              </p>
            </div>
            <div class="headlineContent sort l-flex l-v__center">
              <span>並び替え</span>
              <div class="c-selectBox">
                <select
                  id="order"
                  class="c-input--gray"
                  onchange="chgOrder()"
                >
                  <option
                    v-if="order=='0'"
                    value="0"
                    selected
                  >
                    新着順
                  </option>
                  <option
                    v-else
                    value="0"
                  >
                    新着順
                  </option>
                  <option
                    v-if="order=='1'"
                    value="1"
                    selected
                  >
                    評価が高い順
                  </option>
                  <option
                    v-else
                    value="1"
                  >
                    評価が高い順
                  </option>
                </select>
              </div>
            </div>
          </div>
          <div class="l-list--teacher">
            <div class="l-list--teacher__tab three-tab">
              <a
                v-if="selected_category==''"
                :href="'/teachers'"
              >
                <div
                  v-if="sex==''"
                  class="tab-box selected"
                >
                  全て
                </div>
                <div
                  v-else
                  class="tab-box"
                >
                  全て
                </div>
              </a>
              <a
                v-else
                :href="'/teachers/category/'+selected_category.id"
              >
                <div
                  v-if="sex==''"
                  class="tab-box selected"
                >
                  全て
                </div>
                <div
                  v-else
                  class="tab-box"
                >
                  全て
                </div>
              </a>
              <a
                v-if="selected_category==''"
                :href="'/teachers?sex=1'"
              >
                <div
                  v-if="sex==1"
                  class="tab-box selected"
                >
                  男性
                </div>
                <div
                  v-else
                  class="tab-box"
                >
                  男性
                </div>
              </a>
              <a
                v-else
                :href="'/teachers/category/'+selected_category.id+'?sex=1'"
              >
                <div
                  v-if="sex==1"
                  class="tab-box selected"
                >
                  男性
                </div>
                <div
                  v-else
                  class="tab-box"
                >
                  男性
                </div>
              </a>
              <a
                v-if="selected_category==''"
                :href="'/teachers?sex=2'"
              >
                <div
                  v-if="sex==2"
                  class="tab-box selected"
                >
                  女性
                </div>
                <div
                  v-else
                  class="tab-box"
                >
                  女性
                </div>
              </a>
              <a
                v-else
                :href="'/teachers/category/'+selected_category.id+'?sex=2'"
              >
                <div
                  v-if="sex==2"
                  class="tab-box selected"
                >
                  女性
                </div>
                <div
                  v-else
                  class="tab-box"
                >
                  女性
                </div>
              </a>
            </div>
            <div
              v-for="(user, index) in users"
              :key="index"
              class="l-content--teacher l-flex"
            >
              <div class="u-w100">
                <div
                  v-if="user.img!=null"
                  class="c-img--round c-img--cover"
                >
                  <img :src="'/storage/courses/' + user.img">
                </div>
              </div>
              <div class="u-wflex1 u-pl10">
                <p class="u-text--big u-mb10">
                  <span
                    v-if="user.sex==1"
                    class="c-text--sex man u-mr10"
                  >
                    男性
                  </span>
                  <span
                    v-if="user.sex==2"
                    class="c-text--sex woman u-mr10"
                  >
                    女性
                  </span>
                  <a :href="'/teachers/detail/'+user.id">{{ user.name }}</a>
                </p>
                <div class="c-text--evaluation">
                  <div class="star">
                    <img src="/img/common/icon-star.png">
                    <span class="evaluation">{{ user.ave }}</span>
                  </div>
                  <p class="review">
                    レビュー {{ user.count }}件
                  </p>
                </div>
                <ul class="c-text--category u-mt10">
                  <li v-if="user.cat1!=null">{{ user.cat1 }}</li>
                  <li v-if="user.cat2!=null">{{ user.cat2 }}</li>
                  <li v-if="user.cat3!=null">{{ user.cat3 }}</li>
                  <li v-if="user.cat4!=null">{{ user.cat4 }}</li>
                  <li v-if="user.cat5!=null">{{ user.cat5 }}</li>
                </ul>
                <p class="u-text--sentence u-mt10 pc-only">
                  {{ user.profile }}
                </p>
              </div>
            </div>
          </div>
          <div class="l-pagenation">
            <ul class="l-pagenation__list">
              <li
                v-for="(i, index) in pageCnt"
                :key="index"
                :class="[i === page ? 'selected': '']"
              >
                <a
                  v-if="selected_category==''"
                  :href="'/teachers?sex=' + sex + '&page=' + i"
                >
                  {{ i }}
                </a>
                <a
                  v-else
                  :href="'/teachers/category/'+selected_category.id+'?sex=' + sex + '&page=' + i"
                >
                  {{ i }}
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
    import SidebarComponent from './../../components/common/sidebarComponent.vue'

	export default {
    components: {
      'sidebar-component': SidebarComponent,
    },

		props: {
      users: {
        type: Object,
        required: true
      },
      categories: {
        type: Array,
        required: true
      },
      count: {
        type: String,
        required: true
      },
      pager: {
        type: String,
        required: true
      },
      sex: {
        type: Number,
        required: true
      },
      selectedCategory: {
        type: Array,
        required: true
      },
      order: {
        type: Number,
        required: true
      },
      page: {
        type: Number,
        required: true
      },
      start: {
        type: Number,
        required: true
      },
      end: {
        type: Number,
        required: true
      },
      pageCnt: {
        type: Number,
        required: true
      },
    },
		data() {
			return {
        link: '/teachers/category/',
      };
		},
	}
</script>

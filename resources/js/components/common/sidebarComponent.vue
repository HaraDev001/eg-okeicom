<template>
  <div id="sidebar">
    <form :action="path">
      <input
        v-if="target"
        :value="target"
        type="hidden"
        name="is_target"
      >
      <div class="headline pc-only">
        <p>カテゴリーを選択</p>
      </div>
      <ul
        v-if="isActiveCategory"
        class="sidebar__list sp-only"
      >
        <li
          v-for="(category, index) in categories"
          :key="index"
        >
          <button
            :value="category.id"
            name="categoriesId"
          >
            {{ category.name }}
          </button>
        </li>
      </ul>
      <ul class="sidebar__list pc-only">
        <li
          v-for="(category, index) in categories"
          :key="index"
          :class="[ category.id == nowCategory ? 'selected' : '' ]"
        >
          <button
            name="categories_id"
            :value="category.id"
          >
            {{ category.name }}
          </button>
        </li>
      </ul>
      <div class="c-openButton sp-only">
        <a @click.prevent="toggleActiveCategory">
          <span v-if="!isActiveCategory"><img src="/img/common/icon-arrow-down-blue.png">全てのカテゴリー一覧を見る</span>
          <span
            v-else-if="isActiveCategory"
            class="close"
          >
            閉じる
          </span>
        </a>
      </div>
    </form>
  </div>
</template>

<script>
    export default {
      props: {
        categories: {
          type: Array,
          required: true
        },
        // categoriesId: {
        //   type: String,
        //   required: true
        // },
        path: {
          type: String,
          required: true
        },
        // target: {
        //   type: String,
        //   required: true
        // },
      },
		data(){
			return {
        isActiveCategory: false,
        nowCategory: this.categoriesId,
        target: ''
			}
		},
		// props: {
        //     categories: Array,
        //     selected_category: Array,
        //     link: String,
        // },
        mounted: function () {},
		methods: {
			// [SP] カテゴリー一覧を表示させる
			toggleActiveCategory: function() {
				this.isActiveCategory = !this.isActiveCategory;
      },
    },
	}
</script>

<template>
  <ul
    ref="categoryCheckbox"
    class="c-list--category"
  >
    <li
      v-for="category in categories"
      :key="category.id"
    >
      <!-- <input
        ref="targetCheckcbox"
        name="categories[]"
        type="checkbox"
        :checked="false"
        :value="index"
        @click="categorySubmit('target' + index)"
      > -->
      <input
        ref="targetCheckbox"
        name="categories[]"
        type="checkbox"
        :checked="false"
        :value="category.id"
        @click="categorySubmit(category.id)"
      >
      <label>
        {{ category.name }}
      </label>
    </li>
  </ul>
</template>
<script>
  export default {
    props: {
      course: {
        type: Object,
        required: false,
        default () {}
      },
      user: {
        type: Object,
        required: false,
        default () {}
      },
      categoryList: {
        type: Array,
        required: true,
      }
      // categories: {
      //   type: String,
      //   required: false,
      //   default: ''
      // },
    },
    emits: ['addCategory', 'reduceCategory'],
    data() {
      return {
        // props周り
        courseProp: this.course ?? '',
        userProp: this.user ?? '',
        // バリデーション カテゴリー確認
        checkbox: 0,
        categories: this.categoryList,
      }
    },
    mounted: function() {
      // [初期設定] コースの持つカテゴリーと同じカテゴリーをチェック
      let checkProp = ''
      if(this.courseProp) {
        checkProp = this.courseProp
      } else if(this.userProp) {
        checkProp = this.userProp
      }
      // カテゴリーの配列を取得する
      let checkArray = []
      for(let i = 1; i < 6; i++) {
        if(checkProp['category' + i + '_id'] !== null) {
          checkArray.push(checkProp['category' + i + '_id'])
        }
      }
      console.log(checkArray)

      // forEachから同じ値を設定する
      checkArray.forEach((id, value) => {
          this.$refs.targetCheckbox[id - 1]['checked'] = true
      })

      // console.log(checkProp['category1_id']);
      // const checkArray = checkProp.
      // if(checkProp) {
      //   for(let i = 0; i < this.categories.length; i++) {
      //     // checkboxのvalueを取得
      //     const checkTarget = this.$refs['target' + i];
      //     for(let t = 1; t < 6; t++) {
      //       const checkValidation = checkProp['category' + t + '_id'];
      //       console.log(checkValidation)
      //       if(checkTarget.value == checkValidation) {
      //         checkTarget.checked = true;
      //       }
      //     }
      //   }
      // }
    },
    methods: {
      categorySubmit: function(id) {
        // const vals = $('input[name~"categories"]:checked').map(function() {
        //     return $(this).val();
        // }).get();
        // if(this.$refs[ref]['checked']) {
        //   if (this.checkbox < 5) {
        //     this.checkbox += 1
        //     this.$emit("addCategory")
        //   } else {
        //     this.$refs[ref]['checked'] = false
        //   }
        // } else {
        //   this.$emit("reduceCategory")
        //   this.checkbox -= 1
        // }
        if(this.$refs.targetCheckbox[id - 1]['checked']) {
          if (this.checkbox < 5) {
            this.checkbox += 1
            this.$emit("addCategory")
          } else {
            this.$refs.targetCheckbox[id - 1]['checked'] = false
          }
        } else {
          this.$emit("reduceCategory")
          this.checkbox -= 1
        }
      }
    },
  }
</script>

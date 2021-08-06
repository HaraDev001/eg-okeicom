<template>
  <div class="c-lessonDetail__img l-flex">
    <div class="c-lessonDetail__img__thumb c-img--cover">
        <img class="fade-in-image" :src="'/storage/courses/' + thumbImage">
    </div>
    <ul class="c-lessonDetail__img__list">
      <!-- <li><img src="/storage/courses/'{{ thumbLists[0].img }}'"></li> -->
      <li
        v-for="(thumb, index) in thumbLists"
        :key="index"
        @click="changeThumb(index)"
      >
        <img
          v-if="!(thumb.img==null)"
          :src="'/storage/courses/' + thumb.img"
        >
      </li>
    </ul>
  </div>
</template>
<script>
	export default {
    components: {},
    props: {
      imgLists: {
        type: Object,
        required: true
      },
    },
		data: function() {
			return {
        thumbImage: this.imgLists['img1'],
        thumbLists: [
          { id: 0, img: this.imgLists['img1'] },
          { id: 1, img: this.imgLists['img2'] },
          { id: 2, img: this.imgLists['img3'] },
          { id: 3, img: this.imgLists['img4'] },
          { id: 4, img: this.imgLists['img5'] },
        ]
      }
		},
		created: function() {
			// 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義
    },
    mounted : function(){
    },
		methods: {
      changeThumb(index) {
        this.thumbImage = this.thumbLists[index]['img'];
      }
    },
	}
</script>

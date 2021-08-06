<template>
    <div class="teacher-course-add-lesson">
        <div class="c-button--add u-mb0">
            <a href="">レッスンを追加</a>
        </div>
        <div class="teacher-course-add-lesson-list">
            <div class="teacher-course-add-lesson-list-detail">
                <p class="date">2020-12-13　10:00-12:00</p>
                <p class="title">レッスンタイトルレッスンタイトルレッスンタイトル</p>
            </div>
            <div class="c-button--edit">
                <a class="c-button--edit--link delete">削除</a>
                <a class="c-button--edit--link edit">編集</a>
            </div>
        </div>
        <div class="teacher-course-add-lesson-list">
            <div class="teacher-course-add-lesson-list-detail">
                <p class="date">2020-12-13　10:00-12:00</p>
                <p class="title">レッスンタイトルレッスンタイトルレッスンタイトル</p>
            </div>
            <div class="c-button--edit">
                <a class="c-button--edit--link delete">削除</a>
                <a class="c-button--edit--link edit">編集</a>
            </div>
        </div>
        <div class="teacher-course-add-lesson-list">
            <div class="teacher-course-add-lesson-list-detail">
                <p class="date">2020-12-13　10:00-12:00</p>
                <p class="title">レッスンタイトルレッスンタイトルレッスンタイトル</p>
            </div>
            <div class="c-button--edit">
                <a class="c-button--edit--link delete">削除</a>
                <a class="c-button--edit--link edit">編集</a>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
        components: {},
        props: ['categorieslists', 'course'],
		data() {
            return {
                courseDate: this.course ?? '',
                categoriesDate: this.categorieslists ?? '',
                // バリデーション カテゴリー確認
                checkbox: 0,
            }
        },
		created: function() {},
        mounted: function () {
            // [初期設定] コースの持つカテゴリーと同じカテゴリーをチェック
            if(this.courseDate) {
                for(let i = 0; i < this.categoriesDate.length; i++) {
                    // checkboxのvalueを取得
                    const checkTarget = this.$refs['target' + i];
                    for(let t = 1; t < 6; t++) {
                        const checkValidation = this.courseDate['category' + t + '_id'];
                        if(checkTarget.value == checkValidation) {
                            checkTarget.checked = true;
                        }
                    }
                }
            }
        },
		computed: {
            // カテゴリーが5つ以上登録できないようにする
            checkCategoriesLimit: function() {},
            // カテゴリーのcheckedの数を数える
            checkedNumber: function() {

            }
        },
		methods: {
            categorySubmit: function(ref) {
                // const vals = $('input[name~"categories"]:checked').map(function() {
                //     return $(this).val();
                // }).get();
                if(this.$refs[ref]['checked']) {
                    this.$emit("addCategory")
                } else {
                    this.$emit("reduceCategory")
                }

            }
        },
    }
</script>

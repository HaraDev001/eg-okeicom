<template>
  <table>
    <thead>
      <tr>
        <td>コースタイトル<br>コースカテゴリー</td>
        <td>コース詳細</td>
        <td>講師名</td>
        <!-- <td /> -->
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(course, index) in courses"
        :key="index"
      >
        <td>
          <a
            :href="`/owner-admin/courses/detail/${course.id}`"
            class="u-text--link"
          >
            {{ course.title ? course.title : '' }}
          </a>
          <br>
          <span class="u-text--small u-color--grayNavy">
            {{ course.category1_name ? `${course.category1_name}` : '未設定' }}
            {{ course.category2_name ? `/ ${course.category2_name}` : '' }}
            {{ course.category3_name ? `/ ${course.category3_name}` : '' }}
            {{ course.category4_name ? `/ ${course.category4_name}` : '' }}
            {{ course.category5_name ? `/ ${course.category5_name}` : '' }}
          </span>
        </td>
        <td>{{ course.detail }}</td>
        <td>
          <a
            :href="`/owner-admin/users/edit/${course.user_id}`"
            class="u-text--link"
          >
            {{ course.user_name ? course.user_name : '' }}
          </a>
        </td>
        <!-- <td>
          <div class="c-button--edit">
            <a
              href=""
              class="c-button--edit--link delete"
            >
              削除
            </a>
            <a href="" class="c-button--edit--link edit">詳細</a>
          </div>
        </td> -->
      </tr>
    </tbody>
  </table>
</template>

<script>
  import axios from 'axios'
  import moment from "moment"

  export default {
    data() {
      return {
        // 出金一覧リクエスト一覧情報
        courses: [],
      }
    },
    created: function() {
      // 出金リクエスト一覧取得処理
      axios.get('/api/v1/courses', {})
        .then(result => {
          // 管理者の承認が実行されていない出金リクエストを取得する
          this.courses = result.data;
        })
        .catch(result => {
          console.log(result)
          alert('コース一覧取得時にエラーが発生しました。')
        })
    },
    methods: {
      // カスタマイズ：日付
      customDate: function(date) {
        return moment(date).format('YYYY/MM/DD HH:mm:SS')
      },
    },
  }
</script>


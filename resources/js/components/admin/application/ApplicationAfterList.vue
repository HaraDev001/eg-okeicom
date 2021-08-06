<template>
  <table>
    <thead>
      <tr>
        <td>申し込み日</td>
        <td>購入者</td>
        <td>金額</td>
        <td>レッスン</td>
        <!-- <td />  -->
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(application, index) in applications"
        :key="index"
      >
        <td>{{ application.created_at ? customDate(application.created_at) : '' }}</td>
        <td>{{ application.user_name }}</td>
        <td>{{ customPrice(application.price) }}</td>
        <td>{{ application.lesson_title }}</td>
        <!-- <td>
          <div class="c-button--edit">
            <a href="" class="c-button--edit--link delete">削除</a>
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
        applications: [],
      }
    },
    created: function() {
      // 出金リクエスト一覧取得処理
      axios.get('/api/v1/applications')
        .then(result => {
          // 管理者の承認が実行されていない出金リクエストを取得する
          this.applications = result.data.filter(date => {
            return date.status == 1;
          });
        })
        .catch(result => {
          console.log(result)
          alert('確定後の取引一覧取得時にエラーが発生しました。')
        })
    },
    methods: {
      // カスタマイズ：日付
      customDate: function(date) {
        return moment(date).format('YYYY/MM/DD HH:mm:SS')
      },
      // カスタマイズ：金額
      customPrice: function(price) {
        return `¥${Number(price).toLocaleString()}`
      },
    },
  }
</script>

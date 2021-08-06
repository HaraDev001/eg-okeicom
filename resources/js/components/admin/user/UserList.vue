<template>
  <table class="user-table">
    <thead>
      <tr>
        <td>アカウント名<br>お名前</td>
        <td>メールアドレス<br>電話番号</td>
        <td>性別 / カテゴリー<br>国籍 / 言語 / 都道府県</td>
        <td>プロフィール</td>
        <td />
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(user, index) in users"
        :key="index"
      >
        <td>{{ user.account ? user.account : '未設定' }}<br>{{ user.name ? user.name : '未設定' }}</td>
        <td>{{ user.tel ? user.tel : '未設定' }}<br>{{ user.email ? user.email : '未設定' }}</td>
        <td>
          <span v-if="user.sex === 0">不明</span>
          <span v-else-if="user.sex === 1">男性</span>
          <span v-else-if="user.sex === 2">女性</span>
          /
          {{ user.category1_name ? user.category1_name : '未設定' }}
          {{ user.category2_name ? user.category2_name : '' }}
          {{ user.category3_name ? user.category3_name : '' }}
          {{ user.category4_name ? user.category4_name : '' }}
          {{ user.category5_name ? user.category5_name : '' }}
          <br>
          {{ user.country_id ? user.country_id : '未設定' }} / {{ user.language_id ? user.language_id : '未設定' }} / {{ user.prefecture_id ? user.prefecture_id : '未設定' }}</td>
        <td>{{ user.profile ? user.profile : '未設定' }}</td>
        <td>
          <div class="c-button--edit">
            <button @click="deleteUser(user.id)" class="c-button--edit--link delete">削除</button>
            <a :href="`/owner-admin/users/edit/${user.id}`" class="c-button--edit--link edit">編集</a>
          </div>
        </td>
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
        // 出金履歴一覧情報
        users: [],
      }
    },
    created: function() {
      // 出金履歴一覧取得処理
      axios.get('/api/v1/users')
        .then(result => {
          // 管理者の承認が実行されていない出金リクエストを取得する
          this.users = result.data;
        })
        .catch(error => {
          console.log(error)
          alert('ユーザー一覧取得時にエラーが発生しました。')
        })
    },
    methods: {
      // カスタマイズ：日付
      customDate: function(date) {
        return moment(date).format('YYYY/MM/DD HH:mm:SS')
      },
      // ユーザー削除
      deleteUser: function(id) {
        axios.delete(`/api/v1/users/${id}`)
          .then(result => {
            alert(result.data)
            location.reload()
          })
          .catch(error => {
            alert('ユーザーの削除に失敗しました。')
            console.log(error)
          })
      }
    }
  }
</script>

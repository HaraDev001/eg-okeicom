<template>
  <table>
    <thead>
      <tr>
        <td>日時</td>
        <td>タイトル</td>
        <!-- <td>配信内容</td> -->
        <td />
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(announcement, index) in announcements"
        :key="index"
      >
        <td style="white-space: nowrap;">{{ customDate(announcement.created_at) }}</td>
        <td>
          <a
            :href="`/owner-admin/news/edit/${announcement.id}`"
            class="u-text--link"
          >
            {{ announcement.title }}
          </a>
        </td>
        <!-- 最初の100文字程度？ -->
        <!-- <td>{{ customSentence(announcement.detail) }}</td> -->
        <td>
          <div class="c-button--edit one-button">
            <a
              class="c-button--edit--link delete"
              @click="deleteAnnouncement(announcement.id)"
            >
              削除
            </a>
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
        // お知らせ一覧リクエスト一覧情報
        announcements: [],
      }
    },
    created: function() {
      // お知らせ一覧取得処理
      axios.get('/api/v1/announcements', {})
        .then(result => {
          this.announcements = result.data;
        })
        .catch(result => {
          console.log(result)
          alert('お知らせ一覧取得時にエラーが発生しました。')
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
      // カスタマイズ：文章
      customSentence: function(sentence) {
        return sentence.substr(0, 100)
      },
      // 管理者の振込完了処理
      deleteAnnouncement: function(id) {
        axios.delete(`/api/v1/announcements/${id}`)
          .then((response) => {
            alert('お知らせを削除しました。')
            location.reload()
            console.log(response)
          })
          .catch((error) => {
            alert('お知らせの削除に失敗しました')
            console.log(error)
          })
      },
    },
  }
</script>

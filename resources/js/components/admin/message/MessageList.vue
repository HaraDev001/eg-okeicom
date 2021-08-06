<template>
  <table>
    <thead>
      <tr>
        <td>送り先</td>
        <td>受け取り先</td>
        <td>メッセージ内容</td>
        <td />
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(message, index) in messages"
        :key="index"
      >
        <td style="white-space: nowrap;">
          <a
            :href="`/owner-admin/users/edit/${message.send_id}`"
            class="u-text--link"
          >
            {{ message.send_name ? message.send_name : '' }}
          </a>
        </td>
        <td style="white-space: nowrap;">
          <a
            :href="`/owner-admin/users/edit/${message.receive_id}`"
            class="u-text--link"
          >
            {{ message.receive_name ? message.receive_name : '' }}
          </a>
        </td>
        <td>{{ message.message_detail ? message.message_detail : '' }}</td>
        <!-- <td>
          <div class="c-button--edit">
            <a
              href=""
              class="c-button--edit--link delete"
            >削除</a>
          </div>
        </td> -->
      </tr>
    </tbody>
  </table>
</template>


<script>
  import axios from 'axios'

  export default {
    data() {
      return {
        // 出金一覧リクエスト一覧情報
        messages: [],
      }
    },
    created: function() {
      // メッセージ一覧取得処理
      axios.get('/api/v1/messages')
        .then(result => {
          this.messages = result.data;
        })
        .catch(result => {
          console.log(result)
          alert('メッセージ一覧取得時にエラーが発生しました。')
        })
    },
  }
</script>

<template>
  <table class="withdraw-request-table">
    <thead>
      <tr>
        <td>出金リクエスト日時<br>出金完了日</td>
        <td>アカウント</td>
        <td>振込先銀行名<br>その他銀行情報</td>
        <td>振込金額<br>リクエスト金額 / 手数料</td>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(withdrawal, index) in withdrawalHistories"
        :key="index"
      >
        <td>{{ customDate(withdrawal.created_at) }}<br>{{ customDate(withdrawal.verified_at) }}</td>
        <td>
          <a
            :href="`/owner-admin/users/edit/${withdrawal.user_id}`"
            class="u-text--link"
          >
            {{ withdrawal.user_account }}
          </a>
        </td>
        <td>
          {{ withdrawal.bank_type == 'japan' ? 'ゆうちょ銀行' : withdrawal.financial_name }}
          <br>
          {{ withdrawal.japan_mark ? withdrawal.japan_mark : '' }}
          {{ withdrawal.financial_name ? withdrawal.financial_name : '' }}
          {{ withdrawal.branch_name ? withdrawal.branch_name : '' }}
          {{ withdrawal.branch_number ? withdrawal.branch_number : '' }}
        </td>
        <td style="white-space: nowrap;">{{ customPrice(withdrawal.amount - withdrawal.fee) }}<br>{{ customPrice(withdrawal.amount) }} / {{ customPrice(withdrawal.fee) }}</td>
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
        withdrawalHistories: [],
      }
    },
    created: function() {
      // 出金履歴一覧取得処理
      axios.get('/api/v1/withdrawals', {})
        .then(result => {
          // 管理者の承認が実行されていない出金リクエストを取得する
          this.withdrawalHistories =  result.data.filter(function(date) {
              return date.verified_at !== null;
          });
        })
        .catch(error => {
          console.log(error)
          alert('出金履歴一覧取得時にエラーが発生しました。')
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
    }
  }
</script>

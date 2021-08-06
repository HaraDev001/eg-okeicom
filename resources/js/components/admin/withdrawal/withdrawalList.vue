<template>
  <table class="withdraw-request-table">
    <thead>
      <tr>
        <td>出金リクエスト日時</td>
        <td>ユーザー</td>
        <td>振込先銀行名<br>その他情報</td>
        <td>リクエスト金額<br>金額 / 手数料</td>
        <td />
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(withdrawal, index) in withdrawals"
        :key="index"
      >
        <td>{{ customDate(withdrawal.created_at) }}</td>
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
          {{ withdrawal.branch_number ? withdrawal.branch_number : '' }}</td>
        <td style="white-space: nowrap;">
          {{ customPrice(withdrawal.amount - withdrawal.fee) }}
          <br>
          {{ customPrice(withdrawal.amount) }} / {{ customPrice(withdrawal.fee) }}
        </td>
        <td>
          <div class="c-button--edit">
            <button
              class="c-button--edit--link delete"
              @click="verifiedButton(withdrawal.id)"
            >
              完了
            </button>
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
  components: {
  },
  data() {
    return {
      // 出金一覧リクエスト一覧情報
      withdrawals: [],
    }
  },
  created: function() {
    axios.get('/api/v1/withdrawals')
      .then(result => {
        // 出金リクエスト
        this.withdrawals =  result.data.filter(function(date) {
            return date.verified_at == null;
        });
      })
      .catch(result => {
        console.log(result)
        alert('出金リクエスト一覧取得時にエラーが発生しました。')
      })
    },
    methods: {
      verifiedButton: function(id) {
        axios.put(`/api/v1/withdrawals/${id}`)
          .then((response) => {
            alert('出金リクエストが完了しました。')
            location.reload()
            console.log(response)
          })
          .catch((error) => {
            alert('出金リクエストにエラーが発生しました。')
            console.log(error)
          })
      },

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

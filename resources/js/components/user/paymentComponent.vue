<template>
  <!--
  <div class="l-content--detail">
    <div class="c-headline--block">決済方法</div>
    <div class="l-content--detail__inner">
      <ul>
          <li class="u-mb20">
              <div class="c-checkbox--fashonable">
                  <label>登録済み銀行口座にリクエスト
                      <input type="radio" name="how" @change="changeTab('1')" :checked="true">
                      <div class="color-box"></div>
                  </label>
              </div>
          </li>
          <li>
              <div class="c-checkbox--fashonable">
                  <label>その他銀行にリクエスト
                      <input type="radio" name="how" @change="changeTab('2')">
                      <div class="color-box"></div>
                  </label>
              </div>
          </li>
      </ul>
    </div>
  </div>
  -->
  <div class="l-content--detail">
    <div class="c-headline--block">
      振込先情報
    </div>
    <!--
    <div class="l-content--detail__inner" v-if="isBarTab === '1'">
        <div class="l-content--input">
            <p class="l-content--input__headline">口座番号</p>
            <p>ゆうちょ（末尾：5452）</p>
        </div>
    </div>
    <div class="l-content--detail__inner" v-if="isBarTab === '2'">
    -->
    <div class="l-content--detail__inner">
      <div class="c-button--tab two-tab">
        <div class="c-button--tab--inner">
          <div
            class="c-button--tab--box"
            :class="{'selected': isBarTab === 'japan'}"
            @click.prevent="changeTab('japan')"
          >
            ゆうちょ
          </div>
          <div
            class="c-button--tab--box"
            :class="{'selected': isBarTab === 'other'}"
            @click.prevent="changeTab('other')"
          >
            その他
          </div>
        </div>
      </div>
      <div
        v-if="isBarTab === 'japan'"
        class="l-content--panel"
      >
        <div class="l-content--input">
          <p class="l-content--input__headline">
            口座記号
          </p>
          <input
            v-model="bank.yuchoMark"
            type="text"
            name="yucho_mark"
            placeholder="12345"
            required="required"
          >
        </div>
        <div class="l-content--input">
          <p class="l-content--input__headline">
            口座番号
          </p>
          <input
            v-model="bank.yuchoNumber"
            type="text"
            name="yucho_number"
            placeholder="1234567"
            required="required"
          >
        </div>
        <div class="l-content--input">
          <p class="l-content--input__headline">
            口座名義人
          </p>
          <input
            v-model="bank.yuchoName"
            type="text"
            name="yucho_name"
            placeholder="ヤマダタロウ（全角カタカナ）"
            required="required"
          >
        </div>
      </div>
      <div
        v-else-if="isBarTab === 'other'"
        class="l-content--panel"
      >
        <div class="l-content--input">
          <p class="l-content--input__headline">
            金融機関名
          </p>
          <input
            v-model="bank.financialName"
            type="text"
            name="other_financial_name"
            placeholder="金融機関名を入力"
            required="required"
          >
        </div>
        <div class="l-content--input u-w50per">
          <p class="l-content--input__headline">
            支店名
          </p>
          <input
            v-model="bank.branchName"
            type="text"
            name="other_branch_name"
            placeholder="支店名を入力"
            required="required"
          >
        </div>
        <div class="l-content--input u-w50per">
          <p class="l-content--input__headline">
            支店番号
          </p>
          <input
            v-model="bank.branchNumber"
            type="text"
            name="other_branch_number"
            placeholder="000"
            required="required"
          >
        </div>
        <div class="l-content--input u-w50per">
          <p class="l-content--input__headline">
            預金種目
          </p>
          <div class="c-selectBox">
            <select
              v-model="bank.otherType"
              name="other_type"
              required="required"
            >
              <option value="0">
                普通
              </option>
              <option value="1">
                当座
              </option>
            </select>
          </div>
        </div>
        <div class="l-content--input">
          <p class="l-content--input__headline">
            口座番号
          </p>
          <input
            v-model="bank.otherNumber"
            type="text"
            name="other_number"
            placeholder="1234567"
            required="required"
          >
        </div>
        <div class="l-content--input">
          <p class="l-content--input__headline">
            口座名義人
          </p>
          <input
            v-model="bank.otherName"
            type="text"
            name="other_name"
            placeholder="ヤマダタロウ（全角カタカナ）"
            required="required"
          >
        </div>
      </div>
    </div>
  </div>
</template>
<script>
	export default {
    props: {
      bankDate: {
        type: Object,
        required: false,
        default: () => ({})
      },
      old: {
        type: Object,
        required: false,
        default: () => ({})
      },
    },
		data() {
			return {
        bank: {
          yuchoMark: this.old.yucho_mark ?? '',
          yuchoNumber: this.old.yucho_number ?? '',
          yuchoName: this.old.yucho_name ?? '',
          financialName: this.old.other_financial_name ?? '',
          branchName: this.old.other_branch_name ?? '',
          branchNumber: this.old.other_branch_number ?? '',
          otherType: this.old.other_type ?? 0,
          otherNumber: this.old.other_number ?? '',
          otherName: this.old.other_name ?? '',
        },
        isBarTab: this.old.bankDate ?? 'japan',
        banktype: this.old.bankDate ?? 'japan',
			}
		},
		created: function() {
      // 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義
      if(this.bankDate.type === 'japan') {
          this.isBarTab = 'japan',
          this.banktype = 'japan',
          this.bank.yuchoMark = this.bankDate.japan_mark ?? ''
          this.bank.yuchoNumber = this.bankDate.number ?? ''
          this.bank.yuchoName = this.bankDate.name ?? ''
      } else if(this.bankDate.type === 'other') {
          this.isBarTab = 'other',
          this.banktype = 'other',
          this.bank.financialName = this.bankDate.financial_name ?? ''
          this.bank.branchName = this.bankDate.branch_name ?? ''
          this.bank.branchNumber = this.bankDate.branch_number ?? ''
          this.bank.otherType = this.bankDate.other_type ?? ''
          this.bank.otherNumber = this.bankDate.number ?? ''
          this.bank.otherName = this.bankDate.name ?? ''
      }
		},
		methods: {
			// 講師詳細：
			changeTab: function(type){
				this.isBarTab = type
			},
		},
	}
</script>

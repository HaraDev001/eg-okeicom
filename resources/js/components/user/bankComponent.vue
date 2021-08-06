<template>
  <div>
    <div class="c-button--tab top-tab two-tab">
      <div class="c-button--tab--inner u-w400_pc">
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
    <!-- tab：ゆうちょ -->
    <div
      v-if="isBarTab === 'japan'"
      class="c-list--table"
    >
      <!-- <div class="c-list--tr">
        <div class="c-list--th">
          <p class="main">振込方法</p>
        </div>
        <div class="c-list--td">
          <ul>
            <li class="u-mb10">
              <div class="c-checkbox--fashonable">
                <label>支店名
                  <input type="radio" name="how">
                  <div class="color-box"></div>
                </label>
              </div>
            </li>
            <li>
              <div class="c-checkbox--fashonable">
                <label>記号番号
                  <input type="radio" name="how">
                  <div class="color-box"></div>
                </label>
              </div>
            </li>
          </ul>
        </div>
      </div> -->
      <div class="c-list--tr">
        <div class="c-list--th">
          <p class="main">
            口座記号
          </p>
        </div>
        <div class="c-list--td">
          <input
            v-model="bank.yuchoMark"
            class="u-w300_pc"
            type="number"
            name="yucho_mark"
            placeholder="12345"
            required="required"
          >
        </div>
      </div>
      <div class="c-list--tr">
        <div class="c-list--th">
          <p class="main">
            口座番号
          </p>
        </div>
        <div class="c-list--td">
          <input
            v-model="bank.yuchoNumber"
            class="u-w300_pc"
            type="number"
            name="yucho_number"
            placeholder="1234567"
            required="required"
          >
        </div>
      </div>
      <div class="c-list--tr">
        <div class="c-list--th">
          <p class="main">
            口座名義人
          </p>
        </div>
        <div class="c-list--td">
          <input
            v-model="bank.yuchoName"
            class="u-w300_pc"
            type="text"
            name="yucho_name"
            placeholder="ヤマダタロウ（全角カタカナ）"
            required="required"
          >
        </div>
      </div>
      <!-- <div class="c-list--tr">
        <div class="c-list--th">
          <p class="main">セキュリティコード</p>
        </div>
        <div class="c-list--td">
          <input type="" name="" class="c-input--fixed" disabled value="aaaa">
        </div>
      </div> -->
      <!-- <div class="c-list--tr">
        <div class="c-list--th">
          <p class="main">メインにする</p>
        </div>
        <div class="c-list--td">
          <input type="checkbox" name="">
        </div>
      </div> -->
      <div class="l-button--submit u-pb20_sp">
        <button
          type="submit"
          class="c-button--square__pink"
        >
          変更内容を保存する
        </button>
      </div>
    </div>
    <!-- tab：その他 -->
    <div
      v-else-if="isBarTab === 'other'"
      class="c-list--table"
    >
      <div class="c-list--tr">
        <div class="c-list--th">
          <p class="main">
            金融機関名
          </p>
        </div>
        <div class="c-list--td">
          <input
            v-model="bank.financialName"
            class="u-w300_pc"
            type="text"
            name="other_financial_name"
            placeholder="金融機関名を入力"
            required="required"
          >
        </div>
      </div>
      <div class="c-list--tr">
        <div class="c-list--th">
          <p class="main">
            支店名
          </p>
        </div>
        <div class="c-list--td">
          <input
            v-model="bank.branchName"
            class="u-w300_pc"
            type="text"
            name="other_branch_name"
            placeholder="支店名を入力"
            required="required"
          >
        </div>
      </div>
      <div class="c-list--tr">
        <div class="c-list--th">
          <p class="main">
            支店番号
          </p>
        </div>
        <div class="c-list--td">
          <input
            v-model="bank.branchNumber"
            class="u-w300_pc"
            type="number"
            name="other_branch_number"
            placeholder="000"
            required="required"
          >
        </div>
      </div>
      <div class="c-list--tr">
        <div class="c-list--th">
          <p class="main">
            預金種目
          </p>
        </div>
        <div class="c-list--td">
          <div class="c-selectBox u-w100">
            <!-- <select name="other_type" v-model="banktype" required="required"> -->
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
      </div>
      <div class="c-list--tr">
        <div class="c-list--th">
          <p class="main">
            口座番号
          </p>
        </div>
        <div class="c-list--td">
          <input
            v-model="bank.otherNumber"
            class="u-w300_pc"
            type="number"
            name="other_number"
            placeholder="1234567"
            required="required"
          >
        </div>
      </div>
      <div class="c-list--tr">
        <div class="c-list--th">
          <p class="main">
            口座名義人
          </p>
        </div>
        <div class="c-list--td">
          <input
            v-model="bank.otherName"
            class="u-w300_pc"
            type="text"
            name="other_name"
            placeholder="ヤマダタロウ（全角カタカナ）"
            required="required"
          >
        </div>
      </div>
      <!-- <div class="c-list--tr">
        <div class="c-list--th">
          <p class="main">セキュリティコード</p>
        </div>
        <div class="c-list--td">
          <input type="" name="" class="c-input--fixed" disabled value="aaaa">
        </div>
      </div> -->
      <!-- <div class="c-list--tr">
        <div class="c-list--th">
          <p class="main">メインにする</p>
        </div>
        <div class="c-list--td">
          <input type="checkbox" name="">
        </div>
      </div> -->
      <div class="l-button--submit u-pb20_sp">
        <button
          type="submit"
          class="c-button--square__pink"
        >
          変更内容を保存する
        </button>
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
    created: function () {
      // if(this.old.yucho_mark) {
      //   this.isBarTab = 'japan'
      // } else if(this.old.other_financial_name) {
      //   this.isBarTab = 'other'
      // }
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
			changeTab: function(type){
				this.isBarTab = type
			},
		},
	}
</script>

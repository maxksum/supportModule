
import Vue from 'vue'
import axios from 'axios'

if (process.env.MIX_LOCAL == false) {
  Vue.config.devtools = false;
  Vue.config.debug = false;
  Vue.config.silent = true;
}

const Admin = new Vue({
  el: "#adminapp",
  data: {
    withdraws: {},
    deposits: {},
    sumwithdraws: [],
    sumdeposits: [],
    useroperations: {},
    useractions: {},
    productoperations: {},
  },
  components: {
    'pagination': require('laravel-vue-pagination'),
    'withdraw-row': require('./components/admin/WithdrawRow.vue'),
    'deposit-row': require('./components/admin/DepositRow.vue'),
    'user-operations-row': require('./components/admin/UserOperationsRow.vue'),
    'user-actions-row': require('./components/admin/UserActionsRow.vue'),
    'product-operations-row': require('./components/admin/ProductOperationsRow.vue'),
  },

	created() {
		// Fetch initial results
    if (typeof sumwithdraws !== 'undefined') {
      this.sumwithdraws = sumwithdraws;
      this.getWithdraws();
    }
    if (typeof sumdeposits !== 'undefined') {
      this.sumdeposits = sumdeposits;
      this.getDeposits();

    }
    if (typeof useroperations !== 'undefined') {
      this.useroperations = useroperations;
      this.getUserOperations();
    }
    if (typeof useractions !== 'undefined') {
      this.useractions = useractions;
      this.getUserActions();
    }
    if (typeof productoperations !== 'undefined') {
      this.productoperations = productoperations;
      this.getProductOperations();
    }
	},

  methods: {
    getWithdraws(page = 1) {
			axios.get('/admin/adminpaginate?withdraws_page=' + page)
				.then(response => {
					this.withdraws = response.data;
				});
		},
    getDeposits(page = 1) {
			axios.get('/admin/adminpaginate?deposits_page=' + page)
				.then(response => {
					this.deposits = response.data;
				});
		},
    getUserOperations(page = 1) {
			axios.get('/admin/adminpaginate?useroperations_page=' + page, {
        params: {
            id: user_id,
          }
        })
				.then(response => {
					this.useroperations = response.data;
				});
		},
    getUserActions(page = 1) {
			axios.get('/admin/adminpaginate?useractions_page=' + page, {
        params: {
            id: user_id,
          }
        })
				.then(response => {
					this.useractions = response.data;
				});
		},
    getProductOperations(page = 1) {
			axios.get('/admin/adminpaginate?product_operations_page=' + page, {
        params: {
            id: product_id,
          }
        })
				.then(response => {
					this.productoperations = response.data;
				});
		},
    replace(text) {
      var mas = text.split(' > ');
      if (mas != []) {
        if (mas[0] == "�� ����������") {
          return 'UNBAN > BAN';
        }
        else if (mas[0] == "����������") {
          return 'BAN > UNBAN';
        }
      }
      return text;
    }
  },
  computed: {

  }
});

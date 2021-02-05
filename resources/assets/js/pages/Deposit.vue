<template lang="html">
  <div id="deposit_block">
  <div id="wrapper" class="donate_wrap">
		<div class="donate_block">
			<div class="donate_text">
				<div class="text">
					АКЦИЯ! ПОЛУЧИ +50% ПРИ ПЕРВОМ ПОПОЛНЕНИИ БАЛАНСА
				</div>
			</div>

			<div class="donate_form">
				<div class="title">Пополнить баланс деньгами:</div>
        <form>
  				<div class="item">
  					<input type="text" id="donate_points" name="" v-model.number="points" step="250"/>
  				</div>
  				<label>за</label>
  				<div class="val">{{money}} RUB</div>
  				<div class="item">
  					<input type="submit" id="" name="" value="ПОПОЛНИТЬ" v-on:click="donate"/>
  				</div>
  			</form>
				<ul class="option_links">
					<li class="active"><img src="/images/ico-d-1.png"></li>
					<li><img src="/images/ico-d-2.png"></li>
					<li><img src="/images/ico-d-3.png"></li>
					<li><img src="/images/ico-d-4.png"></li>
					<li><img src="/images/ico-d-5.png"></li>
					<a class="more_donate_links">Еще</a>
				</ul>
			</div>

			<div class="donate_img"></div>

			<div class="donate_item_option">
				<div class="title">или игровыми предметами</div>
				<a href="/items/deposit" onClick="return false;" class="opt_donate_btn opt_go_btn">
					<span>Пополнить баланс</span>
					<p>ИГРОВЫМИ ПРЕДМЕТАМИ</p>
				</a>
			</div>
		</div>
	</div>
  <div id="wrapper" class="bank_page">
    <div class="bank_top_block" v-if="user">
      <div class="title">ПОПОЛНЕНИЕ ПРЕДМЕТАМИ</div>
      <div class="link">Введите свою ссылку на обмен в настройках<a onclick="tradeGame()">Trade Link</a></div>
    </div>

    <div class="bank_bottom_block">
      <div class="bank_items">
        <div class="bank_items_inner" v-if="active_items.length && active_items.length > 0">
          <steam-item v-for="(item, index) in active_items" :item="item" :key="index" :clickmethod="itemClick"></steam-item>
        </div>
        <div class="bank_items_inner" v-else>
          Предметы отсутствуют
        </div>

        <div class="pagination">
          <ul>
            <li><div class="pages">Страница <span>{{current_page}}</span> из <span>{{max_page}}</span></div></li>
            <li><a href="/" v-if="current_page > 1" v-on:click="prevPage"><</a></li>
            <li><a href="/" v-if="current_page < max_page" v-on:click="nextPage">></a></li>
          </ul>
        </div>
      </div>

      <div class="bank_deal">
        <div class="title">Общая сумма пополнения: <span>{{Math.floor(selected_sum / money_multiplier)}}</span></div>
        <div class="bank_deal_items">
          <div class="item" v-for="item in selected_items">
            <div class="name">{{item.name}}</div>
            <div class="count"><span>{{Math.floor(item.price / money_multiplier)}}</span></div>
            <a v-on:click="itemClick(item)" class="delete"></a>
          </div>
        </div>
        <a v-on:click="deposit" class="go_deal" v-if="user">ПОДТВЕРДИТЬ ПОПОЛНЕНИЕ</a>
      </div>
    </div>

    <div class="history_bank_block" v-if="user">
      <div class="title">ПОСЛЕДНИЕ ОБМЕНЫ</div>
      <div class="info">Самые свежие произведенные обмены</div>
      <div class="head">
        <div class="item">#</div>
        <div class="item">Дата</div>
        <div class="item">Сумма</div>
        <div class="item">Статус</div>
        <div class="item">Предметов</div>
      </div>
      <div class="body" v-for="trade in trades">
        <div class="inner">
          <div class="item">{{trade.tid}}</div>
          <div class="item">{{trade.created_at}}</div>
          <div class="item">{{Math.floor(trade.cost / money_multiplier)}}</div>
          <div class="item"><span v-bind:class="{'complete': trade.status == 1, 'canceled': trade.status == -1, 'process': trade.status == 0}">{{trade.status == 1 ? 'Обмен выполнен': trade.status == -1 ? 'Обмен отменен': 'Обмен в процессе'}}</span></div>
          <div class="item">{{trade.amount}}</div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import SteamItem from '../components/SteamItem.vue';
import Vue from 'vue';

export default {
  data: function() {
    return {
      money: 15,
      points: 250,
      items: items,
      trades: trades,
      active_items: [],
      current_page: 1,
      per_page: 9,
      max_page: 0,
      selected_items: [],
      selected_sum: 0,
      sending: false,
      user: user,
      deposit_popup: null,
      money_multiplier: money_multiplier
    };
  },
  watch: {
    money: function(val) {
      this.points = Math.round((val / 60 * 100) * 100) / 100;
    },
    points: function(val) {
      this.money = Math.round((val / 100 * 60) * 100) / 100;
    }
  },
  created() {
    this.deposit_popup = new Vue({
      el: "#popup",
      data: {
        link: trade_link,
      },
      methods: {
        saveTrade: function(e) {
          e.preventDefault();
          var self = this;
          $.post("/user/tradelink", {
            tradelink: self.link
          }, function(data) {
            alert(data.message);
            if (!data.error) {
              closeGame();
            }
          })
        }
      }
    });
    if (this.items.error) {
      alert(this.items.message);
      this.$set(this, 'items', []);
    }
    var temp = this;
    this.items.forEach(function(el, index) {
      temp.items[index].selected = false;
    });
    this.$set(this, 'active_items', this.items.slice((this.current_page - 1) * this.per_page, this.per_page));
    this.max_page = Math.ceil(this.items.length / 9);
    if (this.max_page == 0) {
      this.max_page = 1;
    }
  },
  components: {
    SteamItem,
  },
  methods: {
    donate: function(e) {
      e.preventDefault();
      if (Math.ceil(this.money) < 10) {
        alert("Минимальная сумма пополнения - 10 RUB");
        return;
      }
      window.open('/payment/intelmoney?sum=' + Math.ceil(this.money), '_blank');
    },
    prevPage: function(e) {
      e.preventDefault();
      this.current_page--;
      this.$set(this, 'active_items', this.items.slice((this.current_page - 1) * this.per_page, this.per_page * this.current_page));
    },
    nextPage: function(e) {
      e.preventDefault();
      this.current_page++;
      this.$set(this, 'active_items', this.items.slice((this.current_page - 1) * this.per_page, this.per_page * this.current_page));
    },
    itemClick: function(item) {
      item.selected = !item.selected;
      var index = this.items.findIndex(function(el) {
        return el.id == item.id;
      });
      if (index > -1) {
        this.items[index2] = Object.assign({}, item);
      }
      var index2 = this.active_items.findIndex(function(el) {
        return el.id == item.id;
      });
      if (index2 > -1) {
        this.active_items[index2] = Object.assign({}, item);
      }

      if (item.selected) {
        this.$set(this.selected_items, this.selected_items.length, item);
        this.selected_sum += item.price;
      } else {
        this.selected_items = this.selected_items.filter(function(el) {
          return el.id != item.id;
        });
        this.selected_sum -= item.price;
      }
    },
    deposit: function(e) {
      e.preventDefault();
      var items = this.selected_items;
      if (items.length == 0) {
        alert("Вы не выбрали предметов");
        return;
      }
      if (!this.sending) {
        this.sending = true;
        var self = this;
        $.post("/items/deposit", {
            items: items
          })
          .done(function(data) {
            if (data.error) {
              alert(data.message);
              self.sending = false;
            } else {
              self.selected_items = [];
              self.selected_sum = 0;
              self.items.forEach(function(el, index) {
                el.selected = false;
                self.items[index] = Object.assign({}, el);
              });
              self.active_items.forEach(function(el, index) {
                el.selected = false;
                self.active_items[index] = Object.assign({}, el);
              });
              self.sending = false;
              $("#trade_href").attr("href", 'https://steamcommunity.com/tradeoffer/' + data.trade.tid + '/');
              tradeOption();
            }
          });
      }
    },
  }
}
</script>

<style lang="css">
</style>

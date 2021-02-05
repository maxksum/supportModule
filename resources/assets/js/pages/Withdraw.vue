<template lang="html">
  <div id="withdraw_block">
    <div id="wrapper" class="bank_page">
  		<div class="bank_top_block" v-if="user">
  			<div class="title">ВЫВОД ПРЕДМЕТОВ</div>
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
  				<div class="title">Общая сумма вывода: <span>{{Math.floor(selected_sum / money_multiplier)}}</span></div>
  				<div class="bank_deal_items">
  					<div class="item" v-for="item in selected_items">
  						<div class="name">{{item.name}}</div>
  						<div class="count"><span>{{Math.floor(item.price / money_multiplier)}}</span></div>
  						<a v-on:click="itemClick(item)" class="delete"></a>
  					</div>
  				</div>
  				<a v-on:click="withdraw" class="go_deal" v-if="user">ПОДТВЕРДИТЬ ВЫВОД ПРЕДМЕТОВ</a>
  			</div>
  		</div>

        <div class="history_bank_block" v-if="user">
    			<div class="title">ПОСЛЕДНИЕ ВЫВОДЫ</div>
    			<div class="info">Самые свежие произведенные выводы</div>
    			<div class="head">
    				<div class="item">#</div>
    				<div class="item">Дата</div>
    				<div class="item">Сумма</div>
            <div class="item">Статус</div>
    				<div class="item"></div>
    			</div>
    			<div class="body" v-for="withdraw in withdraws">
    				<div class="inner">
    					<div class="item">{{withdraw.id}}</div>
    					<div class="item">{{withdraw.created_at}}</div>
    					<div class="item">{{Math.floor(withdraw.sum / money_multiplier)}}</div>
              <div class="item"><span v-bind:class="{'complete': withdraw.state == 2, 'canceled': withdraw.state == -1, 'process': withdraw.state == 0, 'process': withdraw.status == 1, 'process': withdraw.status == 3}">{{withdraw.state == 2 ? 'Вывод завершен': withdraw.state == -1 ? 'Вывод отменен': withdraw.state == 1 ? 'Обмен отправлен' : withdraw.state == 0 ? 'В рассмотрении' : 'В софт-отделе'}}</span></div>
    					<div class="item"><a v-if="withdraw.state == 0 || withdraw.state == 3" v-on:click="cancelWithdraw(withdraw.id)">Отменить</a></div>
    				</div>
    			</div>
    		</div>

        <div class="history_bank_block">
    			<div class="title">ПОСЛЕДНИЕ ОБМЕНЫ</div>
    			<div class="info">Самые свежие произведенные обмены</div>
    			<div class="head">
    				<div class="item">#</div>
    				<div class="item">Дата</div>
    				<div class="item">Сумма</div>
    				<div class="item">Статус</div>
            <div class="item">Вывод</div>
    			</div>
    			<div class="body" v-for="trade in trades">
    				<div class="inner">
    					<div class="item">{{trade.tid}}</div>
    					<div class="item">{{trade.created_at}}</div>
    					<div class="item">{{Math.floor(trade.cost / money_multiplier)}}</div>
    					<div class="item"><span v-bind:class="{'complete': trade.status == 1, 'canceled': trade.status == -1, 'process': trade.status == 0}">{{trade.status == 1 ? 'Обмен выполнен': trade.status == -1 ? 'Обмен отменен': 'Обмен в процессе'}}</span></div>
              <div class="item">{{trade.withdraw_id}}</div>
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
      items: items,
      trades: trades,
      withdraws: withdraws,
      active_items: [],
      current_page: 1,
      per_page: 9,
      max_page: 0,
      selected_items: [],
      selected_sum: 0,
      sending: false,
      user: user,
      withdraw_popup: null,
      money_multiplier: money_multiplier
    };
  },
  created() {
    this.withdraw_popup = new Vue({
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
    SteamItem
  },
  methods: {
    cancelWithdraw: function(id, e) {
      $.get("/items/withdraw" + id + "/cancel", function (data) {
        alert(data.message);
        if (data.error == false) {
          location.reload();
        }
      });
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
    withdraw: function(e) {
      e.preventDefault();
      var items = this.selected_items;
      if (items.length == 0) {
        alert("Вы не выбрали предметов");
        return;
      }
      if (!this.sending) {
        this.sending = true;
        var self = this;
        $.post("/items/withdraw", {
            items: items
          })
          .done(function(data) {
            alert(data.message);
            if (data.error) {
              self.sending = false;
            } else {
              location.reload();
            }
          });
      }
    },
  }
}
</script>

<style lang="css">
</style>

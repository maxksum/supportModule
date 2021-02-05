<template lang="html">
  <div id="wrapper" class="donate_wrap">
  	<div class="donate_block">
  		<div class="donate_text">
  			<div class="text">
  				АКЦИЯ! ПОЛУЧИ +50% ПРИ ПЕРВОМ ПОПОЛНЕНИИ БАЛАНСА
  			</div>
  		</div>
  		<div class="donate_form" id="donate_block">
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
  			<a href="/items/deposit" class="opt_donate_btn">
  				<span>Пополнить баланс</span>
  				<p>ИГРОВЫМИ ПРЕДМЕТАМИ</p>
  			</a>
  		</div>
  	</div>
  </div>

</template>

<script>
export default {
  props: [],
  data: function () {
    return {
      money: 15,
      points: 250,
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
  methods: {
    donate: function(e) {
      e.preventDefault();
      if (Math.ceil(this.money) < 10) {
        alert("Минимальная сумма пополнения - 10 RUB");
        return;
      }
      window.open('/payment/intelmoney?sum=' + Math.ceil(this.money), '_blank');
    }
  }
}
</script>

<style lang="css">
</style>

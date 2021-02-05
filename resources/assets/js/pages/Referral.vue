<template lang="html">
  <div id="wrapper" class="referral">
		<div class="referral_block">
			<div class="title">РЕФЕРАЛЬНАЯ СИСТЕМА</div>
			<div class="points">
				Ваш текущий баланс: <span>{{user.referral_profit}}</span><a href="/" v-on:click="takeMoney">Забрать все поинты</a>
			</div>
			<div class="referral_items">
				<div class="item">
					<div class="text">
						Приглашай друзей и <span>получай {{percent}}% от их выигрышей</span><br>
						Реферальный код можно выбрать только единожды!
					</div>
					<form class="ref_form">
            <div v-if="!user.referral_code">
						<input type="text" v-model="code" id="referral_code_set" name="" placeholder="Проверить код">
						<input type="submit" v-on:click="setCode" name="" value="Check">
            </div>
            <input v-else type="text" :value="user.referral_code" disabled>
					</form>
				</div>
				<div class="item">
					<div class="text">
						Ваша персональная <span>реферальная ссылка</span><br>
						Передайте ее другу для получения бонуса
					</div>
					<form class="ref_form">
						<input type="text" name="" disabled :value="'https://www.overpro.ru/?ref=' + user.id">
						<input type="submit" name="" value="Copy" v-on:click="copyLink">
					</form>
				</div>
				<div class="item">
					<div class="text">
						Вас пригласили? Есть реферальный код?<br>
						<span>Введи и получи бонус!</span>
					</div>
					<form class="ref_form">
            <div v-if="!referrer">
						<input type="text" v-model="fromCode" name="" placeholder="Введите код">
						<input type="submit" name="" value="Enter" v-on:click="setFrom">
          </div>

            <input v-else type="text" name="" :value="referrer" placeholder="Введите код" disabled>
					</form>
				</div>
			</div>
		</div>
		<div class="earnings_block">
			<div class="title">СТАТИСТИКА ВАШЕГО ЗАРАБОТКА</div>
			<div class="info">Человек зарегистрировалось по вашему коду: <span>{{count}}</span></div>
			<div class="head">
				<div class="item">#</div>
				<div class="item">Никнейм игрока</div>
				<div class="item">Событие</div>
				<div class="item">Сумма</div>
				<div class="item">Прибыль</div>
				<div class="item">Время</div>
			</div>
			<div class="body">
          <div class="inner" v-for="operation in operations.data">
  					<div class="item">{{operation.id}}</div>
  					<div class="item"><div class="avatar users"><img :src="operation.referral.avatar_medium"></div><a :href="'/user/' + operation.referral.id">{{operation.referral.name}}</a></div>
  					<div class="item">{{operation.type}}</div>
  					<div class="item">{{Math.floor(operation.amount / money_multiplier)}}</div>
  					<div class="item">{{Math.floor(operation.profit / money_multiplier)}}</div>
  					<div class="item">{{operation.created_at}}</div>
  				</div>
			</div>
			<div class="pagination">
        <ul>
          <li><div class="pages">Страница <span>{{operations.current_page}}</span> из <span>{{operations.last_page}}</span></div></li>
          <li v-if="operations.prev_page_url"><a :href="operations.prev_page_url"><</a></li>
          <li v-if="operations.next_page_url"><a :href="operations.next_page_url">></a></li>
        </ul>
			</div>
		</div>
	</div>
</template>

<script>
export default {
  data: function() {
    return {
      code: "",
      fromCode: "",
      user: user,
      operations: operations,
      count: count,
      percent: percent,
      referrer: referrer,
      money_multiplier: money_multiplier
    }
  },
  methods: {
    setCode: function(e) {
      e.preventDefault();
      if (this.code != "") {
        $.post("/referral", {
            action: "set_promo",
            value: this.code
          })
          .done(function(data) {
            if (data.status == "error") {
              alert(data.message);
            } else if (data.status == "success") {
              alert(data.message);
              location.reload();
            }
          });
      } else {
        alert("Вы не ввели код");
      }
    },
    copyLink: function(e) {
      e.preventDefault();
      let tmp = document.createElement('INPUT'),
        focus = document.activeElement;

      tmp.value = "https://www.overpro.ru/?ref=" + this.user.id;

      document.body.appendChild(tmp);
      tmp.select();
      document.execCommand('copy');
      document.body.removeChild(tmp);
      focus.focus();
      alert("Ссылка успешно скопирована");
    },

    setFrom: function(e) {
      e.preventDefault();
      if (this.fromCode) {
        $.post("/referral", {
            action: "set_from",
            value: this.fromCode
          })
          .done(function(data) {
            if (data.status == "error") {
              alert(data.message);
            } else if (data.status == "success") {
              alert(data.message);
              location.reload();
            }
          });
      } else {
        alert("Вы не ввели код");
      }
    },
    takeMoney: function(e) {
      e.preventDefault();

      $.get("/referral/take").done(function(data) {
        if (data.status == "error") {
          alert(data.message);
        } else if (data.status == "success") {
          alert(data.message);
          location.reload();
        }
      });
    }
  }
}
</script>

<style lang="css">
</style>

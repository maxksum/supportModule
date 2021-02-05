<template lang="html">
  <div id="wrapper" class="setting">
  	<form id="lobby_create" class="sets" method="/" action="/lobby/create">
  		<div class="first">
  			<div class="item">
  				<label>Ставка игрока:</label>
  				<input id="spinner" name="bet" :value="create_form.bet ? create_form.bet : 50" step="10">
  			</div>
  			<div class="item">
  				<label>Кол-во игроков:</label>
  				<select id="per_team" name="per_team" :data-selected="create_form.per_team ? create_form.per_team : 5" class="turnintodropdown">
  					<option value="1">1х1</option>
  					<option value="2">2х2</option>
  					<option value="3">3х3</option>
            <option value="4">4x4</option>
  					<option value="5">5x5</option>
  				</select>
  			</div>
  			<div class="item">
  				<label>Карта:</label>
  				<select id="map" name="map" :data-selected="create_form.map ? create_form.map : 1" class="turnintodropdown">
            <option v-for="option in maps" v-bind:value="option.id">
              {{ option.name }}
            </option>
  				</select>
  			</div>
  			<div class="item">
  				<label>Античит:</label>
  				<select name="anticheat" id="anticheat" :data-selected="create_form.anticheat ? create_form.anticheat : 1" class="turnintodropdown">
  					<option value="1">Вкл. EAC</option>
  					<option value="0">Выкл. EAC</option>
  				</select>
  			</div>
  			<div class="item">
  				<label>Локация:</label>
  				<select name="location" id="location" :data-selected="create_form.location ? create_form.location : 1" class="turnintodropdown">
            <option v-for="option in locations" v-bind:value="option.id">
              {{ option.name }} ({{ option.freeservers }}/{{ option.servers }})
            </option>
  				</select>
  			</div>
  		</div>

  		<div class="second">
  			<div class="item">
  				<label>Название К1:</label>
  				<input name="team1" type="text" placeholder="Red Team" :value="create_form.team1 ? create_form.team1 : 'Red Team'" required/>
  			</div>
  			<div class="item">
  				<label>Название К2:</label>
  				<input name="team2" type="text" placeholder="Blue Team" :value="create_form.team2 ? create_form.team2 : 'Blue Team'" required/>
  			</div>
  			<div class="item">
  				<label>Автобаланс:</label>
  				<select name="autobalance" id="autobalance" :data-selected="create_form.autobalance  ? create_form.autobalance : 0" class="turnintodropdown">
  					<option value="1">Да</option>
  					<option value="0">Нет</option>
  				</select>
  			</div>
  			<div class="item">
  				<label>Скрытие ников:</label>
  				<select name="hidden" id="hidden" :data-selected="create_form.hidden ? create_form.hidden : 0" class="turnintodropdown">
  					<option value="1">Да</option>
  					<option value="0">Нет</option>
  				</select>
  			</div>
  			<div class="item">
  				<label>Пароль к игре:</label>
  				<input type="password" name="password">
  			</div>
  		</div>

  		<div class="third">
  			<div class="skill_block">
  				<span>Скилл игроков:</span>
  				<div class="skill_line">
  					<p>Low Skill - OverPro Skill</p>
  					<div id="param"></div>
  				</div>
  			</div>

  			<div class="block_player">
  				<span>Не впускать игроков:</span>
  				<a href="#"><img src="/images/sets/save.png"></a>
  				<a href="#"><img src="/images/sets/delete.png"></a>
  				<textarea name="blocklist"></textarea>
  				<button class="start_game" v-on:click="submitCreate">
  					<span>СОЗДАТЬ ИГРУ</span>
  					<p>Создать свое лобби</p>
  				</button>
  			</div>
  		</div>
  	</form>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      maps: maps,
      locations: locations,
      create_form: create_form,
      sending: false,
    }
  },
  methods: {
    submitCreate: function(e) {
      e.preventDefault();
      if (!this.sending) {
        this.sending = true;
        let create_form = jQuery("#lobby_create");
        var slider = document.getElementById('param');
        var skills = slider.noUiSlider.get();
        var s_from = parseInt(skills[0]);
        var s_to = parseInt(skills[1]);
        var temp = this;
        jQuery.post(create_form.attr("action"), create_form.serialize() + '&from=' + s_from + '&to=' + s_to, function(data) {
          setTimeout(function() {
            temp.sending = false;
          }, 1000);
          if (data.error) {
            alert(data.message);
          } else {
            $(".setting").hide();
          }
        });
      }
    }
  }
}
</script>

<style lang="css">
</style>

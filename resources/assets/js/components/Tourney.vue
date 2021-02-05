<template lang="html">
  <div id="wrapper" class="tournament">
  		<div class="tournament_block" id="tourney_shoke">
  			<div class="frame">
  				<img class="tour_bg" src="/images/shoke.jpg?3">
  			</div>
  			<div class="send">
  				<div class="text"><span style="cursor: pointer" onClick="window.open('https://vk.com/topic-38751500_36363559', '_blank');">ИНФО И ПРИЗЫ</span> | <span style="cursor: pointer" onClick="window.open('https://vk.com/topic-38751500_35944672', '_blank');">ПОИСК КОМАНДЫ НА ТУРНИР</span> | <span style="cursor: pointer" onClick="window.open('https://vk.com/topic-38751500_36363553', '_blank');">ВОПРОСЫ</span></div>
  				<div class="info">Зарегистрировано команд <b>{{tourney_teams.length}}</b> из <b>128</b></div>
  				<a href="#tournament_detail" id="showMoreTour">
  					<span>ЗАРЕГИСТРИРОВАТЬ КОМАНДУ</span>
  					<p>Перейти к регистрации команды</p>
  				</a>
  			</div>
  		</div>

  		<a href="#tournament_detail" class="show_more_info showMoreStyle" id="showMore">СМОТРЕТЬ БОЛЬШЕ О ТУРНИРАХ</a>

  		<div class="tournament_detail" id="tournament_detail">
  			<div class="tournament_detail_block">
  				<div class="thead">
  					<div class="item">ID</div>
  					<div class="item">Контакты</div>
  					<div class="item">Название</div>
  				</div>
  				<div class="tbody scrollPro">
            <div class="inner" v-for="team in tourney_teams">
              <div class="item">{{team.id}}</div>
              <div class="item">{{team.contacts}}</div>
              <div class="item">{{team.name}}</div>
            </div>
  				</div>
  			</div>

  			<form class="tournament_register" id="tournament_register" action="/tournament/teams/new" method="POST">
          <div class="item">
            <label>Steamid64
              <a target="_blank" href="https://steamid.xyz/">можно узнать тут</a>
          </label> </div>
  				<div class="item">
  					<label>Название команды:</label>
  					<input type="text" name="name" placeholder="Введите название" required/>
  				</div>
  				<div class="item">
  					<label>Капитан команды:</label>
  					<input type="text" name="captain" :value="user ? user.name : ''" disabled required/>
  				</div>
  				<div class="item">
  					<label>Игрок 2:</label>
  					<input type="text" name="players[]" placeholder="STEAMID64 игрока" required/>
  				</div>
  				<div class="item">
  					<label>Игрок 3:</label>
  					<input type="text" name="players[]" placeholder="STEAMID64 игрока" required/>
  				</div>
  				<div class="item">
  					<label>Игрок 4:</label>
  					<input type="text" name="players[]" placeholder="STEAMID64 игрока" required/>
  				</div>
  				<div class="item">
  					<label>Игрок 5:</label>
  					<input type="text" name="players[]" placeholder="STEAMID64 игрока" required/>
  				</div>
  				<div class="item">
  					<label>Замена 1:</label>
  					<input type="text" name="standin[]" placeholder="STEAMID64 игрока"/>
  				</div>
  				<div class="item">
  					<label>Замена 2:</label>
  					<input type="text" name="standin[]" placeholder="STEAMID64 игрока"/>
  				</div>
  				<div class="item">
  					<label>Контакты:</label>
  					<input type="text" name="contacts" placeholder="Контакты(VK, Skype, Steam)" required/>
  				</div>
  				<input type="submit" v-on:click="registerTeam" name="" value="ЗАРЕГИСТРИРОВАТЬ КОМАНДУ" class="tour_btn">
  			</form>
  		</div>
  	</div>
</template>

<script>
export default {
  data: function() {
    return {
      tourney_teams: tourney_teams.teams,
      user: user
    }
  },
  methods: {
    registerTeam: function(e) {
      e.preventDefault();
      $.post("/tournament/teams/new", $("#tournament_register").serialize(), function(data) {
        alert(data.message);
      });
    }
  }
}
</script>

<style lang="css">
</style>

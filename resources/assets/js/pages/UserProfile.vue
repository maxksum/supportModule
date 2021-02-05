<template lang="html">
  <div id="wrapper" class="profile_page">
		<div class="prof_top">
			<div class="prof_avatar">
        <a target="_blank"
            :href="'http://steamcommunity.com/profiles/' + user.steamid64 + '/'"><img :src="user.avatar_full"></a>
			</div>

			<div class="prof_data">
				<div class="title">
          <img class="profile_flag" :src="'/flags/' + country.toLowerCase() + '.png'">
					<div class="name">{{user.name}}</div>
					<div class="skill rank" v-bind:class="'rank_' + user.csgo.own_rank">{{user.csgo.own_rank}}</div>
					<div class="status"><img :src="'/images/profile/ico-' + user.online + '.png'"></div>
				</div>
				<div class="information">
          <textarea :disabled="(!my_user || my_user.id != user.id) ? true : false" v-model="about"></textarea>
				</div>
				<div class="social_block">
					<div class="soc_title">Способы связи:</div>
					<div class="social_block_item">
            <div class="item active">
              <a target="_blank"
                  :href="'http://steamcommunity.com/profiles/' + user.steamid64 + '/'">
                  <div class="intro"><img style="max-width: 30px" src="/images/profile/ico-steam.png?1"></div>
                </a>
						</div>
					</div>

					<!-- <form class="soc_block_form">
						<input type="text" name="" class="add_soc_link" placeholder="Введите ссылку на профиль соц сети">
						<input type="submit" name="" class="save_soc_link" value="OK">
					</form> -->
				</div>
				<!-- <div class="prize_skill_count">
					<div class="item">
						<div class="count">0</div>
						<div class="text">Золото турнира</div>
					</div>
					<div class="item">
						<div class="count">0</div>
						<div class="text">Серебро турнира</div>
					</div>
					<div class="item">
						<div class="count">0</div>
						<div class="text">Бронза турнира</div>
					</div>
				</div> -->
			</div>
		</div>

    <div class="prof_stats_stat">
			<div class="title">ОСНОВНАЯ СТАТИСТИКА</div>
			<div class="prof_stats_items">
				<div class="item">
					<div class="item_inner">ELO <span>{{user.csgo.exp}}</span></div>
				</div>
        <div class="item">
					<div class="item_inner">Kill Death <span>{{user.csgo.deaths == 0 ? "1.00" : (user.csgo.kills / user.csgo.deaths).toFixed(2)}}</span></div>
				</div>
        <div class="item">
					<div class="item_inner">Kill Rate <span>{{user.csgo.games == 0 ? "1.00" : (user.csgo.kills / user.csgo.games).toFixed(2)}}</span></div>
				</div>
        <div class="item">
					<div class="item_inner">Win Rate <span>{{user.csgo.games == 0 ? "1.00" : Math.ceil(user.csgo.wins / user.csgo.games * 100)}}%</span></div>
				</div>
        <div class="item">
					<div class="item_inner">HeadShot <span>{{user.csgo.kills == 0 ? "100" : Math.ceil(user.csgo.headshot_kills / user.csgo.kills * 100)}}%</span></div>
				</div>
			</div>
		</div>

		<ul class="prof_tab_nav">
			<li class="active"><a href="#">Последние игры</a></li>
		</ul>
		<div class="prof_history_list">
			<div class="head">
				<div class="item">Название</div>
				<div class="item">Создатель</div>
				<div class="item">Ставка</div>
				<div class="item">Карта</div>
				<div class="item">&nbsp;</div>
				<div class="item">&nbsp;</div>
			</div>
			<div class="body">
				<div class="inner" style="cursor: pointer" v-for="(mix, key) in last" :key="key">
					<div class="inner_item">
						<div class="item" v-on:click="openMix(mix.id)"><span>{{mix.team1name}}</span> vs <span>{{mix.team2name}}</span></div>
						<div class="item"><span v-bind:class="'rank_' + mix.creator.own_rank" class="rank">{{mix.creator.own_rank}}</span> {{mix.creator.name}}</div>
						<div class="item" v-on:click="openMix(mix.id)"><span>{{Math.floor(mix.player_bet / money_multiplier)}}</span></div>
						<div class="item" v-on:click="openMix(mix.id)"><img :src="mix.map.image"></div>
						<div v-on:click="openMix(mix.id)" v-bind:class="{win: mix.winner == 1, lose: mix.winner == 2}" class="item">{{mix.winner != null ? mix.winner == 1 ? 'ПОБЕДА' : 'ПРОИГРЫШ' : 'ПОБЕДИТЕЛЯ НЕТ'}}</div>
						<div class="item"><a class="show_more_stat">Развернуть</a></div>
					</div>

					<div class="inner_block">
						<div class="inner_head">
							<div class="item">&nbsp;</div>
							<div class="item">&nbsp;</div>
							<div class="item">ELO</div>
							<div class="item">K/D</div>
							<div class="item">Karma</div>
							<div class="item">Kill</div>
							<div class="item">Assist</div>
							<div class="item">Death</div>
							<div class="item">MONEY</div>
							<div class="item">HeadShot %</div>
						</div>
						<div class="inner_body">
							<div class="inner_command">
								<div class="inner_inner" v-for="player in mix.players" v-if="player.team == 1">
									<div class="item"><a :href="'/user/' + player.user.id">{{player.user.name}}</a></div>
									<div v-bind:class="{win: player.team == mix.winner_team && mix.winner_team != null, lose: mix.winner_team != null && player.team != mix.winner_team}" class="item">{{mix.winner_team == null ? 'Нет победителя' : player.team == mix.winner_team ? 'Победа':'Проигрыш'}}</div>
									<div class="item">{{player.exp_ratio >= 0 ? '+' + player.exp_ratio : player.exp_ratio}}</div>
									<div class="item">{{player.deaths == 0 ? "1.00" : (player.kills / player.deaths).toFixed(2)}}</div>
									<div class="item">{{player.karma}}</div>
									<div class="item" onclick="console.log(player)">{{player.kills}}</div>
									<div class="item">{{player.assists}}</div>
									<div class="item">{{player.deaths}}</div>
									<div class="item"><span class="coin20">{{mix.winner_team == null ? Math.floor(mix.player_bet / money_multiplier) : player.team == mix.winner_team ? '+' + Math.floor(mix.player_bet / money_multiplier * 0.8) : '-' + Math.floor(mix.player_bet / money_multiplier)}}</span></div>
									<div class="item">{{player.kills == 0 ? "100" : Math.ceil(player.headshot_kills / player.kills * 100)}}%</div>
								</div>
							</div>

							<div class="inner_command">
                <div class="inner_inner" v-for="player in mix.players" v-if="player.team == 2">
                  <div class="item"><a :href="'/user/' + player.user.id">{{player.user.name}}</a></div>
                  <div v-bind:class="{win: player.team == mix.winner_team && mix.winner_team != null, lose: mix.winner_team != null && player.team != mix.winner_team}" class="item">{{mix.winner_team == null ? 'Нет победителя' : player.team == mix.winner_team ? 'Победа':'Проигрыш'}}</div>
                  <div class="item">{{player.exp_ratio >= 0 ? '+' + player.exp_ratio : player.exp_ratio}}</div>
									<div class="item">{{player.deaths == 0 ? "1.00" : (player.kills / player.deaths).toFixed(2)}}</div>
									<div class="item">{{player.karma}}</div>
									<div class="item">{{player.kills}}</div>
									<div class="item">{{player.assists}}</div>
									<div class="item">{{player.deaths}}</div>
                  <div class="item"><span class="coin20">{{mix.winner_team == null ? Math.floor(mix.player_bet / money_multiplier) : player.team == mix.winner_team ? '+' + Math.floor(mix.player_bet / money_multiplier * 0.8) : '-' + Math.floor(mix.player_bet / money_multiplier)}}</span></div>
                  <div class="item">{{player.kills == 0 ? "100" : Math.ceil(player.headshot_kills / player.kills * 100)}}%</div>
                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
      <div class="pagination" style="margin-right: 1%;">
        <ul>
          <li><div class="pages">Страница <span>{{pagination.current_page}}</span> из <span>{{pagination.last_page}}</span></div></li>
          <li v-if="pagination.prev_page_url"><a :href="pagination.prev_page_url"><</a></li>
          <li v-if="pagination.next_page_url"><a :href="pagination.next_page_url">></a></li>
        </ul>
      </div>
		</div>
	</div>
</template>

<script>
import lodash from 'lodash';
export default {
  data: function() {
    return {
      my_user: user,
      user: user_src,
      pagination: pagination,
      country: country,
      city: city,
      about: about,
      last: last,
      money_multiplier: money_multiplier
    }
  },
  watch: {
    about: function(newAbout) {
      this.updateAbout();
    }
  },
  methods: {
    openMix: function(id) {
      window.open("/mix/" + id, '_blank');
    },
    updateAbout: lodash.debounce(
      function() {
        var vm = this
        $.post("/user/about", {
          about: vm.about
        }, function(data) {
          if (data.error) {
            alert(data.message);
            vm.about = data.about;
          }
        });
      },
      500
    )
  }
}
</script>

<style lang="css">
</style>

<template lang="html">
  <div id="wrapper" class="end_stats_game">
		<div class="end_block">
			<div class="set">
				<div class="item">Античит - <span>{{mix.eac == 1 ? "Включен":"Выключен"}}</span></div>
				<div class="item">Автобаланс - <span>{{mix.autobalance == 1 ? "Включен":"Выключен"}}</span></div>
        <div class="item">Скрытые ники - <span>{{mix.players_hidden == 1 ? "Включены":"Выключены"}}</span></div>
				<div class="item">Дата - <span>{{mix.created_at}}</span></div>
				<div class="item"><a target="_blank" :href="'http://' + mix.server.group.demo_host + '/' + mix.id + '_' + mix.map.name + '.dem'"></a> Демо-запись</div>
			</div>
			<div class="frame">
				<div class="img"><img :src="mix.map.image"></div>
				<div class="best" v-if="mix.best">
					ЛУЧШИЙ ИГРОК МАТЧА:
					<div class="avatar users"><img :src="mix.best.avatar_medium"></div>
					<span><a :href="'/user/' + mix.best.id">{{mix.best.name}}</a></span>
				</div>
			</div>

			<div class="end_stats_block">
				<div class="end_team">
					<div class="end_table">
						<div v-if="mix.game_status == -1 || mix.game_status == 2" class="title" v-bind:class="{winner: mix.winner_team == 1}">{{mix.team1name}}</div>
						<div class="title" v-else>{{mix.team1name}}</div>
						<div class="head">
							<div class="item">Никнейм</div>
							<div class="item">TeamPlay</div>
							<div class="item">Убийства</div>
							<div class="item">Смерти</div>
							<div class="item">Ассисты</div>
							<div class="item">ELO</div>
							<div class="item">Баланс</div>
							<div class="item">&nbsp;</div>
						</div>
						<div class="body">
								<div class="inner" v-for="player in mix.players" v-if="player.team == 1" v-bind:id="'usermix' + player.user_id">
									<div class="item"><div class="avatar users"><img :src="player.user.avatar_medium"></div><a :href="'/user/' + player.user.id">{{player.user.name}}</a></div>
									<div class="item praised">
										{{player.karma}}
										<div class="dislike"><a v-on:click="showDislike(player.user_id, $event)">-</a></div>
										<div class="like"><a v-on:click="changeKarma('+', player.user_id, $event)">+</a></div>
									</div>
									<div class="item">{{player.kills}}</div>
									<div class="item">{{player.deaths}}</div>
									<div class="item">{{player.assists}}</div>
									<div class="item">{{player.exp_ratio}}</div>
									<div class="item">{{player.winner != null ? player.winner == 1 ? Math.floor(mix.player_bet / money_multiplier * 0.8) : '-' + Math.floor(mix.player_bet / money_multiplier) : Math.floor(mix.player_bet / money_multiplier)}}</div>
									<div class="item"><a class="report with_title" v-on:click="showReport(player.user.name, player.user_id, $event)" title="Подать&nbsp;жалобу"></a></div>
								</div>
						</div>
					</div>
				</div>

				<div class="end_team">
          <div class="end_table">
						<div v-if="mix.game_status == -1 || mix.game_status == 2" v-bind:class="{winner: mix.winner_team == 2}" class="title">{{mix.team2name}}</div>
						<div class="title" v-else>{{mix.team2name}}</div>
						<div class="head">
							<div class="item">Никнейм</div>
							<div class="item">TeamPlay</div>
							<div class="item">Убийства</div>
							<div class="item">Смерти</div>
							<div class="item">Ассисты</div>
							<div class="item">ELO</div>
							<div class="item">Баланс</div>
							<div class="item">&nbsp;</div>
						</div>
						<div class="body">
								<div class="inner" v-for="player in mix.players" v-if="player.team == 2" v-bind:id="'usermix' + player.user_id">
									<div class="item"><div class="avatar users"><img :src="player.user.avatar_medium"></div><a :href="'/user/' + player.user.id">{{player.user.name}}</a></div>
									<div class="item praised">
										{{player.karma}}
										<div class="dislike"><a v-on:click="showDislike(player.user_id, $event)">-</a></div>
										<div class="like"><a v-on:click="changeKarma('+', player.user_id, $event)">+</a></div>
									</div>
									<div class="item">{{player.kills}}</div>
									<div class="item">{{player.deaths}}</div>
									<div class="item">{{player.assists}}</div>
									<div class="item">{{player.exp_ratio}}</div>
									<div class="item">{{player.winner != null ? player.winner == 1 ? Math.floor(mix.player_bet / money_multiplier * 0.8) : '-' + Math.floor(mix.player_bet / money_multiplier) : Math.floor(mix.player_bet / money_multiplier)}}</div>
									<div class="item"><a class="report with_title" v-on:click="showReport(player.user.name, player.user_id, $event)" title="Подать&nbsp;жалобу"></a></div>
								</div>
						</div>
					</div>
				</div>
			</div>

			<form class="dislike_form">
				<div class="title">Укажите причину дизлайка</div>
				<input type="text" name="" v-model="text_dislike" placeholder="Введите причину для дизлайка" required/>
				<input type="submit" v-on:click="changeKarma('-', null, $event)" name="" value="OK">
			</form>
		</div>
	</div>
</template>

<script>
import Vue from 'vue';

export default {
  data: function() {
    return {
      text_dislike: "",
      user_dislike: 0,
      mix: mix,
      report: null,
      money_multiplier: money_multiplier
    }
  },
  created() {
    this.report = new Vue({
      el: "#popup",
      data: {
        name: "",
        userid: "",
        text: "",
      },
      methods: {
        sendReport: function(e) {
          e.preventDefault();
          var self = this;
          $.post("/mix/" + mix_id + "/report", {
            text: self.text,
            user_id: self.userid
          }, function(data) {
            alert(data.message);
            if (!data.error) {
              closeGame();
            }
          });
        },
      }
    });
  },
  methods: {
    showReport: function(name, userid, e) {
      e.preventDefault();
      this.report.name = name;
      this.report.userid = userid;
    },
    showDislike: function(user_id, e) {
      this.user_dislike = user_id;
      e.preventDefault();
    },
    changeKarma: function(val, user_id, e) {
      e.preventDefault();
      var self = this;
      if (val == '-') {
        user_id = this.user_dislike;
      }
      $.post("/mix/" + mix_id + "/karma", {
        user_id: user_id,
        value: val,
        text: self.text_dislike
      }, function(data) {
        if (data.error) {
          alert(data.message);
        } else {
          self.text_dislike = "";
          $('.dislike_form').hide();
          $("#usermix" + user_id + " .item.praised").html(data.message);
        }
      });
    }
  }
}
</script>

<style lang="css">
</style>

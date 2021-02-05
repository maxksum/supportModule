<template>
<div id="wrapper" class="game_preview">
  <div class="preview_block">
    <div class="preview_new_inner">
      <div class="wrapAllPlayer">
        <lobby-player v-bind:user="user" :kick_method="kick_method" :move_method="move_method" :show_method="show_method" v-for="player in lobby.team1" :player="player" :creator="user && user.id == lobby.creator_id" :lobby="lobby" :key="player.id"></lobby-player>
        <lobby-join v-bind:user="user" v-for="n in lobby.per_team - lobby.team1.length" :key="n" :lobby="lobby" :team="1"></lobby-join>
      </div>
    </div>

    <div class="preview_new_inner">
      <div class="team_name">
        <div class="team1"><span>{{lobby.team1name}}</span></div>
        <div class="team2"><span>{{lobby.team2name}}</span></div>
      </div>
      <div class="preview_game_link">
        Ссылка на игру: <span>https://overpro.ru/?lobby_id={{lobby.id}}</span>
        <a href="/" v-on:click="saveLink" class="save_game_link"></a>
      </div>
      <div style='padding-left: 50px;' v-if="user && user.role =='administrator'">
        <a v-on:click="resetGame" v-if="lobby.state == 2">СБРОСИТЬ</a>
        <a v-on:click="resetLobby" v-else>СБРОСИТЬ</a>
      </div>
      <div class="preview_game_map">
        <img :src="lobby.map.image">
      </div>
      <div class="preview_game_location" v-if="lobby.state == 0 || lobby.state == 1">
        Локация: <span>{{lobby.location.name}}</span>
      </div>
      <div class="preview_game_location" style="background: none;padding-left: 0px;" v-if="lobby.state == 2 && user && user.lobby && user.lobby.id == lobby.id">
        <span>Игра №{{lobby.mix.id}}</span>&nbsp;&nbsp;&nbsp;Сервер: <a :href="'steam://connect/' + lobby.mix.server.address">{{lobby.mix.server.address}}</a>
      </div>
      <div class="preview_game_location" v-if="lobby.state == 2 && (!user || !user.lobby || user.lobby.id != lobby.id)">
        <span>Игра №{{lobby.mix.id}}</span>&nbsp;&nbsp;&nbsp;HLTV: <a :href="'steam://connect/' + lobby.mix.server.hltv">{{lobby.mix.server.hltv}}</a>
      </div>
      <div class="preview_game_bets">
        <span>{{Math.floor(lobby.bet / money_multiplier)}}</span>
        <span v-if="lobby.state == 0 || lobby.state == 1">{{lobby.per_team}}x{{lobby.per_team}}</span>
        <span v-if="lobby.state == 2">{{lobby.mix.score}}</span>
      </div>
    </div>

    <div class="preview_new_inner">
      <div class="wrapAllPlayer">
        <lobby-player v-bind:user="user" :kick_method="kick_method" :move_method="move_method" :show_method="show_method" v-for="player in lobby.team2" :player="player" :creator="user && user.id == lobby.creator_id" :lobby="lobby" :key="player.id"></lobby-player>
        <lobby-join v-bind:user="user" v-for="n in lobby.per_team - lobby.team2.length" :key="n" :lobby="lobby" :team="2"></lobby-join>
      </div>
    </div>
  </div>
  <div class="detail_game_block animated" id="detail_game_block">
    <div class="detail_sets">
      <div class="detail_title">НАСТРОЙКИ ИГРЫ</div>
      <ul>
        <li>
          <label>Режим игры:</label>
          <div class="detail_param">{{lobby.per_team}}х{{lobby.per_team}}</div>
        </li>
        <li>
          <label>Локация:</label>
          <div class="detail_param">{{lobby.location.name}}</div>
        </li>
        <li>
          <label>Античит:</label>
          <div class="detail_param">{{lobby.eac == 0 ? "Выключен":"Включен"}}</div>
        </li>
        <li>
          <label>Скилл:</label>
          <div class="detail_param"><span class="rank" v-bind:class="'rank_' + lobby.skill_from">{{lobby.skill_from}}</span> - <span class="rank" v-bind:class="'rank_' + lobby.skill_to">{{lobby.skill_to}}</span></div>
        </li>
        <li>
          <label>Скрытие ников:</label>
          <div class="detail_param">{{lobby.players_hidden == 0 ? "Выключено":"Включено"}}</div>
        </li>
        <li>
          <label>Автобаланс:</label>
          <div class="detail_param">{{lobby.auto_balance == 0 ? "Выключен":"Включен"}}</div>
        </li>
        <li>
          <label>Пароль:</label>
          <div class="detail_param">{{lobby.password ? "С паролем":"Без пароля"}}</div>
        </li>
      </ul>
    </div>
    <lobby-chat v-bind:messages="messages" v-bind:user="user" v-bind:lobby="lobby"></lobby-chat>
  </div>

</div>
</template>

<script>
export default {
  inherit: true,
  props: ['user', 'lobby', 'show_method', 'messages', 'move_method', 'kick_method'],
  data: function() {
    return {
      sending: false,
      money_multiplier: money_multiplier
    }
  },
  methods: {
    saveLink: function(e) {
      e.preventDefault();
      let tmp = document.createElement('INPUT'),
        focus = document.activeElement;

      tmp.value = "https://overpro.ru/?lobby_id=" + this.lobby.id;

      document.body.appendChild(tmp);
      tmp.select();
      document.execCommand('copy');
      document.body.removeChild(tmp);
      focus.focus();
      alert("Ссылка успешно скопирована");
    },
    resetGame: function(e) {
      e.preventDefault();
      if (!this.sending) {
        this.sending = true;
        var temp = this;
        jQuery.get("/mix/reset/" + temp.lobby.mix_id, function(data) {
          setTimeout(function() {
            temp.sending = false;
          }, 1000);
          if (data.result) {
            alert("Игра успешно сброшена");
          } else {
            alert(data.message);
          }
        });
      }
    },
    resetLobby: function(e) {
      e.preventDefault();
      if (!this.sending) {
        this.sending = true;
        var temp = this;
        jQuery.get("/lobby/reset/" + temp.lobby.id, function(data) {
          setTimeout(function() {
            temp.sending = false;
          }, 1000);
          if (data.result) {
            alert("Лобби успешно сброшено");
          } else {
            alert(data.message);
          }
        });
      }
    }
  },
  components: {
    'lobby-player': require('./LobbyPlayer.vue'),
    'lobby-join': require('./LobbyJoin.vue'),
    'lobby-chat': require('./LobbyChat.vue'),
  },
}
</script>

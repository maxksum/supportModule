<template>
<div id="home_div">
  <vue-progress-bar></vue-progress-bar>
  <lobby-create></lobby-create>
  <lobby-more v-if="show_lobby" v-bind:lobby="show_lobby" v-bind:user="user" v-bind:messages="lobby_messages" :kick_method="kickPlayer" :move_method="movePlayer" :show_method="showUser"></lobby-more>
  <div id="wrapper" class="game_act_block">
    <div class="inner">
      <a href="#wrapper.setting" id="showMore" class="start_act_game">
        <span>СОЗДАТЬ ИГРУ</span>
        <p>Перейти к созданию игры</p>
      </a>

      <ul class="game_act_info">
        <li v-bind:class="{'active': show_type == 1}" v-on:click="changeType(1)">
          Заявки: <span>{{lobbies.filter(function(el){return el.state != 2}).length}}</span>
        </li>
        <li v-bind:class="{'active': show_type == 2}" v-on:click="changeType(2)">
          LIVE: <span>{{lobbies.filter(function(el){return el.state == 2}).length}}</span>
        </li>
      </ul>
    </div>
  </div>
  <lobbies-block ref="Lobbies" :filter_location="filter_location" :show_lobbies="show_lobbies" :show_method="showLobby" :kick_method="kickPlayer" :move_method="movePlayer"></lobbies-block>
  <tourneys-block v-bind:tourneys="tourneys"></tourneys-block>
  <top-players v-bind:tops="tops"></top-players>
  <donate></donate>
  <div id="wrapper" class="vk_block">
    <div id="vk_groups"></div>
  </div>
</div>
</template>

<script>
import LobbiesBlock from '../components/LobbiesBlock.vue';
import TourneysBlock from '../components/TourneysBlock.vue';
import Donate from '../components/Donate.vue';
import LobbyCreate from '../components/LobbyCreate.vue';
import LobbyMore from '../components/LobbyMore.vue';
import TopPlayers from '../components/TopPlayers.vue';
import Vue from 'vue';

export default {
  data() {
    return {
      user: user,
      lobbies: lobbies,
      deathmatch_servers: deathmatch_servers,
      top_players: dm_top.players,
      dm_prize: dm_top.prize,
      show_lobby: null,
      lobby_messages: [],
      lobby_socket: null,
      tops: tops,
      live_matches: counts.mixes_playing,
      in_proccess: counts.mixes_progress,
      users_online: counts.users_online,
      maps: maps,
      tourneys: tourneys,
      filter_location: [],
      lobby_id: lobby_id,
      show_lobbies: lobbies.filter(function(el) {
        return el.state != 2
      }),
      show_type: 1,
      mus: null,
      profilePopup: null
    };
  },
  components: {
    LobbiesBlock,
    TourneysBlock,
    Donate,
    LobbyCreate,
    LobbyMore,
    TopPlayers
  },
  mounted() {
    this.$Progress.start();
    var temp = this;
    if (this.show_lobby) {
      if (this.show_lobby.state == 1) {
        if (typeof this.mus.play !== "undefined") {
          this.mus.play();
        }
        var players;
        players = this.show_lobby.team1.concat(this.show_lobby.team2);
        var temp = this;
        var player = players.filter(function(pl) {
          return temp.user && pl.user_id == temp.user.id;
        });
        if (player.length > 0) {
          player = player[0];
          if (player.ready == 0) {
            if ($("#popup:visible").length == 0 && $('.beta_game:visible').length == 0) {
              readyGame();
            }
          } else {
            tradeGame();
            lobbyGame();
          }
        }
      }
      if (this.show_lobby.state == 2) {
        if (typeof this.mus.play !== "undefined") {
          this.mus.play();
        }
      }
    }
  },
  created() {
    this.profilePopup = new Vue({
      el: "#user_popup",
      data: {
        player: null,
        creator: null,
        moveMethod: null,
        kickMethod: null,
      }
    });
    this.mus = document.getElementById('goplayer');
    this.mus.volume = 0.5;
    var show_lobbies = lobbies.filter(function(el) {
      return el.state != 2
    });
    Echo.channel("Stats")
      .listen(".update", (e) => {
        this.in_proccess = e.mixes_progress;
        this.live_matches = e.mixes_playing;
        $("#users_online").html(e.users_online.length);
      });

    if (this.user) {
      if (this.user.lobby) {
        this.$set(this, 'show_lobby', this.user.lobby);
        this.$nextTick(function() {
          initShowMore();
        });
        this.lobby_socket = "Lobby" + this.user.lobby.id;
        Echo.channel("Lobby" + this.user.lobby.id)
          .listen(".message", (e2) => {
            this.$set(this.lobby_messages, this.lobby_messages.length, e2.data);
          });
      }
      Echo.channel("User" + this.user.id)
        .listen(".updated", (e) => {

          this.$set(this, 'user', e.user);
          if (e.user.lobby && (!this.show_lobby || this.show_lobby.id != e.user.lobby.id)) {
            this.$set(this, 'lobby_messages', []);
            if (this.lobby_socket) {
              Echo.leave(this.lobby_socket);
              this.$set(this, 'lobby_socket', null);
            }
            this.$set(this, 'show_lobby', e.user.lobby);
          }

          if (($("#popup:visible").length != 0 || $('.beta_game:visible').length != 0) && !e.user.lobby) {
            closeBeta();
            closeGame();
          }
        });
    }
    Echo.channel("Lobbies").listen(".refresh", (e) => {
      this.lobbies = e.lobbies;

      if (typeof e.lobbies.filter !== "undefined") {
        var show_lobbies = [];
        if (this.show_type == 1) {
          show_lobbies = e.lobbies.filter(function(el) {
            return el.state != 2
          });
        } else {
          show_lobbies = e.lobbies.filter(function(el) {
            return el.state == 2
          });
        }
        this.$set(this, 'show_lobbies', show_lobbies);
        if (this.show_lobby) {

          var temp = this;
          var new_show = e.lobbies.filter(function(lobby) {
            return lobby.id == temp.show_lobby.id;
          });
          if (new_show.length == 0) {
            new_show = null;
          } else {
            new_show = new_show[0];

            var old_state = this.show_lobby.state;
            var new_state = new_show.state;

            if (old_state == 0 && new_state == 1) {
              var players;
              players = new_show.team1.concat(new_show.team2);
              var temp = this;
              var player = players.filter(function(pl) {
                return temp.user && pl.user_id == temp.user.id;
              });
              if (player.length > 0) {
                player = player[0];
                if (player.ready == 0) {
                  if ($("#popup:visible").length == 0 && $('.beta_game:visible').length == 0) {
                    if (typeof this.mus.play !== "undefined") {
                      this.mus.play();
                    }
                    readyGame();
                  }
                } else {
                  tradeGame();
                  lobbyGame();
                }
              }
            } else if (old_state == 1 && new_state == 0) {
              closeGame();
            } else if (old_state == 1 && new_state == 2) {
              if (typeof this.mus.play !== "undefined") {
                this.mus.play();
              }
              closeGame();
            }
          }
          this.$set(this, "show_lobby", new_show);
        }
      }

      if (!this.show_lobby && this.lobby_id) {
        var temp = this;
        var show = this.lobbies.filter(function(el) {
          return el.id == temp.lobby_id;
        });
        if (show.length > 0) {
          this.$set(this, 'show_lobby', show[0]);
        }
        this.lobby_id = null;
      }
    });
    this.$set(this.profilePopup, 'creator', this.show_lobby && this.user && this.show_lobby.creator_id == this.user.id);
  },
  beforeUpdate() {
    if (this.show_lobby && !this.lobby_socket) {
      this.$set(this, "lobby_socket", "Lobby" + this.show_lobby.id);
      this.$set(this.profilePopup, 'creator', this.show_lobby && this.user && this.show_lobby.creator_id == this.user.id);
      Echo.channel("Lobby" + this.show_lobby.id).listen(".message", (e2) => {
        this.$set(this.lobby_messages, this.lobby_messages.length, e2.data);
      });
    }

    if (!this.show_lobby && this.lobby_socket) {
      Echo.leave(this.lobby_socket);
      this.$set(this, 'lobby_socket', null);
    }

    if (this.user && this.user.lobby) {
      $("#popup_team1name").html(this.show_lobby.team1name);
      $("#popup_team2name").html(this.show_lobby.team2name);
      var templates1 = [];
      this.user.lobby.team1.forEach(function(el, index) {
        var template;
        if (el.ready == 1) {
          template = '<div class="player ready"><img src="' + el.user.avatar_medium + '"></div>';
        } else {
          template = '<div class="player"><img src="' + el.user.avatar_medium + '"></div>';
        }
        templates1[templates1.length] = template;
      });
      for (var i = 0; i < this.show_lobby.per_team - this.show_lobby.team1.length; ++i) {
        templates1[templates1.length1] = '<div class="player"></div>';
      }
      var templates2 = [];
      this.show_lobby.team2.forEach(function(el, index) {
        var template;
        if (el.ready == 1) {
          template = '<div class="player ready"><img src="' + el.user.avatar_medium + '"></div>';
        } else {
          template = '<div class="player"><img src="' + el.user.avatar_medium + '"></div>';
        }
        templates2[templates2.length] = template;
      });
      for (var i = 0; i < this.show_lobby.per_team - this.show_lobby.team1.length; ++i) {
        templates2[templates2.length] = '<div class="player"></div>';
      }
      $("#popup_team1").html(templates1.join(''));
      $("#popup_team2").html(templates2.join(''));
    }
  },
  methods: {
    changeType: function(val) {
      this.show_type = val;
      var show_lobbies = [];
      if (this.show_type == 1) {
        show_lobbies = this.lobbies.filter(function(el) {
          return el.state != 2
        });
      } else {
        show_lobbies = this.lobbies.filter(function(el) {
          return el.state == 2
        });
      }
      this.$set(this, 'show_lobbies', show_lobbies);
      this.$nextTick(function() {
        this.$refs.Lobbies.$refs.Scrollbar.scrollToY(0);
      });
    },
    showUser: function(new_show) {
      this.$set(this.profilePopup, 'player', new_show);
      this.$set(this.profilePopup, 'creator', this.show_lobby && this.user && this.show_lobby.creator_id == this.user.id);
      this.$set(this.profilePopup, 'kickMethod', this.kickPlayer);
      this.$set(this.profilePopup, 'moveMethod', this.movePlayer);
    },
    showLobby: function(lobby, e) {
      e.preventDefault();
      if ((this.user && !this.user.lobby) || !this.user) {
        this.$set(this, 'show_lobby', lobby);
        this.$nextTick(function() {
          initShowMore();
          if (typeof $(".game_preview#wrapper").offset() != 'undefined') {
            setTimeout(function() {
              $('html,body').animate({
                scrollTop: $(".game_preview#wrapper").offset().top
              });
            }, 200);
          }

        });
        this.$set(this, 'lobby_messages', []);
        if (this.lobby_socket) {
          Echo.leave(this.lobby_socket);
          this.$set(this, 'lobby_socket', null);
        }
      }
    },
    movePlayer: function(index, event) {
      event.preventDefault();
      if (!this.user) {
        alert("Вы не авторизованы");
        return;
      }
      if (this.user.lobby.state > 1) {
        alert("Игра уже началась");
        return;
      }
      if (!this.user.lobby) {
        alert("Вы не находитесь в комнате");
      } else {
        if (this.user.id != index && !(this.user.lobby.creator_id == this.user.id)) {
          alert("Вы не создатель комнаты");
        } else {
          $.post("/lobby/move", {
              move: index
            })
            .done(function(data) {
              if (data.error) {
                alert(data.message);
              }
            });
        }
      }
    },
    kickPlayer: function(index, event) {
      event.preventDefault();
      if (!this.user) {
        alert("Вы не авторизованы");
        return;
      }
      if (this.user.lobby.state > 1) {
        alert("Игра уже началась");
        return;
      }
      var text = "Вы действительно хотите исключить игрока?";
      if (index == this.user.id) {
        text = "Вы действительно хотите покинуть игру?";
      }
      if (!confirm(text)) {
        return;
      }
      if (!this.user.lobby) {
        alert("Вы не находитесь в комнате");
      } else {
        if (this.user.id != index && !(this.user.lobby.creator_id == this.user.id)) {
          alert("Вы не создатель комнаты");
        } else {
          $.post("/lobby/kick", {
              kick: index
            })
            .done(function(data) {
              alert(data.message);
            });
        }
      }
    }
  }
}
</script>

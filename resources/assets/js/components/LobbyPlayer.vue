<template>
  <div class="item" v-on:click="show_method(player)">
					<div class="preview_avatar">
						<div class="avatar" v-bind:class="{'admin': creator, 'users': !creator && player.user.id != -1}">
              <img v-if="lobby.players_hidden == 1 && user && player.user_id == user.id" :src="user.avatar_medium">
							<img v-else :src="player.user.avatar_medium">
						</div>
						<span v-if="lobby.players_hidden == 0" :class="'skill rank rank_' + player.user.own_rank">{{player.user.own_rank}}</span>
					</div>
          <div v-if="lobby.players_hidden == 1 && user && player.user_id == user.id" class="preview_name">{{user.name}}</div>
					<div v-else style="cursor: pointer" class="preview_name" v-on:click="openProfile()">{{player.user.name}}</div>
          <lobby-controls :kick_method="kick_method" :move_method="move_method" v-bind:user="user" v-bind:player="player" v-if="creator || (user && player.user_id == user.id)"></lobby-controls>
	</div>
</template>

<script>
export default {
  props: ['player', 'creator', 'show_method', 'user', 'kick_method', 'move_method', 'lobby'],
  components: {
    'lobby-controls': require('./LobbyControls.vue'),
  },
  methods: {
    openProfile: function() {
      if (this.player.user.id == -1) {
        return;
      }
      window.open("/user/" + this.player.user.id);
    }
  }
}
</script>

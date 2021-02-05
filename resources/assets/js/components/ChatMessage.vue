<template>
<div v-bind:class="[usermoderator ? 'item admin-send' : 'item']" v-if="channel_id == 0? ifDialog(message.to_userid, message.user_id, to_userid) : ifChannel(channel_id)">
    <div class="chat-avatar">
      <div class="avatar"><img :src="message.user.avatar_medium"></div>
      <div :class="'rank rank_' + message.user.own_rank">{{message.user.own_rank}}</div>
    </div>
      <div class="name" v-if="to_userid != -1"><a :href="'/user/' + message.user.id" target="_blank">{{message.user.name}}</a><span>{{message.created_at.substring(11, 16)}}</span></div>
      <div class="name" v-else><a>SYSTEM</a><span>{{message.created_at.substring(11, 16)}}</span></div>
    <div class="text">
      {{message.text}}
    </div>
    <a class="delete-send" v-if="moderator" v-on:click="deleteMessage"></a>
</div>
</template>

<script>
export default {
  props: ['message', 'moderator', 'usermoderator', 'to_userid', 'user', 'channel_id'],
  components: {
    'lobby-controls': require('./LobbyControls.vue'),
  },
  methods: {
    deleteMessage: function(e) {
      e.preventDefault();
      if (!confirm("Вы действительно хотите удалить сообщение?")) {
  			return;
  		}
      var temp = this;
  		$.post("/chat/delete", {id: temp.message.id})
  		.done(function(data) {
  			if (data.error) {
  				alert(data.message);
  			}
  		});
    },
    ifDialog: function(touserid, user_id, to_userid) {
      if (this.user && this.user.id == user_id || this.user.id == touserid) {
        if (user_id == to_userid || to_userid == touserid) {
          if (this.message.to_userid != null)
          return true;
        }
      }
    },
    ifChannel: function(channel_id) {
      if (this.message.to_userid == null && channel_id != 0) {
        return true;
      }
    }
  }
}
</script>

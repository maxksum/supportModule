<template>
<div class="content user-chat-block">
  <div class="rate"><a :href="'/user/' + user_online.id"><img :src="user_online.avatar_medium"></a></div>
  <div :class="'rank rank_' + user_online.csgo.own_rank">{{user_online.csgo.own_rank}}</div>
  <div class="letter" title="Написать сообщение" v-if="findDialog(user_online.id)" v-on:click="changeDialog(user_online.id)"></div>
  <div class="letter" title="Написать сообщение" v-else-if="!self" v-on:click="newDialog(user_online.id, user_online.name, 0)"></div>
  <div class="name"><a :href="'/user/' + user_online.id">{{user_online.name}}</a></div>
  <a :href="'https://overpro.ru/?lobby_id=' + user_online.lobby_id" class="play" v-if="play"></a>
</div>
</template>

<script>
	export default {
		props: ['user_online', 'play', 'newDialog', 'dialogs', 'to_userid', 'changeDialog', 'user', 'self'],
    methods: {
      findDialog: function(value) {
        for (var i = 0; i < this.dialogs.length; i++)
        if (this.dialogs[i]['id'] == value)
            return true;
      },
  }
	}
</script>

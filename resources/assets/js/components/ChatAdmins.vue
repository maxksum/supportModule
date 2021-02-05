<template>
<div class="content admin-chat-block">
  <div class="rate"><a :href="'/user/' + admin.id"><img :src="admin.avatar_medium"></a></div>
  <div :class="'rank rank_' + admin.csgo.own_rank">{{admin.csgo.own_rank}}</div>
  <div class="letter" v-if="findDialog(admin.id)" v-on:click="changeDialog(admin.id)"></div>
  <div class="letter" v-else-if="!self && user" v-on:click="newDialog(admin.id, admin.name)"></div>
  <div class="name"><a target="_blank" :href="'/user/' + admin.id">{{admin.name}}</a></div>
</div>
</template>

<script>
	export default {
  props: ['admin', 'newDialog', 'dialogs', 'to_userid', 'changeDialog', 'user', 'self'],
  methods: {
    findDialog: function(value) {
      for (var i = 0; i < this.dialogs.length; i++)
      if (this.dialogs[i]['id'] == value)
          return true;
    },
}

	}
</script>

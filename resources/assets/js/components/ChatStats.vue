<template>
<div class="head">
  <div class="item">Онлайн игроков:<span> {{online}}</span></div>
  <div class="item">Матчей за сутки:<span> {{today}}</span></div>
  <div class="item">Играет:<span> {{playing}}</span></div>
  <div class="item">Всего:<span> {{total}}</span></div>
  <a class="chat_head_close"></a>
</div>
</template>

<script>
export default {
  props: [],
  data: function() {
    return {
      today: counts.mixes_today,
      playing: counts.playing_now,
      total: counts.total_mixes,
      online: counts.users_online,
    }
  },
  created() {
    Echo.channel("Stats")
      .listen(".update", (e) => {
        //	this.$set(this, 'online', e.online);
        this.$set(this, 'today', e.mixes_today);
        this.$set(this, 'playing', e.playing_now);
        this.$set(this, 'total', e.total_mixes);
        this.$set(this, 'online', e.users_online.length);
      });
  },
  components: {
    'lobby-controls': require('./LobbyControls.vue'),
  }
}
</script>

<template lang="html">
  <div id="wrapper">
      <div class="header" id="header_div">
          <a href="/" class="logo"></a>
          <a href="/referral" class="free_coin"></a>

          <div class="anons_block">
              <div class="item">
                <span>{{news.title}}</span>
                 <p>{{news.text}}</p>
            </div>
          </div>

          <div class="players_online" id="header_stats">
          <div class="item">
            Онлайн игроков: <span>{{online}}</span>
          </div>
          <div class="item">
            Матчей за сутки: <span>{{today}}</span>
          </div>
          <div class="item">
            Играет: <span>{{playing}}</span>
          </div>
          <div class="item">
            Всего: <span>{{total}}</span>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  props: ['news'],
  data: function () {
    return {
      today: counts.mixes_today,
      playing: counts.playing_now,
      total: counts.total_mixes,
      online: counts.users_online.length,
    };
  },
  created() {
    Echo.channel("Stats")
      .listen(".update", (e) => {
        this.today = e.mixes_today;
        this.playing = e.playing_now;
        this.total = e.total_mixes;
        this.online = e.users_online.length;
      });
  }
}
</script>

<style lang="css">
</style>

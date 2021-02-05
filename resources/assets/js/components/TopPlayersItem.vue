<template lang="html">
  <div class="inner">
    <div class="item"><span>{{index + 1}}</span></div>
    <div class="item"><a :href="'/user/' + player.user.id" target="_blank">{{player.user.name > 15 ? player.user.name.substring(0, 12) + "..." : player.user.name}}</a></div>
    <div class="item"><span class="rank" v-bind:class="['rank_' + player.user.own_rank]">{{player.user.own_rank}}</span></div>
    <div class="item">{{player.exp}}</div>
    <div class="item">{{player.kills}}</div>
    <div class="item">{{player.deaths}}</div>
    <div class="item">{{player.kills == 0 ? 1 : Math.round((player.headshot_kills/player.kills)*100)}}%</div>
    <div class="item">{{player.assists}}</div>
    <div class="item">{{player.deaths == 0 ? 1 : (Math.round((player.kills/player.deaths)*100)/100).toFixed(2)}}</div>
    <div class="item">{{player.games == 0 ? 100 : Math.round((player.wins/player.games) * 100)}}%</div>
    <div class="item">{{player.games}}</div>
  </div>
</template>

<script>
export default {
  props: ['player', 'index'],
}
</script>

<style lang="css">
</style>

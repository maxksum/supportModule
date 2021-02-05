<template lang="html">
  <div class="minigames__item coin" v-on:click="selectMethod(2)">
    <div class="minigames__item-top">
      <div class="flip-container">
        <div class="flip-blocks">
          <a href="#" class="minigames__item-coin front-coin" style="background-image: url(/images/minigames-icon/coin.png);"	></a>
          <a href="#" class="minigames__item-coin reverse-coin" style="background-image: url(/images/minigames-icon/coin.png);"	></a>
        </div>
      </div>
      <span class="minigames__item-title">Монетка</span>
    </div>
    <div class="minigames__item-bottom">
      <div class="minigames__item-bet">
        <span>{{count}}</span>
        <div class="circle" style="background-image: url(/images/minigames-icon/user.png);"></div>
      </div>
      <div class="minigames__item-bet">
        <span v-if="timer>0">{{timer}}</span>
        <span v-else>бросок</span>
        <div class="circle" style="background-image: url(/images/game/clock.png);"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['selectMethod'],
  data: function(){
    return {
      count: 0,
      timer: 15
    }
  },
  methods: {
    fill: function(e) {
      this.count = e.game.tail_count + e.game.head_count
      this.timer = e.timer
    },
    tick: function(){
      this.timer--;
    },
  },
  mounted: function(){
    setInterval(this.tick, 1000)
    axios
      .get('/coinflip')
      .then(response => (this.fill(response.data)));

    Echo.channel("Coinflip")
      .listen(".join", (e) => {
        this.count++
      })
      .listen(".spin", (e) => {
        this.count = 0
        this.timer = 15
      })

  }

}
</script>

<style lang="css">
</style>

<template lang="html">
  <div class="minigames__item crash"  v-on:click="selectMethod(1)">
    <div class="minigames__item-top">
      <div class="flip-container">
        <div class="flip-blocks">
          <a href="#" class="minigames__item-coin front-coin" style="background-image: url(/images/minigames-icon/crash.png);"	></a>
          <a href="#" class="minigames__item-coin reverse-coin" style="background-image: url(/images/minigames-icon/crash.png);"	></a>
        </div>
      </div>
      <span class="minigames__item-title">Крушение</span>
    </div>
    <div class="minigames__item-bottom">
      <div class="minigames__item-bet">
        <span>15</span>
        <div class="circle" style="background-image: url(/images/minigames-icon/user.png);"	></div>
      </div>
      <div class="minigames__item-bet">
        <span>x4.3</span>
        <!-- <div class="circle" style="background-image: url(/images/game/par.png);"	></div> -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['selectMethod']
}
</script>

<style lang="css">
</style>

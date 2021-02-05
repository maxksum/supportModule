<template lang="html">
  <div id="wrapper" class="tournament">
    <div class="tournament_block">
      <div class="frame"><img :src="tourney.image" class="tour_bg"></div>
      <div class="send">
        <div class="text">
        <span v-on:click="openLink" style="cursor: pointer;">ВОПРОСЫ</span>
      </div>
      <div class="info">Регистрация VK</div>
      <a :href="tourney.link" target="_blank"><span>ЗАРЕГИСТРИРОВАТЬ КОМАНДУ</span> <p>Перейти к регистрации команды</p></a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['tourney'],
  methods: {
    openLink: function(e) {
      e.preventDefault();
      window.open(this.tourney.link, '_blank');
    }
  }
}
</script>

<style lang="css">
</style>

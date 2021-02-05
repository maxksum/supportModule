<template lang="html">
  <div id="wrapper" class="rank_all_stats_general">
  	<div class="rank_tabs_block">
  		<div class="rank_items">
  			<top-header v-for="(top, index) in tops" :top="top" :index="index" :key="index" :activeItem="index == 0" :clickMethod="changeTop"></top-header>
  		</div>
  	</div>
  	<a href="#rank_stats_block" class="show_more_info" id="showMore">СМОТРЕТЬ ТЕКУЩИХ ЛИДЕРОВ</a>
  	<div class="rank_stats_block" id="rank_stats_block">
  		<div class="head">
  			<div class="item">#</div>
  			<div class="item">Никнейм игрока</div>
  			<div class="item">&nbsp;</div>
  			<div class="item">ELO</div>
  			<div class="item">Фрагов</div>
        <div class="item">Смертей</div>
  			<div class="item">Хедшотов</div>
  			<div class="item">Ассистов</div>
  			<div class="item">KD рейтинг</div>
  			<div class="item">% Побед</div>
  			<div class="item">Игр</div>
  		</div>
  		<div class="body scrollPro" id="top_block">
        <top-player v-for="(player, index) in players" :player="player" :index="index" :key="index"></top-player>
  		</div>
  	</div>
  </div>
</template>

<script>
export default {
  props: ['tops'],
  data: function() {
    return {
      players: []
    };
  },
  components: {
    'top-header': require('./TopHeader.vue'),
    'top-player': require('./TopPlayersItem.vue'),
  },
  created() {
    this.$set(this, 'players', this.tops[0].players);
  },
  methods: {
    changeTop: function (index, event) {
      this.$set(this, 'players', this.tops[index].players);
      this.$nextTick(function() {
        $("#top_block").children(".inner").appendTo("#top_block .mCSB_container");
        $("#top_block").mCustomScrollbar("update");
      });
    }
  }
}
</script>

<style lang="css">
</style>

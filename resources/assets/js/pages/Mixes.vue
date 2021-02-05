<template lang="html">
  <div id="wrapper" class="history_game">
  		<div class="history_block">
  			<div class="title">TEAM 1</div>
  			<div class="head">
  				<div class="item">Создатель</div>
  				<div class="item">Карта</div>
  				<div class="item">Режим</div>
  				<div class="item">Ставка</div>
  				<div class="item">Время</div>
  				<div class="item">Победитель</div>
  				<div class="item">&nbsp;</div>
  			</div>
  			<div class="body">
  				<div class="inner" v-for="(mix, key) in mixes.data" :key="key">
  					<div class="item"><div class="avatar users"><img :src="mix.creator.avatar_medium"></div><a :href="'/user/' + mix.creator.id">{{mix.creator.name}}</a></div>
            <div class="item praised">{{mix.map.name}}</div>
  					<div class="item">{{mix.per_team}}x{{mix.per_team}}</div>
  					<div class="item">{{Math.floor(mix.player_bet / money_multiplier)}}</div>
  					<div class="item">{{mix.created_at}}</div>
  					<div class="item" v-if="mix.game_status == 2">{{mix.winner_team == 1 ? mix.team1name : mix.team2name}}</div>
            <div class="item" v-else>СБРОС</div>
  					<div class="item"><a :href="'/mix/' + mix.id" class="history_stats with_title" title="Посмотреть статистику матча"></a></div>
  				</div>
  			</div>
  			<div class="pagination">
  				<ul>
            <li><div class="pages">Страница <span>{{mixes.current_page}}</span> из <span>{{mixes.last_page}}</span></div></li>
  					<li v-if="mixes.prev_page_url"><a :href="mixes.prev_page_url"><</a></li>
  					<li v-if="mixes.next_page_url"><a :href="mixes.next_page_url">></a></li>
  				</ul>
  			</div>
  		</div>
  	</div>
</template>

<script>
export default {
  data: function() {
    return {
      mixes: mixes,
      money_multiplier: money_multiplier
    }
  }
}
</script>

<style lang="css">
</style>

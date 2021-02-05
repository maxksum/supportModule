<template>
	<div class="inner">
		<div class="item"><span>{{lobby.team1name}}</span> vs <span>{{lobby.team2name}}</span></div>
		<div class="item" v-if="lobby.players_hidden == 0"><span class="rank" :class="['rank_' + lobby.creator.own_rank]">{{lobby.creator.own_rank}}</span>&nbsp;<a :href="'/user/' + lobby.creator.id" target="_blank">{{lobby.creator.name.length > 15 ? lobby.creator.name.substring(0, 12) + "..." : lobby.creator.name}}</a></div>
		<div class="item" v-else>{{lobby.creator.name.length > 15 ? lobby.creator.name.substring(0, 12) + "..." : lobby.creator.name}}</div>
		<div class="item">{{Math.floor(lobby.bet / money_multiplier)}}</div>
		<div class="item">{{lobby.prize}}</div>
		<div class="item">{{lobby.team1.length + lobby.team2.length}}/{{lobby.per_team * 2}}</div>
		<div class="item"><img :src="lobby.map.image"></div>
		<div class="item"><img :src="'/images/game/ico-' + (lobby.eac == 1 ? 'on':'off') + '.png'"></div>
		<div class="item"><img :src="'/images/game/ico-' + (lobby.auto_balance == 1 ? 'on':'off') + '.png'"></div>
		<div class="item"><img :src="'/images/game/ico-' + (lobby.players_hidden == 1 ? 'on':'off') + '.png'"></div>
		<div class="item"><span class="rank" v-bind:class="'rank_' + lobby.skill_from">{{lobby.skill_from}}</span>&nbsp; - &nbsp;<span class="rank"  v-bind:class="'rank_' + lobby.skill_to">{{lobby.skill_to}}</span></div>
		<div class="item"><span>{{lobby.location.name}}</span></div>
		<div class="item">{{lobby.time}} минут(ы)</div>
		<div class="item"><a href="#" v-on:click="show_method(lobby, $event)">Войти</a></div>
	</div>
</template>

<script>
	export default {
		props: ['lobby', 'show_method'],
		data: () => {
			return {
				money_multiplier: money_multiplier
			}
		}
	}
</script>

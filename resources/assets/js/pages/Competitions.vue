<template lang="html">
  <div class="container">
		<div class="competition">
			<nav class="competition__nav">
				<ul class="h-reset-list competition__nav-list">
					<li :class="{active: sortType == -1}">
						<a href="#" @click="sortType = -1">Все соревнования</a>
					</li>
					<li :class="{active: sortType == 0}">
						<a href="#" @click="sortType = 0">Ладдеры</a>
					</li>
					<li :class="{active: sortType == 1}">
						<a href="#" @click="sortType = 1">Турниры</a>
					</li>
					<li>
						<router-link :to="{name: 'CompetitionPartners'}">Рейтинг партнеров</router-link>
					</li>
				</ul>
			</nav>
			<div class="competition__items">
				<div class="competition__item" v-for="competition in sortedCompetitions">
					<div class="competition__item-top">
						<div class="competition__item-top-name">{{ competition.name }}</div>
						<div v-show="competition.id > 1" class="competition__item-top-icon">
							<i class="ico ico-on"></i>
							<span>идет</span>
						</div>
						<div v-show="competition.id == 1" class="competition__item-top-icon">
							<i class="ico ico-infinity_white"></i>
						</div>
					</div>
					<div class="competition__item-img h-object-fit">
						<img :src="competition.img_small" alt="">
					</div>
					<div class="competition__item-descr">
						<div class="competition__item-descr-main">
							<div class="competition__item-descr-main-item">
								<div class="competition__item-descr-main-item-name">Участие</div>
								<div class="competition__item-descr-main-item-value"><b>FREE</b></div>
							</div>
							<div class="competition__item-descr-main-item">
								<div class="competition__item-descr-main-item-name">Участники</div>
								<div class="competition__item-descr-main-item-value">{{ competition.users_count }} {{ declOfNum(competition.users_count, ['игрок', 'игрока', 'игроков']) }}</div>
							</div>
						</div>
						<router-link v-show="!competition.user_place" :to="{name: 'CompetitionItem', params: {short_name: competition.short_name}}" class="competition__item-descr-bot">Подробнее</router-link>
						<router-link v-show="competition.user_place" :to="{name: 'CompetitionItem', params: {short_name: competition.short_name}}" class="competition__item-descr-bot competition__item-descr-bot_participant">Вы на {{ competition.user_place }}-м месте!</router-link>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			competitions: [],
			sortType: -1,
		}
	},

	methods: {
		fetchData() {
			axios.get('/competition/api/get').then(response => {
				this.competitions = response.data;
			}).catch((error) => {
				setTimeout(this.fetchData, 5000);
			});
		},
		declOfNum(number, titles) {  
			let cases = [2, 0, 1, 1, 1, 2];  
			return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];  
		}
	},
	computed: {
		sortedCompetitions() {
			if(this.sortType == -1) {
				return this.competitions;
			}

			return this.competitions.filter(c => {
				return c.type === this.sortType
			});
		}
	},

	created() {
		this.fetchData();
	}
}
</script>

<style lang="css">
</style>

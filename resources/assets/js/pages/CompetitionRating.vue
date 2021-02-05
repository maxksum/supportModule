<template lang="html">
  <div class="container">
    			<div class="competition-rating__wrap">
				<div class="c-breadcrumbs">
					<ul class="h-reset-list breadcrumbs__list">
						<li><a href="#">Главная</a></li>
						<li><router-link :to="{name: 'Competitions'}">Соревнования</router-link></li>
						<li><span>{{ competition.name }}</span></li>
					</ul>
				</div>
				<h1 class="h1">{{ competition.name }}</h1>
				<nav class="competition__nav competition__nav-start">
					<ul class="h-reset-list competition__nav-list">
						<li>
							<router-link :to="{name: 'CompetitionItem', params: {short_name: competition.short_name}}">Описание</router-link>
						</li>
						<li class="active">
							<a href="#">Текущий рейтинг</a>
						</li>
						<li>
							<a href="#">Правила</a>
						</li>
					</ul>
					<div class="competition__nav-start-time">
						<span v-show="competition.id > 1"><i class="ico ico-on"></i> идет</span>
						<span v-show="competition.id == 1"><i class="ico ico-infinity_white"></i></span>
						<a href="#" class="competition__nav-start-time-share"><i class="ico ico-share"></i></a>
					</div>
				</nav>
				<table class="rating-table">
					<thead>
						<tr>
							<th class="rating-table-start">
								Место
							</th>
							<th class="rating-table-start">
								Игрок
							</th>
							<th>
								Рейтинг
							</th>
							<th>
								Игр
							</th>
							<th>
								Винрейт
							</th>
							<th>
								КДА
							</th>
						</tr>
					</thead>
					<tbody>
						<tr :class="{'rating-table-leader': i < 3, 'rating-table-start': i >= 3, 'rating-table-current': user && user.id == player.user_id}" v-for="(player, i) in filteredRating">
							<td class="rating-table-start">
								<span class="rating-table-place" :class="{'rating-table-place_bgc': i < 3}">
									<span>{{ i + 1 }}</span>
								</span>
								<span class="rating-table-place_up" style="display: none;">
									<i class="ico ico-arrow-up"></i>
									<span>5</span>
								</span>
							</td>
							<td class="rating-table-start">
								<a :href="'/user/' + player.user_id" class="rating-table-icon h-object-fit">
									<img :src="player.avatar" alt="">
								</a>
								<span>{{ player.name }}</span>
							</td>
							<td>{{ player.elo }}</td>
							<td>{{ player.games }}</td>
							<td>{{ player.win_rate }}%</td>
							<td>{{ player.kda }}</td>
						</tr>
						<tr class="rating-table-current" v-show="rating.length == 0">
							<td colspan="6">Загрузка</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
</template>

<script>
export default {
	data() {
		return {
			competition: {},
			user: {},
			rating: []
		}
	},

	methods: {
		fetchData() {
			axios.get('/competition/api/get/' + this.$route.params.short_name).then(response => {
				this.competition = response.data;
			}).catch((error) => {
				setTimeout(this.fetchData, 5000);
			});
		}
	},
	watch: {
		competition() {
			axios.get(this.competition.rating_data_url).then(response => {
				this.rating = response.data;
			});
		}
	},
	computed: {
		filteredRating() {
			return this.rating.slice(0, 100);
		}
	},
	created() {
		this.fetchData();
		this.user = user;
	}
}
</script>

<style lang="css">
</style>

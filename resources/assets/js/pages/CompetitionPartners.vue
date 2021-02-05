<template lang="html">
  <div class="container">
			<div class="competition-rating__wrap">
				<nav class="competition__nav">
					<ul class="h-reset-list competition__nav-list">
						<li>
							<router-link :to="{name: 'Competitions'}">Все соревнования</router-link>
						</li>
						<li>
							<a href="#">Турниры</a>
						</li>
						<li>
							<a href="#">Ладдеры</a>
						</li>
						<li class="active">
							<a href="#">Рейтинг партнеров</a>
						</li>
					</ul>
				</nav>
				<div class="rating-banner">
					<div class="rating-banner__img h-object-fit">
						<img src="/images/tournament.jpg" alt="">
					</div>
					<button type="button" class="rating-banner__close">
						<i class="ico ico-close_white"></i>
					</button>
					<div class="rating-banner__cont">
						<div class="rating-banner__cont-descr">О партнерстве</div>
						<a href="#" class="btn btn_sm btn_white">Узнать свою ссылку</a>
					</div>
				</div>
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
								Привлечено
							</th>
							<th>
								Зарботано денег
							</th>
							<th>
								Всего переходов
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
								<a :href="'/user/' + player.referrer_id" class="rating-table-icon h-object-fit">
									<img :src="player.avatar" alt="">
								</a>
								<span>{{ player.name }}</span>
							</td>
							<td>{{ player.rating }}</td>
							<td>{{ player.referral_count }}</td>
							<td>{{ player.profit }}</td>
							<td>{{ player.referral_conversions }}</td>
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
			user: {},
			rating: []
		}
	},

	methods: {
		fetchData() {
			axios.get('/competition/api/referal/').then(response => {
				this.rating = response.data;
			}).catch((error) => {
				setTimeout(this.fetchData, 5000);
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

<template lang="html">
  <div class="container">
	<div class="competition-one__wrap">
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
				<li class="active">
					<a href="#">Описание</a>
				</li>
				<li>
					<router-link :to="{name: 'CompetitionRating', params: {short_name: competition.short_name}}">Текущий рейтинг</router-link>
				</li>
				<li>
					<router-link :to="{name: 'CompetitionRules', params: {short_name: competition.short_name}}">Правила</router-link>
				</li>
			</ul>
			<div class="competition__nav-start-time">
				<span v-show="competition.id > 1"><i class="ico ico-on"></i> идет</span>
				<span v-show="competition.id == 1"><i class="ico ico-infinity_white"></i></span>
				<a href="#" class="competition__nav-start-time-share"><i class="ico ico-share"></i></a>
			</div>
		</nav>
		<div class="competition-one__banner">
			<div class="competition-one__banner-main h-object-fit">
				<img :src="competition.img_big" alt="">
			</div>
			<div class="competition-one__banner-sponsor">
				<div class="competition-one__banner-sponsor-img h-object-fit">
					<img src="/images/game/big-img.png" alt="">
				</div>
				<div class="competition-one__banner-sponsor-descr">
					<span>Спонсор</span>
				</div>
			</div>
		</div>

		<div class="competition__info">
			<div class="competition__info-item">
				<div class="competition__info-item-head">
					Участие
				</div>
				<div class="competition__info-item-body">
					{{ competition.desc_1 }}	
				</div>
				<div class="competition__info-item-footer">
					<a href="#" class="btn btn_md btn_bold btn_yellow btn_100">Регистрация в турнире</a>
				</div>
			</div>
			<div class="competition__info-item">
				<div class="competition__info-item-head">
					Награда
				</div>
				<div class="competition__info-item-body">
					{{ competition.desc_2 }}
				</div>
				<div class="competition__info-item-footer">
					<a href="#" class="btn btn_md btn_bold btn_yellow btn_100">Читать правила</a>
				</div>
			</div>
			<div class="competition__info-item">
				<div class="competition__info-item-head">
					Участники
				</div>
				<div class="competition__info-item-body">
					<div class="competition__info-item-body-players">
						<div class="competition__info-item-body-player" v-for="player in filteredRating">
							<a :href="'/user/' + player.user_id" class="competition__info-item-body-player-icon h-object-fit">
								<img :src="player.avatar" alt="">
							</a>
							<div class="competition__info-item-body-player-name">{{ player.name }}</div>
							<div class="competition__info-item-body-player-rating">{{ player.elo }}</div>
						</div>
					</div>
				</div>
				<div class="competition__info-item-footer">
					<router-link :to="{name: 'CompetitionRating', params: {short_name: competition.short_name}}" class="btn btn_md btn_bold btn_yellow btn_100">Смотреть всех</router-link>
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
			competition: {},
			rating: [],
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
			return this.rating.slice(0, 5);
		}
	},
	created() {
		this.fetchData();
	}
}
</script>

<style lang="css">
</style>

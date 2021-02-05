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
						<li>
							<router-link :to="{name: 'CompetitionRating', params: {short_name: competition.short_name}}">Текущий рейтинг</router-link>
						</li>
						<li class="active">
							<a href="#">Правила</a>
						</li>
					</ul>
					<div class="competition__nav-start-time">
						<span v-show="competition.id > 1"><i class="ico ico-on"></i> идет</span>
						<span v-show="competition.id == 1"><i class="ico ico-infinity_white"></i></span>
						<a href="#" class="competition__nav-start-time-share"><i class="ico ico-share"></i></a>
					</div>
				</nav>

				<div class="specification__info">
					<div class="competition__info-item">
						<div class="competition__info-item-head">
							Участие
						</div>
						<div class="competition__info-item-body">
							{{ competition.rules_1 }}
						</div>
					</div>
					<div class="competition__info-item">
						<div class="competition__info-item-head">
							Процесс
						</div>
						<div class="competition__info-item-body">
							{{ competition.rules_2 }}
						</div>
					</div>
					<div class="competition__info-item">
						<div class="competition__info-item-head">
							Награда
						</div>
						<div class="competition__info-item-body">
							{{ competition.rules_3 }}
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
	created() {
		this.fetchData();
	}
}
</script>

<style lang="css">
</style>

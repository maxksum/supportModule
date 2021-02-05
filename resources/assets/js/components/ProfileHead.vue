<template>
    <div class="profile">
      <div class="profile_balance">
        Баланс: <span class="coin20">{{Math.floor(user.money / money_multiplier)}} &nbsp;</span>
      </div>
      <div class="profile_avatar">
        <div class="first_avatar users">
          <a :href="'/user/' + user.id"><img :src="user.avatar_medium"></a>
        </div>
      </div>
        <div class="first_name"><a :href="'/user/' + user.id">{{user.name.length > 17 ? user.name.substring(0, 14) + "..." : user.name}}</a></div>
        <div class="sub">
            <div class="sub_head">
                <div class="avatar users">
                  <a :href="'/user/' + user.id">  <img :src="user.avatar_medium"></a>
                </div>
                <div class="name">{{user.name}}</div>
                <div class="skill">{{user.csgo.own_rank_full}}</div>
                <div class="balance">
                    <a href="/items/withdraw" class="with_title" title="Снять&nbsp;деньги">-</a>
                    <span>{{Math.floor(user.money / money_multiplier)}}</span>
                    <a href="/items/deposit" class="with_title" title="Пополнить&nbsp;счёт">+</a>
                </div>
            </div>

            <ul class="profile_nav">
                <li>
                    <a :href="'/user/' + user.id">ПЕРЕЙТИ В ПРОФИЛЬ</a>
                </li>
                <li>
                    <a href="/items/deposit">ПОПОЛНИТЬ БАЛАНС</a>
                </li>
                <li>
                    <a href="/items/withdraw">МАГАЗИН</a>
                </li>
                <li>
                    <a href="/report">ФИНАНСОВЫЙ ОТЧЕТ</a>
                </li>
                <li>
                    <a href="/referral">ПРИВЕДИ ДРУГА</a>
                </li>
                <!-- <li>
                    <a href="#">ПРИВЯЗАТЬ TWITCH</a>
                </li>
                <li>
                    <a href="#">ПРИВЯЗАТЬ YOUTUBE</a>
                </li> -->
                <li>
                    <a href="/" v-on:click="logout">ВЫЙТИ ИЗ АККАУНТА</a>
                </li>

                <li v-if="user && (user.role == 'moderator' || user.role == 'administrator')">
                    <a href="/admin">АДМИН-ПАНЕЛЬ</a>
                </li>
            </ul>
            <!-- <div class="challenge_block">
						<div class="title">МОИ ЕЖЕДНЕВНЫЕ ЦЕЛИ</div>
						<div class="challenge">
							<div class="item">
								<div class="left">
									<div class="mission">Сыграть 5 матчей за 24 часа</div>
									<div class="load">
					                    <div class="fixed-width">
					                        <div class="line"></div>
					                    </div>
					                </div>
					                <div class="count">
					                	<div class="min">11</div> <span>/</span> <div class="max">200</div>
					                </div>
								</div>
								<div class="right">
									<div class="reward">50</div>
								</div>
							</div>
							<div class="item">
								<div class="left">
									<div class="mission">Сыграть 5 матчей за 24 часа</div>
									<div class="load">
					                    <div class="fixed-width">
					                        <div class="line"></div>
					                    </div>
					                </div>
					                <div class="count">
					                	<div class="min">33</div> <span>/</span> <div class="max">200</div>
					                </div>
								</div>
								<div class="right">
									<div class="reward">50</div>
								</div>
							</div>
							<div class="item">
								<div class="left">
									<div class="mission">Сыграть 5 матчей за 24 часа</div>
									<div class="load">
					                    <div class="fixed-width">
					                        <div class="line"></div>
					                    </div>
					                </div>
					                <div class="count">
					                	<div class="min">66</div> <span>/</span> <div class="max">200</div>
					                </div>
								</div>
								<div class="right">
									<div class="reward">50</div>
								</div>
							</div>
							<div class="item">
								<div class="left">
									<div class="mission">Сыграть 5 матчей за 24 часа</div>
									<div class="load">
					                    <div class="fixed-width">
					                        <div class="line"></div>
					                    </div>
					                </div>
					                <div class="count">
					                	<div class="min">99</div> <span>/</span> <div class="max">200</div>
					                </div>
								</div>
								<div class="right">
									<div class="reward">50</div>
								</div>
							</div>
							<div class="item">
								<div class="left">
									<div class="mission">Сыграть 5 матчей за 24 часа</div>
									<div class="load">
					                    <div class="fixed-width">
					                        <div class="line"></div>
					                    </div>
					                </div>
					                <div class="count">
					                	<div class="min">146</div> <span>/</span> <div class="max">200</div>
					                </div>
								</div>
								<div class="right">
									<div class="reward">50</div>
								</div>
							</div>
						</div>
					</div> -->
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data: (e) => {
          return {
            money_multiplier: money_multiplier
          }
        },
		methods: {
			logout: function(e) {
				e.preventDefault();
				$.post("/user/logout")
				.then(function(data) {
					location.reload();
				});

				;
			}
		}
    }
</script>

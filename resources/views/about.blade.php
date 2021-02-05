<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="title"/>
<meta name="keywords" content="title"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>eSports Battle Games</title>
<!---->
<link rel="stylesheet" href="/promo/css/style.css?{{$rev}}" type="text/css" />
<link rel="stylesheet" href="/promo/css/media.css?{{$rev}}" type="text/css" />
<link rel="stylesheet" href="/promo/css/animate.css?{{$rev}}" type="text/css" />
<link rel="stylesheet" href="/promo/css/select.css?{{$rev}}" type="text/css" />
<link rel="stylesheet" href="/promo/css/nouislider.css?{{$rev}}" type="text/css" />
<link rel="stylesheet" href="/promo/css/jquery.mCustomScrollbar.css?{{$rev}}" type="text/css" />
<!---->
<script type="text/javascript" src="/promo/js/jquery-1.11.3.min.js?{{$rev}}"></script>
<script type="text/javascript" src="/promo/js/js.js?{{$rev}}"></script>
<script type="text/javascript" src="/promo/js/step.js?{{$rev}}"></script>
<script type="text/javascript" src="/promo/js/select.js?{{$rev}}"></script>
<script type="text/javascript" src="/promo/js/nouislider.js?{{$rev}}"></script>
<script type="text/javascript" src="/promo/js/jquery.mCustomScrollbar.js?{{$rev}}"></script>
<script type="text/javascript">
	$(function() {
		var spinner = $("#spinner").spinner();
    	$("#spinner").each(function(){
    		var count = $(this).attr('step');
    		$(this).spinner({
	  			step: count,
	  			min: 0
			});
    	});
	});
	$(function() {
		var spinner1 = $("#spinner1").spinner();
    	$("#spinner1").each(function(){
    		var count = $(this).attr('step');
    		$(this).spinner({
	  			step: count,
	  			min: 0
			});
    	});
	});
	$(function() {
		var spinner2 = $("#spinner2").spinner();
    	$("#spinner2").each(function(){
    		var count = $(this).attr('step');
    		$(this).spinner({
	  			step: count,
	  			min: 0
			});
    	});
	});

	$(document).ready(function(){
		var slider = document.getElementById('param');
		noUiSlider.create(slider, {
			start: [20, 80],
			connect: true,
			range: {
				'min': 0,
				'max': 100
			}
		});
	});
	$(document).ready(function(){
		var slider = document.getElementById('param2');
		noUiSlider.create(slider, {
			start: [20, 80],
			connect: true,
			range: {
				'min': 0,
				'max': 100
			}
		});
	});
	$(document).ready(function(){
		var slider = document.getElementById('param3');
		noUiSlider.create(slider, {
			start: [20, 80],
			connect: true,
			range: {
				'min': 0,
				'max': 100
			}
		});
	});
</script>
</head>
<body class="overflow">
<div id="general">
	<div id="bg"></div>
	<!--======================================-->
	<!--====navigation====-->
	<div id="navigation">
		<div id="nav-inner">
			<!--======================================-->
			<!--====выбор игры====-->
			<div class="nav-left" id="nav-left">
				<div class="text">Выберите игру:</div>
				<div class="activ"><a href="#"><span>CS:GO</span> <img src="/promo/images/ico-game-csgo.png"></a></div>
			</div>
			<div class="leftSub">
				<a href="#">
					<div class="img">
						<img src="/promo/images/ico-game-dota2.png">
					</div>
					<span>DOTA 2 ( СКОРО )</span>
				</a>
				<a href="#">
					<div class="img">
						<img src="/promo/images/ico-game-cs.png">
					</div>
					<span>COUNTER-STRIKE 1.6 ( СКОРО )</span>
				</a>
				<a href="#">
					<div class="img">
						<img src="/promo/images/ico-game-lol.png">
					</div>
					<span>LEAGUE OF LEGENDS ( СКОРО )</span>
				</a>
				<a href="#">
					<div class="img">
						<img src="/promo/images/ico-game-hs.png">
					</div>
					<span>HEARTHSTONE ( СКОРО )</span>
				</a>
			</div>
			<!--======================================-->
			<!--====выбор языка====-->
			<div class="nav-right">
				<div class="text">Выберите язык:</div>
				<div class="activ">
					<a href="/about">
						<span>RUS</span>
						<div class="img">
							<img src="/promo/images/ico-rus.png">
						</div>
					</a>
				</div>
			</div>
			<div class="rightSub">
				<a href="/en/about">
					<div class="img">
						<img src="/promo/images/ico-en.png">
					</div>
					<span>ENG</span>
				</a>
			</div>
			<!--======================================-->
			<!--====social====-->
			<div class="social">
				<span>Мы в социальных сетях:</span>
				<a href="https://discordapp.com/channels/340801623297097728/340805285608292352"><img src="/promo/images/ico-soc-1.png"></a>
				<a href="http://vk.com/overpro"><img src="/promo/images/ico-soc-2.png"></a>
				<a href=""><img src="/promo/images/ico-soc-3.png"></a>
				<a href="https://www.youtube.com/user/wwwoverproru"><img src="/promo/images/ico-soc-4.png"></a>
				<a href="http://steamcommunity.com/groups/overproru"><img src="/promo/images/ico-soc-5.png"></a>
			</div>
		</div>
	</div>
	<!--======================================-->
		<!--====header====-->
	<div id="wrapper">
		<!--======================================-->
		<!--====header====-->
		<div class="header">
			<a href="/" class="logo"></a>

			<div class="header_text_land">
				<span>ПРОКАЧИВАЙ СКИЛЛ В БОЯХ С СОПЕРНИКАМИ СИЛЬНЕЕ СЕБЯ</span>
				ГДЕ ПОБЕДА ИМЕЕТ ЦЕНУ - ЭТО СПОРТ, А НЕ ИГРА
			</div>
			<!--======================================-->
			<!--====profile====-->
			<div class="profile" style="display: none;">
				<div class="profile_avatar">
					<div class="avatar users">
						<img src="/promo/images/ava.png">
					</div>
					<span class="rank">LS</span>
				</div>
				<div class="name">CyberBattler</div>
				<div class="balance">
					<a href="#" class="with_title" title="Снять&nbsp;деньги">-</a>
					<span>18 659 RUR</span>
					<a href="#" class="with_title" title="Пополнить&nbsp;счёт">+</a>
				</div>

				<div class="sub">
					<div class="sub_head">
						<div class="avatar users">
							<img src="/promo/images/ava.png">
						</div>
						<div class="name">CyberBattler</div>
						<div class="skill">Medium skill</div>
						<div class="balance">
							<a href="#" class="with_title" title="Снять&nbsp;деньги">-</a>
							<span>18 659 RUR</span>
							<a href="#" class="with_title" title="Пополнить&nbsp;счёт">+</a>
						</div>
					</div>

					<div class="sub_count">
						<span>65%</span>
						<span>65%</span>
						<span>65%</span>
						<span>65%</span>
					</div>

					<ul class="profile_nav">
						<li>
							<a href="#">ПЕРЕЙТИ В ПРОФИЛЬ</a>
						</li>
						<li>
							<a href="#">РЕДАКТИРОВАТЬ ПРОФИЛЬЬ</a>
						</li>
						<li>
							<a href="#">ПОПОЛНИТЬ БАЛАНС</a>
						</li>
						<li>
							<a href="#">ФИНАНСОВЫЙ ОТЧЕТ</a>
						</li>
						<li>
							<a href="#">ПРИВЕДИ ДРУГА</a>
						</li>
						<li>
							<a href="#">ПРИВЯЗАТЬ TWITCH</a>
						</li>
						<li>
							<a href="#">ПРИВЯЗАТЬ YOUTUBE</a>
						</li>
						<li>
							<a href="#">ВЫЙТИ ИЗ АККАУНТА</a>
						</li>
					</ul>
				</div>
			</div>

			<a href="/login" class="login_steam">
				<span>ВОЙТИ И ИГРАТЬ</span>
				<p>Авторизуйтесь с помощью Steam</p>
			</a>
		</div>
	</div>
	<!--======================================-->
	<!--====block====-->
	<div id="wrapper" class="">
		<div class="top_info_land">
			<div class="item">
				Играй <span>бесплатно</span> или на <span>скины</span>
			</div>
			<div class="item">
				Выбирай <span>соперников любого уровня</span>
			</div>
			<div class="item">
				Анализируй <span>детальную статистику</span>
			</div>
		</div>
	</div>
	<!--======================================-->
	<!--====setting====-->
	<div id="wrapper" class="">
		<div class="landing_title">
			<div class="land_count">1</div>
			<div class="land_text">ЖМИ КНОПКУ <span>СОЗДАТЬ ИГРУ. УКАЗЫВАЙ ПАРАМЕТРЫ МАТЧА И ЛЮБУЮ СТАВКУ</span></div>
		</div>
	</div>

	<div id="wrapper" class="setting">
		<form class="sets" method="" action="">
			<div class="first">
				<div class="item">
					<label>Приз команде:</label>
					<input id="spinner" name="value" value="100" step="100" disabled>
				</div>
				<div class="item">
					<label>Кол-во игроков:</label>
					<select class="turnintodropdown">
						<option>1х1</option>
						<option>3х3</option>
						<option>5х5</option>
						<option>10х10</option>
					</select>
				</div>
				<div class="item">
					<label>Карта:</label>
					<select class="turnintodropdown">
						<option>Aim Map</option>
						<option>Aim Map x2</option>
						<option>Aim Map x3</option>
						<option>Aim Map x4</option>
					</select>
				</div>
				<div class="item">
					<label>Античит:</label>
					<select class="turnintodropdown">
						<option>Вкл. EAC</option>
						<option>Выкл. EAC</option>
					</select>
				</div>
				<div class="item">
					<label>Локация:</label>
					<select class="turnintodropdown">
						<option>1х1</option>
						<option>3х3</option>
						<option>5х5</option>
						<option>10х10</option>
					</select>
				</div>
			</div>

			<div class="second">
				<div class="item">
					<label>Название К1:</label>
					<input type="text" name="" placeholder="Red Team" value="Red Team" required/>
				</div>
				<div class="item">
					<label>Название К2:</label>
					<input type="text" name="" placeholder="Blue Team" value="Blue Team" required/>
				</div>
				<div class="item">
					<label>Автобаланс:</label>
					<select class="turnintodropdown">
						<option>Да</option>
						<option>Нет</option>
					</select>
				</div>
				<div class="item">
					<label>Скрытие ников:</label>
					<select class="turnintodropdown">
						<option>Да</option>
						<option>Нет</option>
					</select>
				</div>
				<div class="item">
					<label>Пароль к игре:</label>
					<input type="password" name="" placeholder="***********">
				</div>
			</div>

			<div class="third">
				<div class="skill_block">
					<span>Скилл игроков:</span>
					<div class="skill_line">
						<p>Начинающий OverPRO</p>
						<div id="param"></div>
					</div>
				</div>

				<div class="block_player">
					<span>Не впускать игроков:</span>
					<a href="#"><img src="/promo/images/sets/save.png"></a>
					<a href="#"><img src="/promo/images/sets/delete.png"></a>
					<textarea></textarea>
					<button class="start_game">
						<span>СОЗДАТЬ ИГРУ</span>
						<p>Краткое описание действия кнопки</p>
					</button>
				</div>
			</div>
		</form>
	</div>
	<!--======================================-->
	<!--====game_list====-->
	<div id="wrapper" class="">
		<div class="landing_title">
			<div class="land_count">2</div>
			<div class="land_text">СО СТРАНИЦЫ <span>СПИСКА СОЗДАННЫХ ИГР, ЖЕЛАЮЩИЕ ВСТУПАЮТ В ИГРУ</span></div>
		</div>
	</div>

	<div id="wrapper" class="game_list">
		<div class="game_list_block">
			<div class="thead">
				<div class="inner">
					<div class="item">Название сервера</div>
					<div class="item">Создатель</div>
					<div class="item">Ставка</div>
					<div class="item">Игроков</div>
					<div class="item">Карта</div>
					<div class="item"><img src="/promo/images/game/ico-1.png"></div>
					<div class="item"><img src="/promo/images/game/ico-2.png"></div>
					<div class="item"><img src="/promo/images/game/ico-3.png"></div>
					<div class="item">Скилл</div>
					<div class="item"><img src="/promo/images/game/loc.png"></div>
					<div class="item"><img src="/promo/images/game/clock.png"></div>
					<div class="item">&nbsp;</div>
				</div>
				<a class="show_sets"></a>
				<a class="show_sets2"></a>
			</div>

			<div class="tsets">
				<div class="inner">
					<div class="item child">
						Локация

						<form class="subTsets">
							<div class="subItem">
								<input type="checkbox" name="" id="location1" checked>
								<label for="location1">ПОКАЗАТЬ ВСЕ</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="location2">
								<label for="location2">Москва</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="location3">
								<label for="location3">Питер</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="location4">
								<label for="location4">Самара</label>
							</div>
						</form>
					</div>
					<div class="item child">
						Карта

						<form class="subTsets">
							<div class="subItem">
								<input type="checkbox" name="" id="map1" checked>
								<label for="map1">ПОКАЗАТЬ ВСЕ</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="map2">
								<label for="map2">de_dust 2</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="map3">
								<label for="map3">de_dust 3</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="map4">
								<label for="map4">de_dust 4</label>
							</div>
						</form>
					</div>
					<div class="item child">
						Режим

						<form class="subTsets">
							<div class="subItem">
								<input type="checkbox" name="" id="mode1" checked>
								<label for="mode1">ПОКАЗАТЬ ВСЕ</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="mode2">
								<label for="mode2">1x1</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="mode3">
								<label for="mode3">3x3</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="mode4">
								<label for="mode4">5x5</label>
							</div>
						</form>
					</div>
					<div class="item child">
						Античит

						<form class="subTsets">
							<div class="subItem">
								<input type="checkbox" name="" id="cheats1" checked>
								<label for="cheats1">ПОКАЗАТЬ ВСЕ</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="cheats2">
								<label for="cheats2">ON</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="cheats3">
								<label for="cheats3">OFF</label>
							</div>
						</form>
					</div>
					<div class="item">
						<div class="tsets_title">от <span>0</span> до <span>10000</span></div>
						<div id="param2"></div>
					</div>
					<div class="item">
						<div class="tsets_title">от <span class="rank">LS</span> до <span class="rank">OP</span></div>
						<div id="param3"></div>
					</div>
				</div>
				<div class="tsets_link">
					<a href="#"><img src="/promo/images/sets/save.png"></a>
					<a href="#"><img src="/promo/images/sets/delete.png"></a>
					<a class="close_tsets"><img src="/promo/images/sets/close.png"></a>
				</div>
			</div>

			<div class="tbody scrollPro">
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank">LS</span> ( Миша )</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank">LS</span>&nbsp; - &nbsp;<span class="rank">OP</span></div>
					<div class="item"><span>Москва</span></div>
					<div class="item">1 минута</div>
					<div class="item"><a href="#">Войти</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank">LS</span> ( Миша )</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank">LS</span>&nbsp; - &nbsp;<span class="rank">OP</span></div>
					<div class="item"><span>Москва</span></div>
					<div class="item">1 минута</div>
					<div class="item"><a href="#">Войти</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank">LS</span> ( Миша )</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank">LS</span>&nbsp; - &nbsp;<span class="rank">OP</span></div>
					<div class="item"><span>Москва</span></div>
					<div class="item">1 минута</div>
					<div class="item"><a href="#">Войти</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank">LS</span> ( Миша )</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank">LS</span>&nbsp; - &nbsp;<span class="rank">OP</span></div>
					<div class="item"><span>Москва</span></div>
					<div class="item">1 минута</div>
					<div class="item"><a href="#">Войти</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank">LS</span> ( Миша )</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank">LS</span>&nbsp; - &nbsp;<span class="rank">OP</span></div>
					<div class="item"><span>Москва</span></div>
					<div class="item">1 минута</div>
					<div class="item"><a href="#">Войти</a></div>
				</div>

				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank">LS</span> ( Миша )</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank">LS</span>&nbsp; - &nbsp;<span class="rank">OP</span></div>
					<div class="item"><span>Москва</span></div>
					<div class="item">1 минута</div>
					<div class="item"><a href="#">Войти</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank">LS</span> ( Миша )</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank">LS</span>&nbsp; - &nbsp;<span class="rank">OP</span></div>
					<div class="item"><span>Москва</span></div>
					<div class="item">1 минута</div>
					<div class="item"><a href="#">Войти</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank">LS</span> ( Миша )</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank">LS</span>&nbsp; - &nbsp;<span class="rank">OP</span></div>
					<div class="item"><span>Москва</span></div>
					<div class="item">1 минута</div>
					<div class="item"><a href="#">Войти</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank">LS</span> ( Миша )</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank">LS</span>&nbsp; - &nbsp;<span class="rank">OP</span></div>
					<div class="item"><span>Москва</span></div>
					<div class="item">1 минута</div>
					<div class="item"><a href="#">Войти</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank">LS</span> ( Миша )</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank">LS</span>&nbsp; - &nbsp;<span class="rank">OP</span></div>
					<div class="item"><span>Москва</span></div>
					<div class="item">1 минута</div>
					<div class="item"><a href="#">Войти</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank">LS</span> ( Миша )</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank">LS</span>&nbsp; - &nbsp;<span class="rank">OP</span></div>
					<div class="item"><span>Москва</span></div>
					<div class="item">1 минута</div>
					<div class="item"><a href="#">Войти</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank">LS</span> ( Миша )</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank">LS</span>&nbsp; - &nbsp;<span class="rank">OP</span></div>
					<div class="item"><span>Москва</span></div>
					<div class="item">1 минута</div>
					<div class="item"><a href="#">Войти</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank">LS</span> ( Миша )</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank">LS</span>&nbsp; - &nbsp;<span class="rank">OP</span></div>
					<div class="item"><span>Москва</span></div>
					<div class="item">1 минута</div>
					<div class="item"><a href="#">Войти</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank">LS</span> ( Миша )</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank">LS</span>&nbsp; - &nbsp;<span class="rank">OP</span></div>
					<div class="item"><span>Москва</span></div>
					<div class="item">1 минута</div>
					<div class="item"><a href="#">Войти</a></div>
				</div>
			</div>
		</div>
	</div>
	<!--======================================-->
	<!--====game_preview====-->
	<div id="wrapper" class="">
		<div class="landing_title">
			<div class="land_count">3</div>
			<div class="land_text">КЛИКАЙ <span>ПОДКЛЮЧИТЬСЯ, CS:GO</span> ЗАПУСКАЕТСЯ В МИГ, ПИШИ В ЧАТЕ СЕРВЕРА <span>“READY” И НАЧИНАЙ ИГРАТЬ</span></div>
		</div>
	</div>

	<div id="wrapper" class="game_preview">
		<div class="preview_block">
			<div class="preview_inner">
				<div class="item">
					<div class="link_for_game">
						<span>Ссылка на игру:</span>&nbsp;<p>https://overpro.ru/mix20195</p>
						<a href="#" class="save_game_link"></a>
					</div>
					<div class="preview_map">
						<img src="/promo/images/game/map.png">
					</div>
					<div class="preview_location">
						Локация: <span>Москва</span>
					</div>
				</div>

				<div class="item">
					<div class="player_list">
						<div class="player_item">
							<div class="avatar admin"><img src="/promo/images/ava.png"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Переместить&nbsp;в&nbsp;другую&nbsp;команду"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Кикнуть&nbsp;из&nbsp;лобби"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
						<div class="player_item">
							<div class="avatar admin"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Переместить&nbsp;в&nbsp;другую&nbsp;команду"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Кикнуть&nbsp;из&nbsp;лобби"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
						<div class="player_item">
							<div class="avatar admin"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Переместить&nbsp;в&nbsp;другую&nbsp;команду"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Кикнуть&nbsp;из&nbsp;лобби"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
						<div class="player_item">
							<div class="avatar admin"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Переместить&nbsp;в&nbsp;другую&nbsp;команду"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Кикнуть&nbsp;из&nbsp;лобби"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
						<div class="player_item">
							<div class="avatar admin"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Переместить&nbsp;в&nbsp;другую&nbsp;команду"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Кикнуть&nbsp;из&nbsp;лобби"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
					</div>

					<div class="preview_teams">
						<span>RED</span>
						<img src="/promo/images/game/vs.png">
						<span>BLUE</span>
					</div>

					<div class="player_list">
						<div class="player_item ready">
							<div class="avatar admin"><img src="/promo/images/ava.png"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Переместить&nbsp;в&nbsp;другую&nbsp;команду"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Кикнуть&nbsp;из&nbsp;лобби"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
						<div class="player_item">
							<div class="avatar admin"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Переместить&nbsp;в&nbsp;другую&nbsp;команду"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Кикнуть&nbsp;из&nbsp;лобби"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
						<div class="player_item">
							<div class="avatar admin"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Переместить&nbsp;в&nbsp;другую&nbsp;команду"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Кикнуть&nbsp;из&nbsp;лобби"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
						<div class="player_item">
							<div class="avatar admin"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Переместить&nbsp;в&nbsp;другую&nbsp;команду"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Кикнуть&nbsp;из&nbsp;лобби"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
						<div class="player_item">
							<div class="avatar admin"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Переместить&nbsp;в&nbsp;другую&nbsp;команду"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Кикнуть&nbsp;из&nbsp;лобби"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
					</div>
				</div>

				<div class="item">
					<div class="big_prize">190000</div>
					<div>
						<div class="prize_item">
							<a href="#">
								<span>ЗАПУСК EAC</span>
								<p>Краткое описание кнопки</p>
							</a>
							<div class="prize_text">Как установить античит EAC</div>
						</div>
						<div class="prize_item">
							<a href="#">
								<span>ПОДКЛЮЧИТЬСЯ</span>
								<p>Краткое описание кнопки</p>
							</a>
							<div class="prize_text">connect 195.88.208.41:27040</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="detail_game_block animated" id="detail_game_block">
			<div class="detail_sets">
				<div class="detail_title">НАСТРОЙКИ ИГРЫ</div>
				<ul>
					<li>
						<label>Режим игры:</label>
						<div class="detail_param">5х5</div>
					</li>
					<li>
						<label>Локация:</label>
						<div class="detail_param">Москва</div>
					</li>
					<li>
						<label>Античит:</label>
						<div class="detail_param">Выключен</div>
					</li>
					<li>
						<label>Скилл:</label>
						<div class="detail_param"><span class="rank">LS</span> - <span class="rank">OP</span></div>
					</li>
					<li>
						<label>Скрытие ников:</label>
						<div class="detail_param">Нет</div>
					</li>
					<li>
						<label>Автобаланс:</label>
						<div class="detail_param">Да</div>
					</li>
					<li>
						<label>Пароль:</label>
						<div class="detail_param">Без пароля</div>
					</li>
				</ul>
			</div>
			<div class="detail_logs">
				<div class="detail_logs_block scrollPro">
					<div class="detail_logs_inner">
						<ul>
							<li>
								<div class="logs_time">23:59:09</div>
								<div class="logs_name">CyberBattler:</div>
								<div class="logs_text">
									Ну что, готовы бродяги?
								</div>
							</li>
							<li class="systems">
								<div class="logs_time">23:59:09</div>
								<div class="logs_name">СИСТЕМА:</div>
								<div class="logs_text">
									CyberBattler был перемещен из команды RED в команду BLUE
								</div>
							</li>
							<li>
								<div class="logs_time">23:59:09</div>
								<div class="logs_name">CyberBattler:</div>
								<div class="logs_text">
									Ну что, готовы бродяги?
								</div>
							</li>
							<li>
								<div class="logs_time">23:59:09</div>
								<div class="logs_name">CyberBattler:</div>
								<div class="logs_text">
									Ну что, готовы бродяги?
								</div>
							</li>
							<li>
								<div class="logs_time">23:59:09</div>
								<div class="logs_name">CyberBattler:</div>
								<div class="logs_text">
									Ну что, готовы бродяги?
								</div>
							</li>
							<li>
								<div class="logs_time">23:59:09</div>
								<div class="logs_name">CyberBattler:</div>
								<div class="logs_text">
									Ну что, готовы бродяги?
								</div>
							</li>
						</ul>
					</div>
				</div>

				<form class="detail_form" action="" method="">
					<textarea placeholder="Введите текст сообщения" required/></textarea>
					<button class="detail_button"></button>
				</form>
			</div>
		</div>
	</div>
	<!--======================================-->
	<!--====end_stats_game====-->
	<div id="wrapper" class="">
		<div class="landing_title">
			<div class="land_count">4</div>
			<div class="land_text"><span>ПОСЛЕ ПОБЕДЫ</span> СРАЗУ ЖЕ ПОЛУЧАЙ И ИЗУЧАЙ <span>СТАТИСТИКУ МАТЧА</span>, КАЧАЙ <span>ВИДЕО ПОВТОРЫ ИГРЫ</span></div>
		</div>
	</div>

	<div id="wrapper" class="end_stats_game">
		<div class="end_block">
			<div class="set">
				<div class="item">Античит - <span>Включен</span></div>
				<div class="item">Автобаланс - <span>Включен</span></div>
				<div class="item">Скрытые ники - <span>Включен</span></div>
				<div class="item"><a href="#"></a> Демо-запись</div>
			</div>
			<div class="frame">
				<div class="img"><img src="/promo/images/game/big-map-img.jpg"></div>
				<div class="best">
					ЛУЧШИЙ ИГРОК МАТЧА:
					<div class="avatar users"><img src="/promo/images/ava.png"></div>
					<span>CoolnessWebStudio</span>
				</div>
			</div>

			<div class="end_stats_block">
				<div class="end_team">
					<div class="end_table">
						<div class="title">TEAM 1</div>
						<div class="head">
							<div class="item">Никнейм</div>
							<div class="item">TeamPlay</div>
							<div class="item">Убийства</div>
							<div class="item">Смерти</div>
							<div class="item">Ассисты</div>
							<div class="item">ELO</div>
							<div class="item">Баланс</div>
							<div class="item">&nbsp;</div>
						</div>
						<div class="body">
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>OverPRO Team</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">-25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Подать&nbsp;жалобу"></a></div>
							</div>
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>OverPRO Team</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">-25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Подать&nbsp;жалобу"></a></div>
							</div>
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>OverPRO Team</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">-25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Подать&nbsp;жалобу"></a></div>
							</div>
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>OverPRO Team</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">-25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Подать&nbsp;жалобу"></a></div>
							</div>
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>OverPRO Team</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">-25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Подать&nbsp;жалобу"></a></div>
							</div>
						</div>
					</div>
				</div>

				<div class="end_team">
					<div class="end_table">
						<div class="title winner">TEAM 2</div>
						<div class="head">
							<div class="item">Никнейм</div>
							<div class="item">TeamPlay</div>
							<div class="item">Убийства</div>
							<div class="item">Смерти</div>
							<div class="item">Ассисты</div>
							<div class="item">ELO</div>
							<div class="item">Баланс</div>
							<div class="item">&nbsp;</div>
						</div>
						<div class="body">
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>OverPRO Team</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">+25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Подать&nbsp;жалобу"></a></div>
							</div>
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>OverPRO Team</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">+25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Подать&nbsp;жалобу"></a></div>
							</div>
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>OverPRO Team</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">+25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Подать&nbsp;жалобу"></a></div>
							</div>
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>OverPRO Team</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">+25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Подать&nbsp;жалобу"></a></div>
							</div>
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>OverPRO Team</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">+25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Подать&nbsp;жалобу"></a></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<form class="dislike_form">
				<div class="title">Укажите причину дизлайка</div>
				<input type="text" name="" placeholder="Введите причину для дизлайка" required/>
				<input type="submit" name="" value="OK">
			</form>
		</div>
	</div>
	<!--======================================-->
	<!--====profile_page====-->
	<div id="wrapper" class="">
		<div class="landing_title">
			<div class="land_count">5</div>
			<div class="land_text"><span>АНАЛИЗИРУЙ</span> СИЛЬНОГО ВРАГА И <span>ЗАРАБАТЫВАЙ</span> НА ЕГО СЛАБОСТЯХ</div>
		</div>
	</div>

	<div id="wrapper" class="profile_page">
		<div class="prof_top">
			<div class="prof_avatar">
				<div class="text">ЗАГРУЗИТЬ АВАТАРКУ</div>
				<img src="/promo/images/ava-b.png">
			</div>

			<div class="prof_data">
				<div class="title">
					<div class="name">Mihail Fet</div>
					<div class="skill">PS</div>
					<div class="status"><img src="/promo/images/profile/ico-on.png"></div>
				</div>
				<div class="country">
					<div class="flag"><img src="/promo/images/profile/ico-ru.png"></div>
					<input type="text" name="" value="Россия, Смоленск">
				</div>
				<div class="information">
					<textarea>Обмениваюсь скинами CS:GO с самым низким процентом. А еще я топовый игрок,который вытащит любую команду.
Такой вот мой статус.</textarea>
				</div>
				<div class="social_block">
					<div class="soc_title">Способы связи:</div>
					<div class="social_block_item">
						{{-- <!-- Пример пустого блока
						<div class="item empty">
							<div class="intro"><img src=""></div>
							<div class="social_block_icons">
								<div class="soc_icon"><img src="/images/profile/icon/ico-1.png"></div>
								<div class="soc_icon"><img src="/images/profile/icon/ico-2.png"></div>
								<div class="soc_icon"><img src="/images/profile/icon/ico-3.png"></div>
								<div class="soc_icon"><img src="/images/profile/icon/ico-4.png"></div>
								<div class="soc_icon"><img src="/images/profile/icon/ico-5.png"></div>
								<div class="soc_icon"><img src="/images/profile/icon/ico-6.png"></div>
								<div class="soc_icon"><img src="/images/profile/icon/ico-7.png"></div>
								<div class="soc_icon"><img src="/images/profile/icon/ico-8.png"></div>
								<div class="soc_icon"><img src="/images/profile/icon/ico-9.png"></div>
							</div>
						</div>
						-->
						<!-- Пример активного блока
						<div class="item active">
							<div class="intro"><img src="/images/profile/icon/ico-1.png"></div>
							<div class="soc_block_link">
								<a class="switch_soc_item with_title" title="Изменить"></a>
								<a class="delete_soc_item with_title" title="Удалить"></a>
							</div>
						</div>
						--> --}}
					</div>

					<form class="soc_block_form">
						<input type="text" name="" class="add_soc_link" placeholder="Введите ссылку на профиль соц сети">
						<input type="submit" name="" class="save_soc_link" value="OK">
					</form>
				</div>
				<div class="prize_skill_count">
					<div class="item">
						<div class="count">1355</div>
						<div class="text">Золото турнира</div>
					</div>
					<div class="item">
						<div class="count">2535</div>
						<div class="text">Серебро турнира</div>
					</div>
					<div class="item">
						<div class="count">2535</div>
						<div class="text">Бронза турнира</div>
					</div>
				</div>
			</div>
		</div>

		<div class="prof_stats_stat">
			<div class="prof_stats_items">
				<div class="item">
					<div class="item_inner">ELO <span>1200</span></div>
				</div>
				<div class="item">
					<div class="item_inner">Kill Death <span>1.3</span></div>
				</div>
				<div class="item">
					<div class="item_inner">Kill Rate <span>1.3</span></div>
				</div>
				<div class="item">
					<div class="item_inner">Win Rate <span>54%</span></div>
				</div>
				<div class="item">
					<div class="item_inner">HeadShot <span>35%</span></div>
				</div>
			</div>
		</div>
	</div>
	<!--======================================-->
	<!--====bank_page====-->
	<div id="wrapper" class="">
		<div class="landing_title">
			<div class="land_count">6</div>
			<div class="land_text"><span>ПРОДАВАЙ И ПОКУПАЙ</span> МОНЕТЫ <img src="/promo/images/game/par-prize.png">&nbsp;&nbsp;ЗА РЕАЛЬНЫЕ <span>ДЕНЬГИ И СКИНЫ</span></div>
		</div>
	</div>

	<div id="wrapper" class="bank_page">
		<div class="bank_bottom_block">
			<div class="bank_items">
				<div class="bank_items_inner">
					<div class="item">
						<div class="img"><img src="/promo/images/bank/gun.png"></div>
						<div class="count">100</div>
						<div class="text">
							<span>HUSTMAN KNIFE 1</span>
							<p>Safari Mesh Field - Tested</p>
						</div>
					</div>
					<div class="item">
						<div class="img"><img src="/promo/images/bank/gun.png"></div>
						<div class="count">200</div>
						<div class="text">
							<span>HUSTMAN KNIFE 2</span>
							<p>Safari Mesh Field - Tested</p>
						</div>
					</div>
					<div class="item">
						<div class="img"><img src="/promo/images/bank/gun.png"></div>
						<div class="count">300</div>
						<div class="text">
							<span>HUSTMAN KNIFE 3</span>
							<p>Safari Mesh Field - Tested</p>
						</div>
					</div>
				</div>
			</div>

			<div class="bank_deal">
				<div class="title">Общая сумма вывода: <span>0</span></div>
				<div class="bank_deal_items">
					<!-- Пример
					<div class="item">
						<div class="name">AK-47 | NEON REVOLUTION</div>
						<div class="count"><span>65986</span></div>
						<a class="delete"></a>
					</div>
					конец примера-->
				</div>
				<a class="go_deal">ПОДТВЕРДИТЬ ВЫВОД ПРЕДМЕТОВ</a>
			</div>
		</div>
	</div>
	<!--======================================-->
	<!--====donate====-->
	<div id="wrapper" class="donate_wrap">
		<div class="donate_block">
			<div class="donate_text">
				<div class="text">
					АКЦИЯ! ПОЛУЧИ ДО +50% ПРИ ПЕРВОМ ПОПОЛНЕНИИ БАЛАНСА ОТ 1000
				</div>
				<div class="donate_timer">
					<div class="title">До окончания акции:</div>
					<div class="timer">
						<div class="count hour">00</div>
						<div class="count">:</div>
						<div class="count min">00</div>
						<div class="count">:</div>
						<div class="count sec">00</div>
					</div>
				</div>
			</div>

			<div class="donate_form">
				<div class="title">Пополнить баланс деньгами:</div>
				<form>
					<div class="item">
						<input type="text" id="spinner1" name="" value="100" step="100" disabled/>
					</div>
					<label>за</label>
					<div class="item">
						<input type="text" id="spinner2" name="" value="1000" step="1000" disabled/>
					</div>
					<div class="val">RUB</div>
				</form>
				<ul class="option_links">
					<li class="active"><img src="/promo/images/ico-d-1.png"></li>
					<li><img src="/promo/images/ico-d-2.png"></li>
					<li><img src="/promo/images/ico-d-3.png"></li>
					<li><img src="/promo/images/ico-d-4.png"></li>
					<li><img src="/promo/images/ico-d-5.png"></li>
					<a class="more_donate_links">Еще</a>
				</ul>
			</div>

			<div class="donate_img"></div>

			<div class="donate_item_option">
				<div class="title">или игровыми предметами</div>
				<a href="#" class="opt_donate_btn">
					<span>Пополнить баланс</span>
					<p>ИГРОВЫМИ ПРЕДМЕТАМИ</p>
				</a>
			</div>
		</div>
	</div>
	<!--======================================-->
	<!--====block_info_stats====-->
	<div id="wrapper">
		<div class="block_info_stats">
			<div class="item">
				<span>3.000.000 +</span>
				<p>СЫГРАНО МАТЧЕЙ</p>
			</div>
			<div class="item">
				<span>100.000.000 +</span>
				<p>РУБЛЕЙ ПРИЗ ВСЕХ ИГР</p>
			</div>
			<div class="item">
				<span>300.000 +</span>
				<p>ЗАРЕГИСТРИРОВАНО ИГРОКОВ</p>
			</div>
		</div>

		<a href="/login" class="login_steam_land">
			<span>ВОЙТИ И ИГРАТЬ</span>
			<p>Авторизуйтесь с помощью Steam</p>
		</a>
	</div>
	<!--======================================-->
	<!--====tournament====-->
	<div id="wrapper" class="">
		<div class="landing_title" style="margin-top: 0;">
			<div class="land_img"><img src="/promo/images/new/ico-title-3.png"></div>
			<div class="land_text">ОТСТРЕЛИВАЙ ВРАГОВ В <span>РЕЖИМЕ БОЙ НА СМЕРТЬ</span> - ТВОЙ <span>БАЛАНС ЗАВИСИТ</span> ТОЛЬКО ОТ <span>ТВОЕЙ РЕАКЦИИ</span></div>
		</div>
	</div>

	<div id="wrapper" class="tournament">
		<div class="tournament_block">
			<div class="frame">
				<img class="tour_bg" src="/promo/images/new-banner.jpg">
				<!--
				<div class="text">
					<div class="img"><img src="/images/new-banner.png"></div>
					<div class="info">
						<div class="title">АКЦИЯ <span>БОЙ НАСМЕРТЬ!</span></div>
						<p>
							Акция Каждый Час: <span>топ 3 игрока по</span> кол-ву фрагов + смертей за 1 час <span>делят</span> 90% комиссий <span>серверов DeathMatch!</span>
						</p>
					</div>
				</div>
				-->
			</div>
			<div class="send">
				<div class="text">ИНФО И ПРИЗЫ | ПОИСК КОМАНДЫ НА ТУРНИР | ВОПРОСЫ</div>
				<div class="info">Зарегистрировано команд <b>80</b> из <b>128</b></div>
				<a href="#tournament_detail" id="showMoreTour">
					<span>ЗАРЕГИСТРИРОВАТЬ КОМАНДУ</span>
					<p>Краткое описание действия кнопки</p>
				</a>
			</div>
		</div>

		<a href="#tournament_detail" class="show_more_info showMoreStyle" id="showMore">СМОТРЕТЬ БОЛЬШЕ О ТУРНИРАХ</a>

		<div class="tournament_detail" id="tournament_detail">
			<div class="tournament_detail_block">
				<div class="thead">
					<div class="item">ID</div>
					<div class="item">Название команды</div>
					<div class="item">Капитан</div>
				</div>
				<div class="tbody scrollPro">
					<div class="inner">
						<div class="item">1</div>
						<div class="item">OverPRO Team</div>
						<div class="item">CyberBattler</div>
					</div>
					<div class="inner">
						<div class="item">1</div>
						<div class="item">OverPRO Team</div>
						<div class="item">CyberBattler</div>
					</div>
					<div class="inner">
						<div class="item">1</div>
						<div class="item">OverPRO Team</div>
						<div class="item">CyberBattler</div>
					</div>
					<div class="inner">
						<div class="item">1</div>
						<div class="item">OverPRO Team</div>
						<div class="item">CyberBattler</div>
					</div>
					<div class="inner">
						<div class="item">1</div>
						<div class="item">OverPRO Team</div>
						<div class="item">CyberBattler</div>
					</div>
					<div class="inner">
						<div class="item">1</div>
						<div class="item">OverPRO Team</div>
						<div class="item">CyberBattler</div>
					</div>
					<div class="inner">
						<div class="item">1</div>
						<div class="item">OverPRO Team</div>
						<div class="item">CyberBattler</div>
					</div>
					<div class="inner">
						<div class="item">1</div>
						<div class="item">OverPRO Team</div>
						<div class="item">CyberBattler</div>
					</div>
					<div class="inner">
						<div class="item">1</div>
						<div class="item">OverPRO Team</div>
						<div class="item">CyberBattler</div>
					</div>
					<div class="inner">
						<div class="item">1</div>
						<div class="item">OverPRO Team</div>
						<div class="item">CyberBattler</div>
					</div>
				</div>
			</div>

			<form class="tournament_register">
				<div class="item">
					<label>Название команды:</label>
					<input type="text" name="" placeholder="Введите название" required/>
				</div>
				<div class="item">
					<label>Капитан команды:</label>
					<input type="text" name="" placeholder="Мой никнейм" required/>
				</div>
				<div class="item">
					<label>Игрок 2:</label>
					<input type="text" name="" placeholder="Ник игрока" required/>
				</div>
				<div class="item">
					<label>Игрок 3:</label>
					<input type="text" name="" placeholder="Ник игрока" required/>
				</div>
				<div class="item">
					<label>Игрок 4:</label>
					<input type="text" name="" placeholder="Ник игрока" required/>
				</div>
				<div class="item">
					<label>Игрок 5:</label>
					<input type="text" name="" placeholder="Ник игрока" required/>
				</div>
				<div class="item">
					<label>Замена 1:</label>
					<input type="text" name="" placeholder="Ник игрока" required/>
				</div>
				<div class="item">
					<label>Замена 2:</label>
					<input type="text" name="" placeholder="Ник игрока" required/>
				</div>
				<div class="item">
					<label>Контакты:</label>
					<input type="text" name="" placeholder="Ник игрока" required/>
				</div>
				<input type="submit" name="" value="ЗАРЕГИСТРИРОВАТЬ КОМАНДУ" class="tour_btn">
			</form>
		</div>
	</div>
	<!--======================================-->
	<!--====rank_all_stats_general====-->
	<div id="wrapper" class="">
		<div class="landing_title">
			<div class="land_img"><img src="/promo/images/new/ico-title-2.png"></div>
			<div class="land_text">ПОДНИМАЙ РЕЙТИНГ В ИГРАХ С <span>СОПЕРНИКАМИ СИЛЬНЕЕ</span> И СРАЖАЙСЯ ЗА <span>МЕСТО В ТОПЕ!</span></div>
		</div>
	</div>

	<div id="wrapper">
		<div class="rank_list_land">
			<div class="item"><span class="rank rank_LS">LS</span>Low Skill</div>
			<div class="item"><span class="rank rank_MS">MS</span>Medium skill</div>
			<div class="item"><span class="rank rank_AS">AS</span>Amateur Skill</div>
			<div class="item"><span class="rank rank_HS">HS</span>High Skill</div>
			<div class="item"><span class="rank rank_SS">SS</span>Semi-Pro</div>
			<div class="item"><span class="rank rank_PS">PS</span>Pro skill</div>
			<div class="item"><span class="rank rank_OP">OP</span>overPRO</div>
		</div>
	</div>

	<div id="wrapper" class="rank_all_stats_general">
		<div class="rank_tabs_block">
			<div class="rank_items">
				<div class="item">
					<div class="title">РЕЙТИНГ ПО ELO</div>
					<div class="inner">
						<div class="inner_item">
							<div class="name">COOLNESSWEB</div>
						</div>
						<div class="inner_item">
							<div class="name">COOLNESSWEB</div>
						</div>
						<div class="inner_item">
							<div class="name">COOLNESSWEB</div>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="title">РЕЙТИНГ ПО УБИЙСТВАМ</div>
					<div class="inner">
						<div class="inner_item">
							<div class="name">COOLNESSWEB</div>
						</div>
						<div class="inner_item">
							<div class="name">COOLNESSWEB</div>
						</div>
						<div class="inner_item">
							<div class="name">COOLNESSWEB</div>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="title">РЕЙТИНГ ПО ХЕДШОТАМ</div>
					<div class="inner">
						<div class="inner_item">
							<div class="name">COOLNESSWEB</div>
						</div>
						<div class="inner_item">
							<div class="name">COOLNESSWEB</div>
						</div>
						<div class="inner_item">
							<div class="name">COOLNESSWEB</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--======================================-->
	<!--====death match====-->
	<div id="wrapper" class="">
		<div class="landing_title">
			<div class="land_img"><img src="/promo/images/new/ico-title-1.png"></div>
			<div class="land_text">ПОБЕЖДАЙ В <span>ОНЛАЙН ОТБОРОЧНЫХ OVERPRO</span> И ВЫИГРЫВАЙ <span>КВОТЫ НА МИРОВЫЕ ИВЕНТЫ</span></div>
		</div>
	</div>

	<div id="wrapper" class="death_match">
		<div class="death_block">
			<div class="death_list scrollPro">
				<div class="death_inner">
					<div class="item active">
						<div class="frame"><img src="/promo/images/game/img.png"></div>
						<div class="text">
							<span>10 / 18</span>
							<p>игроков</p>
						</div>
					</div>
					<div class="item">
						<div class="frame"><img src="/promo/images/game/img.png"></div>
						<div class="text">
							<span>10 / 18</span>
							<p>игроков</p>
						</div>
					</div>
					<div class="item">
						<div class="frame"><img src="/promo/images/game/img.png"></div>
						<div class="text">
							<span>10 / 18</span>
							<p>игроков</p>
						</div>
					</div>
					<div class="item">
						<div class="frame"><img src="/promo/images/game/img.png"></div>
						<div class="text">
							<span>10 / 18</span>
							<p>игроков</p>
						</div>
					</div>
					<div class="item">
						<div class="frame"><img src="/promo/images/game/img.png"></div>
						<div class="text">
							<span>10 / 18</span>
							<p>игроков</p>
						</div>
					</div>
					<div class="item">
						<div class="frame"><img src="/promo/images/game/img.png"></div>
						<div class="text">
							<span>10 / 18</span>
							<p>игроков</p>
						</div>
					</div>
				</div>
			</div>

			<div class="death_stats">
				<div class="death_stats_info">
					<div class="item">
						<span>5</span>
						<p>УБИЙСТВО</p>
					</div>
					<div class="item">
						<span>1</span>
						<p>СМЕРТЬ</p>
					</div>
					<div class="item">
						<span>8</span>
						<p>HEADSHOT</p>
					</div>
				</div>

				<div class="death_stats_links">
					<div class="item">
						<a href="#">
							<span>ЗАПУСК EAC</span>
							<p>Краткое описание кнопки</p>
						</a>
					</div>
					<div class="item">
						<a href="#">
							<span>ПОДКЛЮЧИТЬСЯ</span>
							<p>Краткое описание кнопки</p>
						</a>
						<div class="text">connect 195.88.208.41:27040</div>
					</div>
				</div>
			</div>

			<div class="death_timer">
				<div class="death_timer_title">
					Акция NOW! Топ7 по кол-ву фрагов + смертей с 00 по 59 мин -  ПРИЗ ЧАСА!
				</div>
				<div class="death_timer_count">
					<div class="item">
						<span>ДО КОНЦА АКЦИИ</span>
						<div class="timer">
							<div class="count hour">00</div>
							<div class="count">:</div>
							<div class="count min">00</div>
							<div class="count">:</div>
							<div class="count sec">00</div>
						</div>
					</div>
					<div class="item">
						<span>ТЕКУЩИЙ ПРИЗ</span>
						<p>190000</p>
					</div>
				</div>
			</div>
		</div>

		<a href="#death_detail" class="show_more_info" id="showMore">СМОТРЕТЬ ТЕКУЩИХ ЛИДЕРОВ</a>

		<div class="death_detail" id="death_detail">
			<div class="death_player_lists">
				<div class="death_player_lists_title">ИГРОКИ НА СЕРВЕРЕ</div>
				<div class="death_player_table">
					<div class="thead">
						<div class="item">Никнейм</div>
						<div class="item">Фрагов</div>
						<div class="item">Смертей</div>
					</div>
					<div class="tbody scrollPro">
						<div class="inner">
							<div class="item">CyberBattler</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">CyberBattler</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">CyberBattler</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">CyberBattler</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">CyberBattler</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">CyberBattler</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">CyberBattler</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">CyberBattler</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">CyberBattler</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">CyberBattler</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">CyberBattler</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
					</div>
				</div>
			</div>

			<div class="death_player_stats">
				<div class="death_player_lists_title">&nbsp;</div>
				<div class="death_player_lists_table">
					<div class="thead">
						<div class="item">Текущее место</div>
						<div class="item">Очков</div>
						<div class="item">Награда</div>
					</div>

					<div class="tbody scrollPro">
						<div class="inner">
							<div class="item">
								<div class="num">1</div>
								<div class="avatar users"><img src="/promo/images/ava.png"></div>
								<div class="name">CyberBattler</div>
							</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">
								<div class="num">2</div>
								<div class="avatar users"><img src="/promo/images/ava.png"></div>
								<div class="name">CyberBattler</div>
							</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">
								<div class="num">3</div>
								<div class="avatar users"><img src="/promo/images/ava.png"></div>
								<div class="name">CyberBattler</div>
							</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">
								<div class="num">1</div>
								<div class="avatar users"><img src="/promo/images/ava.png"></div>
								<div class="name">CyberBattler</div>
							</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">
								<div class="num">1</div>
								<div class="avatar users"><img src="/promo/images/ava.png"></div>
								<div class="name">CyberBattler</div>
							</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">
								<div class="num">1</div>
								<div class="avatar users"><img src="/promo/images/ava.png"></div>
								<div class="name">CyberBattler</div>
							</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">
								<div class="num">1</div>
								<div class="avatar users"><img src="/promo/images/ava.png"></div>
								<div class="name">CyberBattler</div>
							</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">
								<div class="num">1</div>
								<div class="avatar users"><img src="/promo/images/ava.png"></div>
								<div class="name">CyberBattler</div>
							</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">
								<div class="num">1</div>
								<div class="avatar users"><img src="/promo/images/ava.png"></div>
								<div class="name">CyberBattler</div>
							</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">
								<div class="num">1</div>
								<div class="avatar users"><img src="/promo/images/ava.png"></div>
								<div class="name">CyberBattler</div>
							</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
						<div class="inner">
							<div class="item">
								<div class="num">1</div>
								<div class="avatar users"><img src="/promo/images/ava.png"></div>
								<div class="name">CyberBattler</div>
							</div>
							<div class="item">180</div>
							<div class="item">1180</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--======================================-->
	<!--====online_stream====-->
	<div id="wrapper" class="">
		<div class="landing_title">
			<div class="land_img"><img src="/promo/images/new/ico-title-4.png"></div>
			<div class="land_text"><span>СТРИМЬ СВОЮ ПОБЕДУ</span>. ПОЛУЧАЙ <span>ДОНАТЫ</span> ЗА <span>КРАСИВЫЕ КАМБЭКИ</span></div>
		</div>
	</div>

	<div id="wrapper" class="online_stream">
		<div class="stream_block">
			<div class="stream_block_land">
				<div class="stream_item">
					<div class="frame"><img src="/promo/images/game/map.png"></div>
					<div class="op_top">
						<div class="left">1000 зрителей</div>
						<div class="right"><span>5000</span> приз</div>
					</div>
					<div class="op_bot">
						<div class="op_ava">
							<div class="avatar users"><img src="/promo/images/ava.png"></div>
							<div class="skill rank">LS</div>
						</div>
						<div class="name">CyberBattler</div>
						<div class="title">CS:GO TOURNAMENT</div>
					</div>
				</div>
				<div class="stream_item">
					<div class="frame"><img src="/promo/images/game/map.png"></div>
					<div class="op_top">
						<div class="left">1000 зрителей</div>
						<div class="right"><span>5000</span> приз</div>
					</div>
					<div class="op_bot">
						<div class="op_ava">
							<div class="avatar users"><img src="/promo/images/ava.png"></div>
							<div class="skill rank">LS</div>
						</div>
						<div class="name">CyberBattler</div>
						<div class="title">CS:GO TOURNAMENT</div>
					</div>
				</div>
			</div>
			<div class="stream_block_land">
				<div class="stream_item">
					<div class="frame"><img src="/promo/images/game/map.png"></div>
					<div class="op_top">
						<div class="left">1000 зрителей</div>
						<div class="right"><span>5000</span> приз</div>
					</div>
					<div class="op_bot">
						<div class="op_ava">
							<div class="avatar users"><img src="/promo/images/ava.png"></div>
							<div class="skill rank">LS</div>
						</div>
						<div class="name">CyberBattler</div>
						<div class="title">CS:GO TOURNAMENT</div>
					</div>
				</div>
				<div class="stream_item stnewsland">
					<span>САМЫЙ ПРОСТОЙ СПОСОБ СЫГРАТЬ СО СВОИМИ ПОДПИСЧИКАМИ</span>
					<p>Создай игру с паролем или без и приглашай подписчиков в свою игру по ссылке</p>
				</div>
			</div>
		</div>

		<a href="#stream_detail" class="show_more_info" id="showMore">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;СМОТРЕТЬ БОЛЬШЕ STREAM ТРАНСЛЯЦИЙ
		</a>

		<div class="stream_detail" id="stream_detail">
			<div class="stream_detail_online">
				<div class="frame"><img src="/promo/images/game/big-img.png"></div>
				<div class="op_top">
					<div class="left">1000 зрителей</div>
					<div class="right"><span>5000</span></div>
				</div>
				<div class="op_bot">
					<div class="op_ava">
						<div class="avatar users"><img src="/promo/images/ava.png"></div>
						<div class="skill rank">LS</div>
					</div>
					<div class="name">CyberBattler</div>
					<div class="title">CS:GO TOURNAMENT</div>
				</div>
			</div>

			<div class="stream_detail_list scrollPro">
				<div class="tbody">
					<div class="item">
						<div class="avatar users"><img src="/promo/images/ava.png"></div>
						<div class="name"><span>CyberBattler</span></div>
						<div class="skill rank"><span>LS</span></div>
						<div class="info"><span>1505</span> / <span>5000</span></div>
					</div>
					<div class="item">
						<div class="avatar users"><img src="/promo/images/ava.png"></div>
						<div class="name"><span>CyberBattler</span></div>
						<div class="skill rank"><span>LS</span></div>
						<div class="info"><span>1505</span> / <span>5000</span></div>
					</div>
					<div class="item">
						<div class="avatar users"><img src="/promo/images/ava.png"></div>
						<div class="name"><span>CyberBattler</span></div>
						<div class="skill rank"><span>LS</span></div>
						<div class="info"><span>1505</span> / <span>5000</span></div>
					</div>
					<div class="item">
						<div class="avatar users"><img src="/promo/images/ava.png"></div>
						<div class="name"><span>CyberBattler</span></div>
						<div class="skill rank"><span>LS</span></div>
						<div class="info"><span>1505</span> / <span>5000</span></div>
					</div>
					<div class="item">
						<div class="avatar users"><img src="/promo/images/ava.png"></div>
						<div class="name"><span>CyberBattler</span></div>
						<div class="skill rank"><span>LS</span></div>
						<div class="info"><span>1505</span> / <span>5000</span></div>
					</div>
					<div class="item">
						<div class="avatar users"><img src="/promo/images/ava.png"></div>
						<div class="name"><span>CyberBattler</span></div>
						<div class="skill rank"><span>LS</span></div>
						<div class="info"><span>1505</span> / <span>5000</span></div>
					</div>
					<div class="item">
						<div class="avatar users"><img src="/promo/images/ava.png"></div>
						<div class="name"><span>CyberBattler</span></div>
						<div class="skill rank"><span>LS</span></div>
						<div class="info"><span>1505</span> / <span>5000</span></div>
					</div>
					<div class="item">
						<div class="avatar users"><img src="/promo/images/ava.png"></div>
						<div class="name"><span>CyberBattler</span></div>
						<div class="skill rank"><span>LS</span></div>
						<div class="info"><span>1505</span> / <span>5000</span></div>
					</div>
					<div class="item">
						<div class="avatar users"><img src="/promo/images/ava.png"></div>
						<div class="name"><span>CyberBattler</span></div>
						<div class="skill rank"><span>LS</span></div>
						<div class="info"><span>1505</span> / <span>5000</span></div>
					</div>
					<div class="item">
						<div class="avatar users"><img src="/promo/images/ava.png"></div>
						<div class="name"><span>CyberBattler</span></div>
						<div class="skill rank"><span>LS</span></div>
						<div class="info"><span>1505</span> / <span>5000</span></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--======================================-->
	<!--====online_stream====-->
	<div id="wrapper" class="">
		<div class="landing_title">
			<div class="land_text_center">ВСТУПАЙ В <span>РЯДЫ СОЗДАТЕЛЕЙ</span> И СТРОЙ СВОЮ <span>КИБЕРСПОРТИВНУЮ КАРЬЕРУ</span></div>
		</div>
	</div>

	<div id="wrapper" class="">
		<div class="dream_team">
			<div class="item"><img src="/promo/images/dream/f1.png"></div>
			<div class="item"><img src="/promo/images/dream/f2.png"></div>
			<div class="item"><img src="/promo/images/dream/f3.png"></div>
			<div class="item"><img src="/promo/images/dream/f4.png"></div>
			<div class="item"><img src="/promo/images/dream/f5.png"></div>
			<div class="item"><img src="/promo/images/dream/f6.png"></div>
			<div class="item"><img src="/promo/images/dream/f16.png"></div>
			<div class="item"><img src="/promo/images/dream/f14.png"></div>
			<div class="item"><img src="/promo/images/dream/f7.png"></div>
			<div class="item"><img src="/promo/images/dream/f8.png"></div>
			<div class="item"><img src="/promo/images/dream/f9.png"></div>
			<div class="item"><img src="/promo/images/dream/f17.png"></div>
			<div class="item"><img src="/promo/images/dream/f11.png"></div>
			<div class="item"><img src="/promo/images/dream/f12.png"></div>
			<div class="item"><img src="/promo/images/dream/f15.png"></div>
			<div class="item"><img src="/promo/images/dream/f13.png"></div>
		</div>
		<div class="dream_info">
			<div class="item">
				<span>
					ОСНОВАТЕЛИ ПЕРВОГО АВТОМАТИЗИРОВАННОГО<br>МАТЧМЕЙКИНГА НА ДЕНЬГИ
				</span>
			</div>
			<div class="item">
				<span>
					МЕЖДУНАРОДНАЯ КОМАНДА РАЗРАБОТЧИКОВ -<br>ИГРОКОВ CS 1.6, CS:GO, DOTA 2, SC2, QL
				</span>
			</div>
		</div>
	</div>
	<!--======================================-->
	<!--====online_stream====-->
	<div id="wrapper" class="">
		<div class="landing_title">
			<div class="land_text_last">
				<span>ОТКРЫВАЙ НОВУЮ ЭРУ еSPORTS ВМЕСТЕ С OVERPRO</span>
 				Благодаря выявлению истинных потребностей каждого из нас, мы создаем сенсационные платформы для развития киберспорта
			</div>
		</div>
	</div>

	<div id="wrapper" class="">
		<div class="land_era">
			<div class="item">
				<div class="title">ИНТЕРФЕЙС СОБСТВЕННОГО<span>КИБЕРСПОРТИВНОГО КЛУБА</span></div>
				<div class="text">
					Для владельцев и менеджеров команд мы создаем целую<br>экосистему для создания и ведения своего киберспортивного клуба
				</div>
				<ul>
					<li>- &nbsp;Заключай контракты, назначай роль менеджера, капитана, игрока и т.д</li>
					<li>- &nbsp;Выставляй зарплаты, взымай процент с побед в матчах и турнирах</li>
					<li>- &nbsp;Веди фан клуб, создавай опросы и обсуждения, получай донаты</li>
					<li>- &nbsp;Соревнуйся с другими клубами, расти в рейтинге и находи спонсора!</li>
				</ul>
			</div>
			<div class="item">
				<div class="title">ИНТЕРФЕЙС ОРГАНИЗАЦИИ<span>СВОИХ ЛИГ И СЕРИИ ТУРНИРОВ</span></div>
				<div class="text">
					Больше не придется самому арендовать сервера, вести турнирную<br>сетку вручную, разбираться с судьями -  все на автомате!
				</div>
				<ul>
					<li>- &nbsp;Вноси призовой фонд турнира и выставляй комиссию со взносов</li>
					<li>- &nbsp;Назначай цену билета, предоставляй квоты любимым командам</li>
					<li>- &nbsp;Организовывай серию турниров - увеличивай фонд финалов</li>
					<li>- &nbsp;Развивай свою лигу, свой бренд, получай хайп и зарабатывай!</li>
				</ul>
			</div>
		</div>
		<a href="/login" class="login_steam_era_land">
			<span>ВОЙТИ И ИГРАТЬ</span>
			<p>Авторизуйтесь с помощью Steam</p>
		</a>
	</div>
	<!--======================================-->
	<!--====VK Widget====-->
	<div id="wrapper" class="vk_block">
		<script async type="text/javascript" src="//vk.com/js/api/openapi.js?150"></script>
		<!-- VK Widget -->
		<div id="vk_groups"></div>
		<script type="text/javascript">
			VK.Widgets.Group("vk_groups", {mode: 3, width: 'auto', color1: '101111', color2: 'f9cf28', color3: 'f9cf28'}, 38751500);
		</script>
	</div>
	<!--======================================-->
	<!--====footer====-->
	<div id="wrapper" class="footer">
		<div class="footer_block">
			<div class="copyright">
				© 2008-2018 <span>overPRO</span>. All Rights Reserved<br>
				Privacy Policy Terms and Conditions<br>
				<span>team@overpro.ru</span>
			</div>
			<div class="footer_social">
				<span>OVERPRO В СОЦИАЛЬНЫХ СЕТЯХ:</span>
				<ul>
					<li><a href="https://discordapp.com/channels/340801623297097728/340805285608292352"><img src="/promo/images/footer-ico-1.png"></a></li>
					<li><a href="http://vk.com/overpro"><img src="/promo/images/footer-ico-2.png"></a></li>
					<li><a href=""><img src="/promo/images/footer-ico-3.png"></a></li>
					<li><a href="https://www.youtube.com/user/wwwoverproru"><img src="/promo/images/footer-ico-4.png"></a></li>
					<li><a href="http://steamcommunity.com/groups/overproru"><img src="/promo/images/footer-ico-5.png"></a></li>
				</ul>
			</div>
			<ul class="donate_footer_icons">
				<li><img src="/promo/images/ico-f-1.png"></li>
				<li><img src="/promo/images/ico-f-2.png"></li>
				<li><img src="/promo/images/ico-f-3.png"></li>
				<li><img src="/promo/images/ico-f-4.png"></li>
				<li><img src="/promo/images/ico-f-5.png"></li>
			</ul>
		</div>
	</div>
	<!--======================================-->
	<!--======================================-->
	<!--======================================-->
</div>
<!--======================================-->
<div class="info_chat">
	<a class="show_chat"><span>Online Chat</span></a>
	<div class="online"><span>10596</span><p>Online now</p></div>
</div>
<!--======================================-->
<div class="onload_window">
	<div class="onw_gif"></div>
</div>
<script type="text/javascript">
$(window).load(function(){
    setTimeout(function(){
        $('.onw').animate({width: '0', height: '0'}, 300);
        $('.onload_window').animate({opacity: '0'}, 300).hide(10);
        $('body').removeClass('overflow');
    }, 2000);
});
</script>
<!--======================================-->
</body>
</html>

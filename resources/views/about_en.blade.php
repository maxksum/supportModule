<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="title"/>
<meta name="keywords" content="title"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>eSports Battle Games</title>
<!---->
<link rel="stylesheet" href="/promo/css/style.css" type="text/css" />
<link rel="stylesheet" href="/promo/css/media.css" type="text/css" />
<link rel="stylesheet" href="/promo/css/animate.css" type="text/css" />
<link rel="stylesheet" href="/promo/css/select.css" type="text/css" />
<link rel="stylesheet" href="/promo/css/nouislider.css" type="text/css" />
<link rel="stylesheet" href="/promo/css/jquery.mCustomScrollbar.css" type="text/css" />
<!---->
<script type="text/javascript" src="/promo/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/promo/js/js.js"></script>
<script type="text/javascript" src="/promo/js/step.js"></script>
<script type="text/javascript" src="/promo/js/select.js"></script>
<script type="text/javascript" src="/promo/js/nouislider.js"></script>
<script type="text/javascript" src="/promo/js/jquery.mCustomScrollbar.js"></script>
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
				<div class="text">Your game:</div>
				<div class="activ"><a href="#"><span>CS:GO</span> <img src="/promo/images/ico-game-csgo.png"></a></div>
			</div>
			<div class="leftSub">
				<a href="#">
					<div class="img">
						<img src="/promo/images/ico-game-dota2.png">
					</div>
					<span>DOTA 2 ( COMING SOON )</span>
				</a>
				<a href="#">
					<div class="img">
						<img src="/promo/images/ico-game-cs.png">
					</div>
					<span>COUNTER-STRIKE 1.6 ( COMING SOON )</span>
				</a>
				<a href="#">
					<div class="img">
						<img src="/promo/images/ico-game-lol.png">
					</div>
					<span>LEAGUE OF LEGENDS ( COMING SOON )</span>
				</a>
				<a href="#">
					<div class="img">
						<img src="/promo/images/ico-game-hs.png">
					</div>
					<span>HEARTHSTONE ( COMING SOON )</span>
				</a>
			</div>
			<!--======================================-->
			<!--====выбор языка====-->
			<div class="nav-right">
				<div class="text">Choose your language:</div>
				<div class="activ">
					<a href="/en/about">
						<span>ENG</span>
						<div class="img">
							<img src="/promo/images/ico-en.png">
						</div>
					</a>
				</div>
			</div>
			<div class="rightSub">
				<a href="/about">
					<div class="img">
						<img src="/promo/images/ico-rus.png">
					</div>
					<span>RUS</span>
				</a>

			</div>
			<!--======================================-->
			<!--====social====-->
			<div class="social">
				<span>overPRO in social networks:</span>

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
				<span>Train your skills against opponents of different levels</span><br>
				WHEN VICTORY HAS A PRICE - IT'S A SPORT, NOT A GAME!

			</div>
			<!--======================================-->
			<!--====profile====-->
			<div class="profile" style="display: none;">
				<div class="profile_avatar">
					<div class="avatar users">
						<img src="/promo/images/ava.png">
					</div>
					<span class="rank rank_LS">LS</span>
				</div>
				<div class="name">CyberBattler</div>
				<div class="balance">
					<a href="#" class="with_title" title="market">-</a>
					<span>18 659 RUR</span>
					<a href="#" class="with_title" title="recharge">+</a>
				</div>

				<div class="sub">
					<div class="sub_head">
						<div class="avatar users">
							<img src="/promo/images/ava.png">
						</div>
						<div class="name">CyberBattler</div>
						<div class="skill">Medium skill</div>
						<div class="balance">
							<a href="#" class="with_title" title="Market">-</a>
							<span>18 659</span>
							<a href="#" class="with_title" title="Buy coins">+</a>
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
							<a href="#">GO TO PROFILE</a>
						</li>
						<li>
							<a href="#">EDIT PROFILE</a>
						</li>
						<li>
							<a href="#">BUY COINS</a>
						</li>
						<li>
							<a href="#">FINANCIAL REPORT
</a>
						</li>
						<li>
							<a href="#">INVITE A FRIEND</a>
						</li>
						<li>
							<a href="#">CONNECT WITH TWITCH</a>
						</li>
						<li>
							<a href="#">CONNECT WITH TWITCH</a>
						</li>
						<li>
							<a href="#">LOG OUT</a>
						</li>
					</ul>
				</div>
			</div>

			<a href="#" class="login_steam">
				<span>sign in through STEAM</span>
				<p>and get free 100 coins now</p>
			</a>
		</div>
	</div>
	<!--======================================-->
	<!--====block====-->
	<div id="wrapper" class="">
		<div class="top_info_land">
			<div class="item">
				Play <span>for free</span> or <span>for skins</span>
			</div>
			<div class="item">
				Choose <span>opponents of any rank</span> you want
			</div>
			<div class="item">
				Analyze <span>advanced statistics</span>
			</div>
		</div>
	</div>
	<!--======================================-->
	<!--====setting====-->
	<div id="wrapper" class="">
		<div class="landing_title">
			<div class="land_count">1</div>

			<div class="land_text">Click the <span>CREATE</span> button and setup a custom game in seconds!</div>
		</div>
	</div>

	<div id="wrapper" class="setting">
		<form class="sets" method="" action="">
			<div class="first">
				<div class="item">
					<label>Prize:</label>
					<input id="spinner" name="value" value="100" step="100" disabled>
				</div>
				<div class="item">
					<label>Players:</label>
					<select class="turnintodropdown">
						<option>1х1</option>
						<option>2х2</option>
						<option>3х3</option>
						<option>5х5</option>
					</select>
				</div>
				<div class="item">
					<label>Map:</label>
					<select class="turnintodropdown">
						<option>Aim Map</option>
						<option>De_dust2</option>
						<option>ect.</option>

					</select>
				</div>
				<div class="item">
					<label>AntiCheat:</label>
					<select class="turnintodropdown">
						<option>EAC ON</option>
						<option>EAC OFF</option>
					</select>
				</div>
				<div class="item">
					<label>Location:</label>
					<select class="turnintodropdown">
						<option>Moscow</option>
						<option>Berlin</option>
						<option>New York</option>

					</select>
				</div>
			</div>

			<div class="second">
				<div class="item">
					<label>Team1 name:</label>
					<input type="text" name="" placeholder="Red Team" value="Red Team" required/>
				</div>
				<div class="item">
					<label>Team2 name:</label>
					<input type="text" name="" placeholder="Blue Team" value="Blue Team" required/>
				</div>
				<div class="item">
					<label>Skill balance:</label>
					<select class="turnintodropdown">
						<option>ON</option>
						<option>OFF</option>
					</select>
				</div>
				<div class="item">
					<label>Hidden names:</label>
					<select class="turnintodropdown">
						<option>ON</option>
						<option>OFF</option>
					</select>
				</div>
				<div class="item">
					<label>Password:</label>
					<input type="password" name="" placeholder="is not set">
				</div>
			</div>

			<div class="third">
				<div class="skill_block">
					<span>Players skill:</span>
					<div class="skill_line">
						<p>LowSkill - OverPro</p>
						<div id="param"></div>
					</div>
				</div>

				<div class="block_player">
					<span>Block players:</span>
					<a href="#"><img src="/promo/images/sets/save.png"></a>
					<a href="#"><img src="/promo/images/sets/delete.png"></a>
					<textarea></textarea>
					<button class="start_game">
						<span>CREATE A GAME</span>
						<p>and start your battle now!</p>
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
			<div class="land_text">Participants can <span>JOIN</span> a game from the home page. Click the <span>READY</span> button!</div>
		</div>
	</div>

	<div id="wrapper" class="game_list">
		<div class="game_list_block">
			<div class="thead">
				<div class="inner">
					<div class="item">Server name</div>
					<div class="item">Creator</div>
					<div class="item">Prize</div>
					<div class="item">Players</div>
					<div class="item">Map</div>
					<div class="item"><img src="/promo/images/game/ico-1.png"></div>
					<div class="item"><img src="/promo/images/game/ico-2.png"></div>
					<div class="item"><img src="/promo/images/game/ico-3.png"></div>
					<div class="item">Skill</div>
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
						Location

						<form class="subTsets">
							<div class="subItem">
								<input type="checkbox" name="" id="location1" checked>
								<label for="location1">Show all</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="location2">
								<label for="location2">Moscow</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="location3">
								<label for="location3">Berlin</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="location4">
								<label for="location4">New York</label>
							</div>
						</form>
					</div>
					<div class="item child">
						Map

						<form class="subTsets">
							<div class="subItem">
								<input type="checkbox" name="" id="map1" checked>
								<label for="map1">Show all</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="map2">
								<label for="map2">de_dust 2</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="map3">
								<label for="map3">Aim_map</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="map4">
								<label for="map4">ect</label>
							</div>
						</form>
					</div>
					<div class="item child">
						Mode

						<form class="subTsets">
							<div class="subItem">
								<input type="checkbox" name="" id="mode1" checked>
								<label for="mode1">Show all</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="mode2">
								<label for="mode2">1x1</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="mode3">
								<label for="mode3">2x2</label>
							</div>
							<div class="subItem">
								<input type="checkbox" name="" id="mode4">
								<label for="mode4">5x5</label>
							</div>
						</form>
					</div>
					<div class="item child">
						AntiCheat

						<form class="subTsets">
							<div class="subItem">
								<input type="checkbox" name="" id="cheats1" checked>
								<label for="cheats1">Show all</label>
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
						<div class="tsets_title">from <span>0</span> to <span>10000</span></div>
						<div id="param2"></div>
					</div>
					<div class="item">
						<div class="tsets_title">from <span class="rank rank_LS">LS</span> to <span class="rank rank_OP">OP</span></div>
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
					<div class="item"><span class="rank rank_LS">LS</span> Nick</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank rank_AS">AS</span>&nbsp; - &nbsp;<span class="rank rank_SS">SS</span></div>
					<div class="item"><span>Moscow</span></div>
					<div class="item">1 minute</div>
					<div class="item"><a href="#">JOIN</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank rank_LS">LS</span> Nick</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank rank_LS">LS</span>&nbsp; - &nbsp;<span class="rank rank_OP">OP</span></div>
					<div class="item"><span>Moscow</span></div>
					<div class="item">1 minute</div>
					<div class="item"><a href="#">JOIN</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank rank_MS">MS</span> Nick</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank rank_MS">MS</span>&nbsp; - &nbsp;<span class="rank rank_MS">MS</span></div>
					<div class="item"><span>Moscow</span></div>
					<div class="item">1 minute</div>
					<div class="item"><a href="#">JOIN</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank rank_HS">HS</span> Nick</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank rank_HS">HS</span>&nbsp; - &nbsp;<span class="rank rank_PS">PS</span></div>
					<div class="item"><span>Moscow</span></div>
					<div class="item">1 minute</div>
					<div class="item"><a href="#">JOIN</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank rank_LS">LS</span> Nick</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank rank_LS">LS</span>&nbsp; - &nbsp;<span class="rank rank_OP">OP</span></div>
					<div class="item"><span>Moscow</span></div>
					<div class="item">1 minute</div>
					<div class="item"><a href="#">JOIN</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank rank_LS">LS</span> Nick</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank rank_LS">LS</span>&nbsp; - &nbsp;<span class="rank rank_OP">OP</span></div>
					<div class="item"><span>Moscow</span></div>
					<div class="item">1 minute</div>
					<div class="item"><a href="#">JOIN</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank rank_LS">LS</span> Nick</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank rank_LS">LS</span>&nbsp; - &nbsp;<span class="rank rank_OP">OP</span></div>
					<div class="item"><span>Moscow</span></div>
					<div class="item">1 minute</div>
					<div class="item"><a href="#">JOIN</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank rank_LS">LS</span> Nick</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank rank_LS">LS</span>&nbsp; - &nbsp;<span class="rank rank_OP">OP</span></div>
					<div class="item"><span>Moscow</span></div>
					<div class="item">1 minute</div>
					<div class="item"><a href="#">JOIN</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank rank_LS">LS</span> Nick</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank rank_LS">LS</span>&nbsp; - &nbsp;<span class="rank rank_OP">OP</span></div>
					<div class="item"><span>Moscow</span></div>
					<div class="item">1 minute</div>
					<div class="item"><a href="#">JOIN</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank rank_LS">LS</span> Nick</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank rank_LS">LS</span>&nbsp; - &nbsp;<span class="rank rank_OP">OP</span></div>
					<div class="item"><span>Moscow</span></div>
					<div class="item">1 minute</div>
					<div class="item"><a href="#">JOIN</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank rank_LS">LS</span> Nick</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank rank_LS">LS</span>&nbsp; - &nbsp;<span class="rank rank_OP">OP</span></div>
					<div class="item"><span>Moscow</span></div>
					<div class="item">1 minute</div>
					<div class="item"><a href="#">JOIN</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank rank_LS">LS</span> Nick</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank rank_LS">LS</span>&nbsp; - &nbsp;<span class="rank rank_OP">OP</span></div>
					<div class="item"><span>Moscow</span></div>
					<div class="item">1 minute</div>
					<div class="item"><a href="#">JOIN</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank rank_LS">LS</span> Nick</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank rank_LS">LS</span>&nbsp; - &nbsp;<span class="rank rank_OP">OP</span></div>
					<div class="item"><span>Moscow</span></div>
					<div class="item">1 minute</div>
					<div class="item"><a href="#">JOIN</a></div>
				</div>
				<div class="inner">
					<div class="item"><span>Red</span> vs <span>Blue</span></div>
					<div class="item"><span class="rank rank_LS">LS</span> Nick</div>
					<div class="item">100</div>
					<div class="item">9/10</div>
					<div class="item"><img src="/promo/images/game/img.png"></div>
					<div class="item"><img src="/promo/images/game/ico-on.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><img src="/promo/images/game/ico-off.png"></div>
					<div class="item"><span class="rank rank_LS">LS</span>&nbsp; - &nbsp;<span class="rank rank_OP">OP</span></div>
					<div class="item"><span>Moscow</span></div>
					<div class="item">1 minute</div>
					<div class="item"><a href="#">JOIN</a></div>
				</div>
			</div>
		</div>
	</div>
	<!--======================================-->
	<!--====game_preview====-->
	<div id="wrapper" class="">
		<div class="landing_title">
			<div class="land_count">3</div>
			<div class="land_text">Click the button <span>CONNECT</span> - CSGO launches in no time - <span>start playing!</div>
		</div>
	</div>

	<div id="wrapper" class="game_preview">
		<div class="preview_block">
			<div class="preview_inner">
				<div class="item">
					<div class="link_for_game">
						<span>Match URL:</span>&nbsp;<p>https://overpro.ru/mix20195</p>
						<a href="#" class="save_game_link"></a>
					</div>
					<div class="preview_map">
						<img src="/promo/images/game/map.png">
					</div>
					<div class="preview_location">
						Location: <span>Mosocw</span>
					</div>
				</div>

				<div class="item">
					<div class="player_list">
						<div class="player_item">
							<div class="avatar admin"><img src="/promo/images/ava.png"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Move&nbsp;to&nbsp;another&nbsp;team"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Kick&nbsp;from&nbsp;lobby"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
						<div class="player_item">
							<div class="avatar admin"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Move&nbsp;to&nbsp;another&nbsp;team"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Kick&nbsp;from&nbsp;lobby"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
						<div class="player_item">
							<div class="avatar admin"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Move&nbsp;to&nbsp;another&nbsp;team"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Kick&nbsp;from&nbsp;lobby"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
						<div class="player_item">
							<div class="avatar admin"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Move&nbsp;to&nbsp;another&nbsp;team"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Kick&nbsp;from&nbsp;lobby"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
						<div class="player_item">
							<div class="avatar admin"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Move&nbsp;to&nbsp;another&nbsp;team"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Kick&nbsp;from&nbsp;lobby"><img src="/promo/images/game/kick.png"></a>
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
								<a href="#" class="with_title" title="Move&nbsp;to&nbsp;another&nbsp;team"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Kick&nbsp;from&nbsp;lobby"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
						<div class="player_item">
							<div class="avatar admin"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Move&nbsp;to&nbsp;another&nbsp;team"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Kick&nbsp;from&nbsp;lobby"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
						<div class="player_item">
							<div class="avatar admin"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Move&nbsp;to&nbsp;another&nbsp;team"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Kick&nbsp;from&nbsp;lobby"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
						<div class="player_item">
							<div class="avatar admin"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Move&nbsp;to&nbsp;another&nbsp;team"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Kick&nbsp;from&nbsp;lobby"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
						<div class="player_item">
							<div class="avatar admin"></div>
							<div class="skill rank">LS</div>

							<div class="controls">
								<a href="#" class="with_title" title="Move&nbsp;to&nbsp;another&nbsp;team"><img src="/promo/images/game/switch.png"></a>
								<a href="#" class="with_title" title="Kick&nbsp;from&nbsp;lobby"><img src="/promo/images/game/kick.png"></a>
							</div>
						</div>
					</div>
				</div>

				<div class="item">
					<div class="big_prize">190000</div>
					<div>
						<div class="prize_item">
							<a href="#">
								<span>LAUNCH EAC</span>
								<p>1 - launch AntiCheat</p>
							</a>
							<div class="prize_text">How to install anticheat EAC</div>
						</div>
						<div class="prize_item">
							<a href="#">
								<span>CONNECT</span>
								<p>2 - launch CSGO</p>
							</a>
							<div class="prize_text">connect 195.88.208.41:27040</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="detail_game_block animated" id="detail_game_block">
			<div class="detail_sets">
				<div class="detail_title">GAME SETTINGS</div>
				<ul>
					<li>
						<label>Players:</label>
						<div class="detail_param">5х5</div>
					</li>
					<li>
						<label>Location:</label>
						<div class="detail_param">Moscow</div>
					</li>
					<li>
						<label>AntiCheat:</label>
						<div class="detail_param">OFF</div>
					</li>
					<li>
						<label>Skill:</label>
						<div class="detail_param"><span class="rank rank_LS">LS</span> - <span class="rank rank_OP">OP</span></div>
					</li>
					<li>
						<label>Hidden names:</label>
						<div class="detail_param">OFF</div>
					</li>
					<li>
						<label>Skill balance:</label>
						<div class="detail_param">ON</div>
					</li>
					<li>
						<label>Password:</label>
						<div class="detail_param">is not set</div>
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
									GO, are you ready?
								</div>
							</li>
							<li class="systems">
								<div class="logs_time">23:59:09</div>
								<div class="logs_name">SYSTEM:</div>
								<div class="logs_text">
									CyberBattler was moved from team RED to team BLUE

								</div>
							</li>
							<li>
								<div class="logs_time">23:59:09</div>
								<div class="logs_name">CyberBattler:</div>
								<div class="logs_text">
									GO, are you ready?
								</div>
							</li>
							<li>
								<div class="logs_time">23:59:09</div>
								<div class="logs_name">CyberBattler:</div>
								<div class="logs_text">
									GO, are you ready?
								</div>
							</li>
							<li>
								<div class="logs_time">23:59:09</div>
								<div class="logs_name">CyberBattler:</div>
								<div class="logs_text">
									GO, are you ready?
								</div>
							</li>
							<li>
								<div class="logs_time">23:59:09</div>
								<div class="logs_name">CyberBattler:</div>
								<div class="logs_text">
									GO, are you ready?
								</div>
							</li>
						</ul>
					</div>
				</div>

				<form class="detail_form" action="" method="">
					<textarea placeholder="type the text" required/></textarea>
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
			<div class="land_text">After winning, check the stats, <span>learn from and review the played matches!</span></div>
		</div>
	</div>

	<div id="wrapper" class="end_stats_game">
		<div class="end_block">
			<div class="set">
				<div class="item">AntiCheat - <span>ON</span></div>
				<div class="item">Skill balance - <span>ON</span></div>
				<div class="item">Hidden names - <span>ON</span></div>
				<div class="item"><a href="#"></a> Demo</div>
			</div>
			<div class="frame">
				<div class="img"><img src="/promo/images/game/big-map-img.jpg"></div>
				<div class="best">
					BEST PLAYER:
					<div class="avatar users"><img src="/promo/images/ava.png"></div>
					<span>Cyberbattler</span>
				</div>
			</div>

			<div class="end_stats_block">
				<div class="end_team">
					<div class="end_table">
						<div class="title">RED</div>
						<div class="head">
							<div class="item">Name</div>
							<div class="item">TeamPlay</div>
							<div class="item">Frags</div>
							<div class="item">Deaths</div>
							<div class="item">Assists</div>
							<div class="item">ELO</div>
							<div class="item">Money</div>
							<div class="item">&nbsp;</div>
						</div>
						<div class="body">
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>Cyberbattler</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">-25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Report"></a></div>
							</div>
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>Cyberbattler</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">-25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Report"></a></div>
							</div>
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>Cyberbattler</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">-25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Report"></a></div>
							</div>
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>Cyberbattler</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">-25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Report"></a></div>
							</div>
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>Cyberbattler</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">-25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Report"></a></div>
							</div>
						</div>
					</div>
				</div>

				<div class="end_team">
					<div class="end_table">
						<div class="title winner">BLUE</div>
						<div class="head">
							<div class="item">Name</div>
							<div class="item">TeamPlay</div>
							<div class="item">Frags</div>
							<div class="item">Deaths</div>
							<div class="item">Assists</div>
							<div class="item">ELO</div>
							<div class="item">Money</div>
							<div class="item">&nbsp;</div>
						</div>
						<div class="body">
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>Cyberbattler</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">+25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Report"></a></div>
							</div>
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>Cyberbattler</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">+25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Report"></a></div>
							</div>
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>Cyberbattler</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">+25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Report"></a></div>
							</div>
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>Cyberbattler</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">+25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Report"></a></div>
							</div>
							<div class="inner">
								<div class="item"><div class="avatar users"><img src="/promo/images/ava.png"></div>Cyberbattler</div>
								<div class="item praised">
									<div class="dislike"><a>-</a></div>
									<div class="like"><a>+</a></div>
								</div>
								<div class="item">150</div>
								<div class="item">51</div>
								<div class="item">31</div>
								<div class="item">+25</div>
								<div class="item">0</div>
								<div class="item"><a class="report with_title" title="Report"></a></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<form class="dislike_form">
				<div class="title">Why dislike
?</div>
				<input type="text" name="" placeholder="Why dislike
?" required/>
				<input type="submit" name="" value="OK">
			</form>
		</div>
	</div>
	<!--======================================-->
	<!--====profile_page====-->
	<div id="wrapper" class="">
		<div class="landing_title">
			<div class="land_count">5</div>
			<div class="land_text"><span>Analyze </span> strong enemies and <span>build your own tactics!
</span></div>
		</div>
	</div>

	<div id="wrapper" class="profile_page">
		<div class="prof_top">
			<div class="prof_avatar">
				<div class="text">Download picture</div>
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
					<input type="text" name="" value="Russia, Smolensk">
				</div>
				<div class="information">
					<textarea>I am the best player of overPRO! And eSports is my lifestyle! </textarea>
				</div>
				<div class="social_block">
					<div class="soc_title">Contacts:</div>
					<div class="social_block_item">
						<!-- Пример пустого блока
						<div class="item empty">
							<div class="intro"><img src="/promo/"></div>
							<div class="social_block_icons">
								<div class="soc_icon"><img src="/promo/images/profile/icon/ico-1.png"></div>
								<div class="soc_icon"><img src="/promo/images/profile/icon/ico-2.png"></div>
								<div class="soc_icon"><img src="/promo/images/profile/icon/ico-3.png"></div>
								<div class="soc_icon"><img src="/promo/images/profile/icon/ico-4.png"></div>
								<div class="soc_icon"><img src="/promo/images/profile/icon/ico-5.png"></div>
								<div class="soc_icon"><img src="/promo/images/profile/icon/ico-6.png"></div>
								<div class="soc_icon"><img src="/promo/images/profile/icon/ico-7.png"></div>
								<div class="soc_icon"><img src="/promo/images/profile/icon/ico-8.png"></div>
								<div class="soc_icon"><img src="/promo/images/profile/icon/ico-9.png"></div>
							</div>
						</div>
						-->
						<!-- Пример активного блока
						<div class="item active">
							<div class="intro"><img src="/promo/images/profile/icon/ico-1.png"></div>
							<div class="soc_block_link">
								<a class="switch_soc_item with_title" title="Edit"></a>
								<a class="delete_soc_item with_title" title="Delete"></a>
							</div>
						</div>
						-->
					</div>

					<form class="soc_block_form">
						<input type="text" name="" class="add_soc_link" placeholder="URL">
						<input type="submit" name="" class="save_soc_link" value="OK">
					</form>
				</div>
				<div class="prize_skill_count">
					<div class="item">
						<div class="count">5</div>
						<div class="text">Gold</div>
					</div>
					<div class="item">
						<div class="count">10</div>
						<div class="text">Silver</div>
					</div>
					<div class="item">
						<div class="count">20</div>
						<div class="text">Bronze</div>
					</div>
				</div>
			</div>
		</div>

		<div class="prof_stats_stat">
			<div class="prof_stats_items">
				<div class="item">
					<div class="item_inner">ELO <span>4200</span></div>
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
			<div class="land_text">Buy and sell coins <img src="/promo/images/game/par-prize.png">&nbsp;&nbsp;for real <span>money and skins!</span></div>
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
				<div class="title">Total: <span>0</span></div>
				<div class="bank_deal_items">
					<!-- Пример
					<div class="item">
						<div class="name">AK-47 | NEON REVOLUTION</div>
						<div class="count"><span>65986</span></div>
						<a class="delete"></a>
					</div>
					конец примера-->
				</div>
				<a class="go_deal">CONFIRM</a>
			</div>
		</div>
	</div>
	<!--======================================-->
	<!--====donate====-->
	<div id="wrapper" class="donate_wrap">
		<div class="donate_block">
			<div class="donate_text">
				<div class="text">
					GET +50% on FIRST deposit till 1000 coins
				</div>
				<div class="donate_timer">
					<div class="title">PROMOTION ENDS IN:</div>
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
				<div class="title">buy coins for money
:</div>
				<form>
					<div class="item">
						<input type="text" id="spinner1" name="" value="1000" step="100" disabled/>
					</div>
					<label> = </label>
					<div class="item">
						<input type="text" id="spinner2" name="" value="1" step="1000" disabled/>
					</div>
					<div class="val">USD</div>
				</form>
				<ul class="option_links">
					<li class="active"><img src="/promo/images/ico-d-1.png"></li>
					<li><img src="/promo/images/ico-d-2.png"></li>
					<li><img src="/promo/images/ico-d-3.png"></li>
					<li><img src="/promo/images/ico-d-4.png"></li>
					<li><img src="/promo/images/ico-d-5.png"></li>
					<a class="more_donate_links">More</a>
				</ul>
			</div>

			<div class="donate_img"></div>

			<div class="donate_item_option">
				<div class="title">or for skins:</div>
				<a href="#" class="opt_donate_btn">
					<span>Buy overPRO coins</span>
					<p>FOR CSGO SKINS</p>
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
				<p>GAMES PLAYED</p>
			</div>
			<div class="item">
				<span>1.500.000 +</span>
				<p>USD TOTAL PRIZE</p>
			</div>
			<div class="item">
				<span>300.000 +</span>
				<p>PlAYERS REGISTERED</p>
			</div>
		</div>

		<a href="#" class="login_steam_land">
			<span>sign in through STEAM</span>
			<p>and get free 100 coins now</p>
		</a>
	</div>
	<!--======================================-->
	<!--====tournament====-->
	<div id="wrapper" class="">
		<div class="landing_title" style="margin-top: 0;">
			<div class="land_img"><img src="/promo/images/new/ico-title-3.png"></div>
                         <div class="land_text">Win overPRO <span>online qualifiers</span> and get your passes for <span>worldwide events!</span></div>
		</div>
	</div>

	<div id="wrapper" class="tournament">
		<div class="tournament_block">
			<div class="frame">
				<img class="tour_bg" src="/promo/images/new-banner.jpg">
				<!--
				<div class="text">
					<div class="img"><img src="/promo/images/new-banner.png"></div>
					<div class="info">
						<div class="title"> <span>DEATH-MATCH</span>Promotion</div>
						<p>
							Every Hour: <span>top 3 players</span>  by count of kills and
 deaths for 1 hour <span>divide 90% commissions!</span>
						</p>
					</div>
				</div>
				-->
			</div>
			<div class="send">
				<div class="text">INFO AND PRIZES | SEARCH TEAM | QUESTIONS</div>
				<div class="info">TEAMS REGISTERED <b>80</b> | <b>128</b></div>
				<a href="#tournament_detail" id="showMoreTour">
					<span>REGISTER YOUR TEAM</span>
					<p>Participants must be registered
</p>
				</a>
			</div>
		</div>

		<a href="#tournament_detail" class="show_more_info showMoreStyle" id="showMore">MORE</a>

		<div class="tournament_detail" id="tournament_detail">
			<div class="tournament_detail_block">
				<div class="thead">
					<div class="item">ID</div>
					<div class="item">Team name</div>
					<div class="item">Captain</div>
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
					<label>Team name:</label>
					<input type="text" name="" placeholder="team tag" required/>
				</div>
				<div class="item">
					<label>Captain:</label>
					<input type="text" name="" placeholder="steamID64. Example
76561198317582204" required/>
				</div>
				<div class="item">
					<label>Player 2:</label>
					<input type="text" name="" placeholder="steamID64. Example
76561198317582204" required/>
				</div>
				<div class="item">
					<label>Player 3:</label>
					<input type="text" name="" placeholder="steamID64. Example
76561198317582204" required/>
				</div>
				<div class="item">
					<label>Player 4:</label>
					<input type="text" name="" placeholder="steamID64. Example
76561198317582204" required/>
				</div>
				<div class="item">
					<label>Player 5:</label>
					<input type="text" name="" placeholder="steamID64. Example
76561198317582204" required/>
				</div>
				<div class="item">
					<label>Player 6:</label>
					<input type="text" name="" placeholder="steamID64. Example
76561198317582204" required/>
				</div>
				<div class="item">
					<label>Player 7:</label>
					<input type="text" name="" placeholder="steamID64. Example
76561198317582204" required/>
				</div>
				<div class="item">
					<label>Cotnacts:</label>
					<input type="text" name="" placeholder="steamID64. Example
76561198317582204" required/>
				</div>
				<input type="submit" name="" value="REGISTER NOW" class="tour_btn">
			</form>
		</div>
	</div>
	<!--======================================-->
	<!--====rank_all_stats_general====-->
	<div id="wrapper" class="">
		<div class="landing_title">
			<div class="land_img"><img src="/promo/images/new/ico-title-2.png"></div>
			<div class="land_text">Improve your skill in battles against <span>opponents of different levels!</span> Fight your way <span>to the top!</span></div>
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
					<div class="title">ELO RAITING</div>
					<div class="inner">
						<div class="inner_item">
							<div class="name">Cyberbattler</div>
						</div>
						<div class="inner_item">
							<div class="name">Cyberbattler</div>
						</div>
						<div class="inner_item">
							<div class="name">Cyberbattler</div>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="title">KD RAITING</div>
					<div class="inner">
						<div class="inner_item">
							<div class="name">Cyberbattler</div>
						</div>
						<div class="inner_item">
							<div class="name">Cyberbattler</div>
						</div>
						<div class="inner_item">
							<div class="name">Cyberbattler</div>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="title">HEADSHOTS RAITING</div>
					<div class="inner">
						<div class="inner_item">
							<div class="name">Cyberbattler</div>
						</div>
						<div class="inner_item">
							<div class="name">Cyberbattler</div>
						</div>
						<div class="inner_item">
							<div class="name">Cyberbattler</div>
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
			<div class="land_text"><span>Train your aim</span> in <span>DEATH-MATCH</span> mode - the result depends only on <span>your reaction!</span></div>
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
							<p>players</p>
						</div>
					</div>
					<div class="item">
						<div class="frame"><img src="/promo/images/game/img.png"></div>
						<div class="text">
							<span>10 / 18</span>
							<p>players</p>
						</div>
					</div>
					<div class="item">
						<div class="frame"><img src="/promo/images/game/img.png"></div>
						<div class="text">
							<span>10 / 18</span>
							<p>players</p>
						</div>
					</div>
					<div class="item">
						<div class="frame"><img src="/promo/images/game/img.png"></div>
						<div class="text">
							<span>10 / 18</span>
							<p>players</p>
						</div>
					</div>
					<div class="item">
						<div class="frame"><img src="/promo/images/game/img.png"></div>
						<div class="text">
							<span>10 / 18</span>
							<p>players</p>
						</div>
					</div>
					<div class="item">
						<div class="frame"><img src="/promo/images/game/img.png"></div>
						<div class="text">
							<span>10 / 18</span>
							<p>players</p>
						</div>
					</div>
				</div>
			</div>

			<div class="death_stats">
				<div class="death_stats_info">
					<div class="item">
						<span>5</span>
						<p>FRAG</p>
					</div>
					<div class="item">
						<span>1</span>
						<p>DEATH</p>
					</div>
					<div class="item">
						<span>8</span>
						<p>HEADSHOT</p>
					</div>
				</div>

				<div class="death_stats_links">
					<div class="item">
						<a href="#">
							<span>LAUNCH EAC</span>
							<p>1 - launch anticheat</p>
						</a>
					</div>
					<div class="item">
						<a href="#">
							<span>CONNECT</span>
							<p>2 - launch CSGO</p>
						</a>
						<div class="text">connect 195.88.208.41:27040</div>
					</div>
				</div>
			</div>

			<div class="death_timer">
				<div class="death_timer_title">
					Promotion! Every Hour - top 3 players by count of kills and
 deaths for 1 hour divide 90% commissions of all Death-Match servers!
				</div>
				<div class="death_timer_count">
					<div class="item">
						<span>ENDS IN</span>
						<div class="timer">
							<div class="count hour">00</div>
							<div class="count">:</div>
							<div class="count min">00</div>
							<div class="count">:</div>
							<div class="count sec">00</div>
						</div>
					</div>
					<div class="item">
						<span>CURRENT PRIZE</span>
						<p>190000</p>
					</div>
				</div>
			</div>
		</div>

		<a href="#death_detail" class="show_more_info" id="showMore">CURRENT LEADERS</a>

		<div class="death_detail" id="death_detail">
			<div class="death_player_lists">
				<div class="death_player_lists_title">PLAYERS ON THE SERVER</div>
				<div class="death_player_table">
					<div class="thead">
						<div class="item">Nickname</div>
						<div class="item">Frags</div>
						<div class="item">Deaths</div>
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
						<div class="item">Current place</div>
						<div class="item">Points</div>
						<div class="item">Current prize</div>
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
			<div class="land_text">Stream your <span>victory!</span> The easiest place to setup <span>viewer and sub games!</span></div>
		</div>
	</div>

	<div id="wrapper" class="online_stream">
		<div class="stream_block">
			<div class="stream_block_land">
				<div class="stream_item">
					<div class="frame"><img src="/promo/images/game/map.png"></div>
					<div class="op_top">
						<div class="left">1000 viewers</div>
						<div class="right"><span>5000</span> prize</div>
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
						<div class="left">1000 viewers</div>
						<div class="right"><span>5000</span> prize</div>
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
						<div class="left">1000 viewers</div>
						<div class="right"><span>5000</span> prize</div>
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
					<span>Setup a custom game in seconds!</span>
					<p>Invite your viewers directly or through invite links. Manage your game and get donates from fans
!</p>
				</div>
			</div>
		</div>

		<a href="#stream_detail" class="show_more_info" id="showMore">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MORE BROADCASTS
		</a>

		<div class="stream_detail" id="stream_detail">
			<div class="stream_detail_online">
				<div class="frame"><img src="/promo/images/game/big-img.png"></div>
				<div class="op_top">
					<div class="left">1000 viewers</div>
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


			<div class="land_text_center"><span>JOIN</span> OUR TEAM AND BUILD YOUR <span> OWN eSPORTS CAREER</span></div>
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
					DEVELOPERS OF FIRST AUTOMATIC <br>MATCH-MAKING FOR MONEY
				</span>
			</div>
			<div class="item">
				<span>
					INTERNATIONAL TEAM OF DEVELOPERS - <br>PLAYERS OF CS 1.6, GO, DOTA2, SC2, QL
				</span>
			</div>
		</div>
	</div>
	<!--======================================-->
	<!--====online_stream====-->
	<div id="wrapper" class="">
		<div class="landing_title">
			<div class="land_text_last">
				<span>DISCOVER THE NEW ERA OF eSPORTS WITH OVERPRO</span>
 				By revealing the true needs of each one of us, we create a sensational platforms for the evolution of eSports!

			</div>
		</div>
	</div>

	<div id="wrapper" class="">
		<div class="land_era">
			<div class="item">
				<div class="title">INTERFACE TO CREATE YOUR<span>OWN ESPORTS CLUB</span></div>
				<div class="text">
					We design an entire ecosystem that allows you to create, <br>own and manage your own eSports club
				</div>
				<ul>
					<li>- &nbsp;Sign contracts, assign a manager, team captain, players, etc.</li>
					<li>- &nbsp;Set salaries, collect a fee from matches, tournament prize pools</li>
					<li>- &nbsp;Grow a fan club, create polls and blogs, get donations</li>
					<li>- &nbsp;Compete with other clubs, grow in rankings and find sponsors!</li>
				</ul>
			</div>
			<div class="item">
				<div class="title">INTERFACE TO ORGANIZE YOUR OWN <span>LEAGUES AND TOURNAMENT SERIES</span></div>
				<div class="text">
					You don’t have to rent a server or conduct the tournament <br>sheets manually and deal with the judges - it's all automized!
				</div>
				<ul>
					<li>- &nbsp;Set a prize pool for the tournament, charge comssions from entry fees</li>
					<li>- &nbsp;Assign a ticket price, give quotas to your favorite teams</li>
					<li>- &nbsp;Organize tournament series - increase the fund size for the finals</li>
					<li>- &nbsp;Develop your league, your brand, get famous and generate income!</li>
				</ul>
			</div>
		</div>
		<a href="#" class="login_steam_era_land">
			<span>sign in through STEAM</span>
			<p>and get free 100 coins now</p>
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
				<span>OVERPRO IN SOCIAL NETWORKS:</span>
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

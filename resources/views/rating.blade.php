@extends('core::layouts.master')

@section('content')
  <div id="wrapper" class="rank_all_stats">
  		<div class="rank_tabs_block">
  			<div class="rank_items">
  				<div class="item active">
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

  		<div class="rank_stats_block">
  			<div class="head">
  				<div class="item">#</div>
  				<div class="item">Никнейм игрока</div>
  				<div class="item">&nbsp;</div>
  				<div class="item">ELO</div>
  				<div class="item">Фрагов</div>
  				<div class="item">Хедшотов</div>
  				<div class="item">Ассистов</div>
  				<div class="item">KD рейтинг</div>
  				<div class="item">% Побед</div>
  				<div class="item">Командная игра</div>
  				<div class="item">Лучший игрок</div>
  			</div>
  			<div class="body">
  				<div class="inner">
  					<div class="item"><span>1</span></div>
  					<div class="item">CyberBattler</div>
  					<div class="item"><span class="rank">LS</span></div>
  					<div class="item">1545</div>
  					<div class="item">1545</div>
  					<div class="item">1545</div>
  					<div class="item">54%</div>
  					<div class="item">1545</div>
  					<div class="item">65%</div>
  					<div class="item">50000</div>
  					<div class="item">5%</div>
  				</div>
  			</div>
  			<div class="pagination">
  				<ul>
  					<li><div class="pages">Страница <span>1</span> из <span>15</span></div></li>
  					<li><a href="#"><</a></li>
  					<li><a href="#">></a></li>
  				</ul>
  			</div>
  		</div>
  	</div>
@endsection

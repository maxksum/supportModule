<template>
<div id="general">

	<!-- КОД ПИСАТИ ТУТ -->
	<div class="container" v-if="user.role == 'administrator'">
		<div class="tickets__wrap border-box" style="margin-top: 50px">
			<div class="admin-tickets">
				<div class="admin-tickets__lt">
					<div class="admin-tickets__nav">
						<a class="btn btn_yellow-bord btn_ticket" onclick="myPopupNewTicket()">Новый тикет</a>
						<div class="admin-tickets__nav-search">
							<form class="player_ttl_search">
								<input type="text" name="searchticket" @keyup.enter="searchtickets()" onkeydown="if(event.keyCode==13){return false;}" placeholder="Поиск по тикетам" class="js-input-search">
								<span class="player_ttl_search__close"></span>
								<button v-on:click="searchtickets()" type="button" class="js-input-submit">
									<img src="images/search_white.png" alt="ico">
								</button>
							</form>
						</div>
						<ul class="h-reset-list admin-tickets__nav-links">
							<li v-bind:class="[sortvalue == 'all' ? 'active' : '']">
								<a v-on:click="sortchangeforadmin('all')">Все тикеты</a>
							</li>
							<li v-bind:class="[sortvalue == 'created_at' ? 'active' : '']">
								<a v-on:click="sortchangeforadmin('created_at')">Новые</a>
							</li>
							<li v-bind:class="[sortvalue == 'open' ? 'active' : '']">
								<a v-on:click="sortchangeforadmin('open')">Открытые</a>
							</li>
							<li v-bind:class="[sortvalue == 'close' ? 'active' : '']">
								<a v-on:click="sortchangeforadmin('close')">Закрытые</a>
							</li>
						</ul>
					</div>
					<div class="admin-tickets__items">
						<div v-bind:class="[ticket.state == 3 || ticket.state == 4 ? 'tickets__main-item' : 'tickets__main-item tickets__main-item_active']" v-for="ticket in tickets" style="cursor: pointer">
							<router-link :to="{ name: 'SupportShow', params: {id: ticket.id } }" tag='div' class="tickets__main-item-lt">
								<div class="admin-tickets__item-status">
									<span class="ticket-status">
										<span></span>
									</span>
								</div>
								<div class="admin-tickets__item-icon h-object-fit" style="margin-right: 20px;">
									<img :src="user.avatar_medium" alt="">
								</div>
								<div class="tickets__main-item-descr" v-if="ticket.category == 'Жалоба на игрока' || ticket.category == 'Жалоба на админа'">
									<span>Жалоба на </span>
									<span class="ticket-player">
										<span class="ticket-player-img h-object-fit">
										<img :src="ticket.complaint.avatar" alt="">
										</span>
										<span class="ticket-player-name">{{ ticket.complaint.name }}</span>
									</span>
								</div>
								<div class="tickets__main-item-num" v-if="ticket.newmessages !== 0 && ticket.admin_id == user.id">
									<span class="ticket-number">+{{ticket.newmessages}}</span>
								</div>
								<div class="tickets__main-item-descr" v-else>
									<span>{{ ticket.title }}</span>
								</div>
							</router-link>
							<div class="tickets__main-item-rt">
								<div class="tickets__main-item-players" v-if="ticket.participants !== null">
									<span class="ticket-player-img h-object-fit" v-for="part in ticket.participants">
										<a v-if="part != null" :href="'user/' + part.user_id"><img :src="part.avatar"></a>
									</span>
								</div>
								<div class="tickets__main-item-reason">{{ ticket.category }}</div>
							</div>
						</div>
					</div>
					<div class="tickets__breadcrumbs-wrap" v-if="tickets.length !== 0">
						<ul class="h-reset-list tickets__breadcrumbs">
							<li v-bind:class="[page == pagenumber ? 'active' : '']" v-for="pagenumber in pages" v-on:click="changepage(pagenumber)">
								<a>{{ pagenumber }}</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="admin-tickets__rt">
					<div class="admin-tickets__rt-wrapper">
						<div class="admin-tickets__rt-wrap">
							<div class="admin-tickets__rt-top">
								<p class="admin-tickets__rt-title">Тикеты по категориям</p>
							</div>
							<div class="admin-tickets__rt-block">
								<div class="ticket-player">
									<!-- <span class="ticket-player-img h-object-fit">
										<img src="images/ava.png" alt="alt">
									</span> -->
									<a v-on:click="sortchangeforadmin('Читы')" class="ticket-player-name">Читы</a>
								</div>
								<div class="ticket-player">
									<!-- <span class="ticket-player-img h-object-fit">
										<img src="images/ava.png" alt="alt">
									</span> -->
									<a v-on:click="sortchangeforadmin('Баги')" class="ticket-player-name">Баги</a>
								</div>
								<div class="ticket-player">
									<!-- <span class="ticket-player-img h-object-fit">
										<img src="images/ava.png" alt="alt">
									</span> -->
									<a v-on:click="sortchangeforadmin('Финансы')" class="ticket-player-name">Финансы</a>
								</div>
								<div class="ticket-player">
									<!-- <span class="ticket-player-img h-object-fit">
										<img src="images/ava.png" alt="alt">
									</span> -->
									<a v-on:click="sortchangeforadmin('Жалоба на игрока')" class="ticket-player-name">Жалоба на игрока</a>
								</div>
								<div class="ticket-player">
									<!-- <span class="ticket-player-img h-object-fit">
										<img src="images/ava.png" alt="alt">
									</span> -->
									<a v-on:click="sortchangeforadmin('Жалоба на админа')" class="ticket-player-name">Жалоба на админа</a>
								</div>
								<div class="ticket-player">
									<!-- <span class="ticket-player-img h-object-fit">
										<img src="images/ava.png" alt="alt">
									</span> -->
									<a v-on:click="sortchangeforadmin('Другое')" class="ticket-player-name">Другое</a>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

		<div class="container" v-else>
			<div class="tickets__wrap border-box" style="margin-top: 50px">
				<div class="tickets__top">
					<div class="tickets__top-lt">
						<h1 class="h1 h1_27">Поддержка</h1>
						<a class="btn btn_yellow-bord btn_ticket" onclick="myPopupNewTicket()">Новый тикет</a>
					</div>
					<div class="tickets__top-rt" v-if="toshow">
						<div class="tickets__select player_select_pure">
							<select id="sortdropdown" v-on:change="sortchange()">
								<option value="created_at">Сначала новые</option>
								<option value="Другое">Другое</option>
								<option value="Читы">Читы</option>
								<option value="Баги">Баги</option>
								<option value="Финансы">Финансы</option>
								<option value="Жалоба на игрока">Жалоба на игрока</option>
								<option value="Жалоба на админа">Жалоба на админа</option>
							</select>
						</div>
					</div>
				</div>
				<div class="tickets__main-wrap">
					<div class="tickets__main">
            <div v-bind:class="[ticket.state == 3 || ticket.state == 4 ? 'tickets__main-item' : 'tickets__main-item tickets__main-item_active']" v-for="ticket in tickets" style="cursor: pointer">
            	<router-link :to="{ name: 'SupportShow', params: {id: ticket.id } }" tag="div"><div class="tickets__main-item-lt">
              	<div class="tickets__main-item-status">
                	<span class="ticket-status"></span>
              	</div>
              	<div class="tickets__main-item-descr" v-if="ticket.category == 'Жалоба на игрока' || ticket.category == 'Жалоба на админа'">
              		<span>Жалоба на </span>
                	<span class="ticket-player">
                  	<span class="ticket-player-img h-object-fit">
                  	<img :src="ticket.complaint.avatar" alt="">
                  	</span>
                  	<span class="ticket-player-name">{{ ticket.complaint.name }}</span>
                	</span>
              	</div>
              	<div class="tickets__main-item-descr" v-else>
                	<span>{{ ticket.title }}</span>
              	</div>
								<div class="tickets__main-item-num" v-if="ticket.newmessages !== 0">
									<span class="ticket-number">+{{ticket.newmessages}}</span>
								</div>
              	<div v-bind:class="[ticket.newmessages !== 0 ? 'tickets__main-item-msg tickets__main-item-msg_active' : 'tickets__main-item-msg']">
                	{{ ticket.description }}
              	</div>
            	</div></router-link>
            	<div class="tickets__main-item-rt">
              	<div class="tickets__main-item-players" v-if="ticket.participants !== null">
                	<span class="ticket-player-img h-object-fit" v-for="part in ticket.participants">
                  	<a v-if="part != null" :href="'user/' + part.user_id"><img :src="part.avatar"></a>
                	</span>
              	</div>
              	<div class="tickets__main-item-reason">{{ ticket.category }}</div>
            	</div>
            </div>
					</div>
				</div>
				<div class="tickets__breadcrumbs-wrap"  v-if="tickets.length !== 0">
					<ul class="h-reset-list tickets__breadcrumbs">
						<li v-bind:class="[page == pagenumber ? 'active' : '']" v-for="pagenumber in pages" v-on:click="changepage(pagenumber)">
							<a>{{ pagenumber }}</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

    <div id="popup" class="tickets-modals_wrap">
  	<div class="popup_fade" onclick="closeGame()"></div>
  	<div class="popup_content myPopupNewTicket trade_links myPopupCommonStyles animated05 fadeOutUp">
  		<a class="popup_close" onclick="closeGame()" v-on:click="close()"></a>
  		<div class="myPopupContentWrap">
  			<div class="myPopupTitle">
  				<h5>Новый тикет</h5>
  			</div>
  			<div class="myPopupContent">
  				<form action="" enctype="multipart/form-data">
  					<div class="tabs-wrap">
  						<div class="tab-menu js-tab">
  							<ul role="tablist" class="nav nav-tabs">
  								<li role="presentation" class="nav-tabs__li" v-on:click="change(1)"><a href="#tickets_tab-other" aria-controls="tickets_tab-other" role="tab" data-toggle="tab" class="active"><span>Другое</span></a></li>
  								<li role="presentation" class="nav-tabs__li" v-on:click="change(2)"><a href="#tickets_tab-cheat" aria-controls="tickets_tab-cheat" role="tab" data-toggle="tab"><span>Читы<span class="fw-400"></span></span></a></li>
									<li role="presentation" class="nav-tabs__li" v-on:click="change(3)"><a href="#tickets_tab-bags" aria-controls="tickets_tab-bags" role="tab" data-toggle="tab"><span>Баги</span></a></li>
  								<li role="presentation" class="nav-tabs__li" v-on:click="change(4)"><a href="#tickets_tab-finance" aria-controls="tickets_tab-finance" role="tab" data-toggle="tab"><span>Финансы<span class="fw-400"></span></span></a></li>
									<li role="presentation" class="nav-tabs__li" v-on:click="change(7)"><a href="#tickets_tab-shop" aria-controls="tickets_tab-shop" role="tab" data-toggle="tab"><span>Магазин<span class="fw-400"></span></span></a></li>
									<li role="presentation" class="nav-tabs__li" v-on:click="change(5)"><a href="#tickets_tab-gameComplains" aria-controls="tickets_tab-gameComplains" role="tab" data-toggle="tab"><span>Жалоба на игрока</span></a></li>
  								<li role="presentation" class="nav-tabs__li" v-on:click="change(6)"><a href="#tickets_tab-adminComplains" aria-controls="tickets_tab-adminComplains" role="tab" data-toggle="tab"><span>Жалоба на админа</span></a></li>
  							</ul>
  						</div>
  						<div class="tab-content-wrap">

  							<div class="tab-content">

  								<div id="tickets_tab-other" role="tabpanel" class="tab-items tab-pane fade active show">
  									<div class="tab-content__wrap">
  										<div class="tickets_modal-inner">
  											<div class="tickets_modal-field">
  												<label for="tickets_modalProblem">Суть проблемы</label>
  												<input type="text" name="problem1" id="tickets_modalProblem" placeholder="Проблема" autocomplete="off">
  											</div>
												<div class="tickets_modal-addUser" style="margin-bottom: 30px">
												<div class="tickets_modal-addUser-top">
													<span class="tickets_modal-addUser-top-ttl">Участники</span>
													<div class="tickets_modal-addUser-panel">
														<div class="streams_aside_table_icon" v-for="participant in participants"><img :src="participant.avatar" alt="littleIcon"/></div>
														<div class="tickets_modal-addUser-wrapper">
															<button type="button" class="tickets_modal-addUser-Btn">
																<span>Добавить</span>
															</button>
															<div class="tickets_modal-addUser-Dropdown animated">
																<span class="tickets_modal-addUser-ttl">Добавить участника</span>
																<div class="tickets_modal-field">
																	<input type="text" name="" id="searchusersforadmin" placeholder="Введите ник или ID" @input="searchusers" autocomplete="off">
																</div>
																<div class="tickets_modal-addUser-container scrollPro mCustomScrollbar _mCS_2">
																	<div class="tickets_modal-addUser-inner mCS-light mCSB_vertical mCSB_inside">
																		<a class="tickets_modal-addUser-participant" v-for="us in findusers" v-on:click="adduser(us.id)" v-if="user.id !== us.id">
																			<div class="tickets_modal-addUser-left">
																				<div class="streams_aside_table_icon"><img :src="us.avatar" alt="littleIcon"/></div>
																				<span class="tickets_modal-addUser-name">{{ us.name }}</span>
																			</div>
																			<div class="tickets_modal-addUser-right">
																				<span class="tickets_modal-addUser-id">ID {{ us.id }}</span>
																			</div>
																		</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
  											<div class="tickets_modal-field">
  												<textarea name="problemdesc1" id="newticketdesc" placeholder="Детальное описание проблемы"></textarea>
  											</div>
  										</div>
  									</div>
  								</div>
  								<div id="tickets_tab-cheat" role="tabpanel" class="tab-items tab-pane fade">
  									<div class="tab-content__wrap">
  										<div class="tickets_modal-inner">
  											<div class="tickets_modal-field">
  												<label for="tickets_modalProblemcheat">Суть проблемы</label>
  												<input type="text" name="problem2" id="tickets_modalProblemcheat" placeholder="Проблема" autocomplete="off">
  											</div>
												<div class="tickets_modal-addUser" style="margin-bottom: 30px">
												<div class="tickets_modal-addUser-top">
													<span class="tickets_modal-addUser-top-ttl">Участники</span>
													<div class="tickets_modal-addUser-panel">
														<div class="streams_aside_table_icon" v-for="participant in participants"><img :src="participant.avatar" alt="littleIcon"/></div>
														<div class="tickets_modal-addUser-wrapper">
															<button type="button" class="tickets_modal-addUser-Btn">
																<span>Добавить</span>
															</button>
															<div class="tickets_modal-addUser-Dropdown animated">
																<span class="tickets_modal-addUser-ttl">Добавить участника</span>
																<div class="tickets_modal-field">
																	<input type="text" name="" @input="searchusers" id="searchusers" placeholder="Введите ник или ID" autocomplete="off">
																</div>
																<div class="tickets_modal-addUser-container scrollPro mCustomScrollbar _mCS_2">
																	<div class="tickets_modal-addUser-inner mCS-light mCSB_vertical mCSB_inside">
																		<a class="tickets_modal-addUser-participant" v-for="us in findusers" v-on:click="adduser(us.id)" v-if="user.id !== us.id">
																			<div class="tickets_modal-addUser-left">
																				<div class="streams_aside_table_icon"><img :src="us.avatar" alt="littleIcon"/></div>
																				<span class="tickets_modal-addUser-name">{{ us.name }}</span>
																			</div>
																			<div class="tickets_modal-addUser-right">
																				<span class="tickets_modal-addUser-id">ID {{ us.id }}</span>
																			</div>
																		</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
  										</div>
  										<div class="tickets_modal-twoFields">
  											<div class="tickets_modal-field">
  												<label for="tickets_modalProblemcheatId">ID игры в которой была проблема (?)</label>
  												<input type="text" name="gamenumber" id="tickets_modalProblemcheatId" autocomplete="off">
  											</div>
  											<div class="tickets_modal-field">
  												<label for="tickets_modalParticipantcheatName">Какой игрок применял читы?</label>
  												<input type="text" name="cheatplayer" id="tickets_modalParticipantcheatName" autocomplete="off">
  											</div>
  										</div>
  										<div class="tickets_modal-momentWrap">
  											<span>Моменты, когда видно применение чита</span>
  											<div class="tickets_modal-momentInner">
  												<div class="tickets_modal-moment">
  													<div class="tickets_modal-field">
  														<input type="number" name="time" value="" pattern="[0-9]" max="60" @input="check">
															 &nbsp:&nbsp
															<input type="number" name="time" value="" pattern="[0-9]" max="60" @input="check">
  													</div>
  													<div class="tickets_modal-field">
  														<input type="text" name="timecomment" id="timecomment1" placeholder="Описание проблемы" autocomplete="off">
  													</div>
  												</div>
  												<div class="tickets_modal-moment">
														<div class="tickets_modal-field">
  														<input type="number" name="time" value="" pattern="[0-9]" max="60" @input="check">
															 &nbsp:&nbsp
															<input type="number" name="time" value="" pattern="[0-9]" max="60" @input="check">
  													</div>
  													<div class="tickets_modal-field">
  														<input type="text" name="timecomment" id="timecomment2" placeholder="Описание проблемы" autocomplete="off">
  													</div>
  												</div>
  												<div class="tickets_modal-moment">
														<div class="tickets_modal-field">
  														<input type="number" name="time" value="" pattern="[0-9]" max="60" @input="check">
															 &nbsp:&nbsp
															<input type="number" name="time" value="" pattern="[0-9]" max="60" @input="check">
  													</div>
  													<div class="tickets_modal-field">
  														<input type="text" name="timecomment" id="timecomment3" placeholder="Описание проблемы" autocomplete="off">
  													</div>
  												</div>
  											</div>
  										</div>
  									</div>
  								</div>
  								<div id="tickets_tab-bags" role="tabpanel" class="tab-items tab-pane fade">
  									<div class="tab-content__wrap">
  										<div class="tickets_modal-inner">
  											<div class="tickets_modal-field">
  												<label for="tickets_modalProblembag">Суть проблемы</label>
  												<input type="text" name="problem3" id="tickets_modalProblembag" placeholder="Проблема" autocomplete="off">
  											</div>
												<div class="tickets_modal-addUser" style="margin-bottom: 30px">
												<div class="tickets_modal-addUser-top">
													<span class="tickets_modal-addUser-top-ttl">Участники</span>
													<div class="tickets_modal-addUser-panel">
														<div class="streams_aside_table_icon" v-for="participant in participants"><img :src="participant.avatar" alt="littleIcon"/></div>
														<div class="tickets_modal-addUser-wrapper">
															<button type="button" class="tickets_modal-addUser-Btn">
																<span>Добавить</span>
															</button>
															<div class="tickets_modal-addUser-Dropdown animated">
																<span class="tickets_modal-addUser-ttl">Добавить участника</span>
																<div class="tickets_modal-field">
																	<input type="text" name="" @input="searchusers" id="searchusers" placeholder="Введите ник или ID" autocomplete="off">
																</div>
																<div class="tickets_modal-addUser-container scrollPro mCustomScrollbar _mCS_2">
																	<div class="tickets_modal-addUser-inner mCS-light mCSB_vertical mCSB_inside">
																		<a class="tickets_modal-addUser-participant" v-for="us in findusers" v-on:click="adduser(us.id)" v-if="user.id !== us.id">
																			<div class="tickets_modal-addUser-left">
																				<div class="streams_aside_table_icon"><img :src="us.avatar" alt="littleIcon"/></div>
																				<span class="tickets_modal-addUser-name">{{ us.name }}</span>
																			</div>
																			<div class="tickets_modal-addUser-right">
																				<span class="tickets_modal-addUser-id">ID {{ us.id }}</span>
																			</div>
																		</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
  											<div class="tickets_modal-field">
  												<textarea name="problemdesc3" id="newticketdesc" placeholder="Детальное описание проблемы" autocomplete="off"></textarea>
  											</div>
  										</div>
  									</div>
  								</div>
									<div id="tickets_tab-shop" role="tabpanel" class="tab-items tab-pane fade">
  									<div class="tab-content__wrap">
  										<div class="tickets_modal-inner">
  											<div class="tickets_modal-field">
  												<label for="tickets_modalProblembag">Суть проблемы</label>
  												<input type="text" name="problem7" id="tickets_modalProblembag" placeholder="Проблема" autocomplete="off">
  											</div>
												<div class="tickets_modal-addUser" style="margin-bottom: 30px">
												<div class="tickets_modal-addUser-top">
													<span class="tickets_modal-addUser-top-ttl">Участники</span>
													<div class="tickets_modal-addUser-panel">
														<div class="streams_aside_table_icon" v-for="participant in participants"><img :src="participant.avatar" alt="littleIcon"/></div>
														<div class="tickets_modal-addUser-wrapper">
															<button type="button" class="tickets_modal-addUser-Btn">
																<span>Добавить</span>
															</button>
															<div class="tickets_modal-addUser-Dropdown animated">
																<span class="tickets_modal-addUser-ttl">Добавить участника</span>
																<div class="tickets_modal-field">
																	<input type="text" name="" @input="searchusers" id="searchusers" placeholder="Введите ник или ID" autocomplete="off">
																</div>
																<div class="tickets_modal-addUser-container scrollPro mCustomScrollbar _mCS_2">
																	<div class="tickets_modal-addUser-inner mCS-light mCSB_vertical mCSB_inside">
																		<a class="tickets_modal-addUser-participant" v-for="us in findusers" v-on:click="adduser(us.id)" v-if="user.id !== us.id">
																			<div class="tickets_modal-addUser-left">
																				<div class="streams_aside_table_icon"><img :src="us.avatar" alt="littleIcon"/></div>
																				<span class="tickets_modal-addUser-name">{{ us.name }}</span>
																			</div>
																			<div class="tickets_modal-addUser-right">
																				<span class="tickets_modal-addUser-id">ID {{ us.id }}</span>
																			</div>
																		</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
  											<div class="tickets_modal-field">
  												<textarea name="problemdesc7" id="newticketdesc" placeholder="Детальное описание проблемы" autocomplete="off"></textarea>
  											</div>
  										</div>
  									</div>
  								</div>
  								<div id="tickets_tab-finance" role="tabpanel" class="tab-items tab-pane fade">
  									<div class="tab-content__wrap">
  										<div class="tickets_modal-inner">
  											<div class="tickets_modal-field">
  												<label for="tickets_modalProblemfinance">Суть проблемы</label>
  												<input type="text" name="problem4" id="tickets_modalProblemfinance" placeholder="Проблема" autocomplete="off">
  											</div>
												<div class="tickets_modal-addUser" style="margin-bottom: 30px">
												<div class="tickets_modal-addUser-top">
													<span class="tickets_modal-addUser-top-ttl">Участники</span>
													<div class="tickets_modal-addUser-panel">
														<div class="streams_aside_table_icon" v-for="participant in participants"><img :src="participant.avatar" alt="littleIcon"/></div>
														<div class="tickets_modal-addUser-wrapper">
															<button type="button" class="tickets_modal-addUser-Btn">
																<span>Добавить</span>
															</button>
															<div class="tickets_modal-addUser-Dropdown animated">
																<span class="tickets_modal-addUser-ttl">Добавить участника</span>
																<div class="tickets_modal-field">
																	<input type="text" name="" id="searchusers" placeholder="Введите ник или ID" autocomplete="off">
																</div>
																<div class="tickets_modal-addUser-container scrollPro mCustomScrollbar _mCS_2">
																	<div class="tickets_modal-addUser-inner mCS-light mCSB_vertical mCSB_inside">
																		<a class="tickets_modal-addUser-participant" v-for="us in findusers" v-on:click="adduser(us.id)" v-if="user.id !== us.id">
																			<div class="tickets_modal-addUser-left">
																				<div class="streams_aside_table_icon"><img :src="us.avatar" alt="littleIcon"/></div>
																				<span class="tickets_modal-addUser-name">{{ us.name }}</span>
																			</div>
																			<div class="tickets_modal-addUser-right">
																				<span class="tickets_modal-addUser-id">ID {{ us.id }}</span>
																			</div>
																		</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
  											<div class="tickets_modal-field">
  												<textarea name="problemdesc4" id="newticketdesc" placeholder="Детальное описание проблемы"></textarea>
  											</div>
  										</div>
  									</div>
  								</div>
  								<div id="tickets_tab-gameComplains" role="tabpanel" class="tab-items tab-pane fade">
  									<div class="tab-content__wrap">
  										<div class="tickets_modal-inner">
  											<div class="tickets_modal-field">
  												<label for="tickets_modalProblemUser">Суть проблемы</label>
  												<input type="text" name="problem5" id="tickets_modalProblemUser" placeholder="Проблема" autocomplete="off">
  											</div>
												<div class="tickets_modal-addUser" style="margin-bottom: 30px">
												<div class="tickets_modal-addUser-top">
													<span class="tickets_modal-addUser-top-ttl">Участники</span>
													<div class="tickets_modal-addUser-panel">
														<div class="streams_aside_table_icon" v-for="participant in participants"><img :src="participant.avatar" alt="littleIcon"/></div>
														<div class="tickets_modal-addUser-wrapper">
															<button type="button" class="tickets_modal-addUser-Btn">
																<span>Добавить</span>
															</button>
															<div class="tickets_modal-addUser-Dropdown animated">
																<span class="tickets_modal-addUser-ttl">Добавить участника</span>
																<div class="tickets_modal-field">
																	<input type="text" name="" @input="searchusers" id="searchusers" placeholder="Введите ник или ID" autocomplete="off">
																</div>
																<div class="tickets_modal-addUser-container scrollPro mCustomScrollbar _mCS_2">
																	<div class="tickets_modal-addUser-inner mCS-light mCSB_vertical mCSB_inside">
																		<a class="tickets_modal-addUser-participant" v-for="us in findusers" v-on:click="adduser(us.id)" v-if="user.id !== us.id">
																			<div class="tickets_modal-addUser-left">
																				<div class="streams_aside_table_icon"><img :src="us.avatar" alt="littleIcon"/></div>
																				<span class="tickets_modal-addUser-name">{{ us.name }}</span>
																			</div>
																			<div class="tickets_modal-addUser-right">
																				<span class="tickets_modal-addUser-id">ID {{ us.id }}</span>
																			</div>
																		</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
  											<div class="tickets_modal-field">
  												<label for="tickets_modalUserComplain">На кого жалоба (ID админа)</label>
  												<input type="text" name="complaint5" id="tickets_modalUserComplain" autocomplete="off">
  											</div>
  											<div class="tickets_modal-field">
  												<textarea name="problemdesc5" id="newticketdesc" placeholder="Детальное описание проблемы"></textarea>
  											</div>
  										</div>
  									</div>
  								</div>
  								<div id="tickets_tab-adminComplains" role="tabpanel" class="tab-items tab-pane fade">
  									<div class="tab-content__wrap">
  										<div class="tickets_modal-inner">
  											<div class="tickets_modal-field">
  												<label for="tickets_modalProblemAdmin">Суть проблемы</label>
  												<input type="text" name="problem6" id="tickets_modalProblemAdmin" placeholder="Проблема" autocomplete="off">
  											</div>
												<div class="tickets_modal-addUser" style="margin-bottom: 30px">
												<div class="tickets_modal-addUser-top">
													<span class="tickets_modal-addUser-top-ttl">Участники</span>
													<div class="tickets_modal-addUser-panel">
														<div class="streams_aside_table_icon" v-for="participant in participants"><img :src="participant.avatar" alt="littleIcon"/></div>
														<div class="tickets_modal-addUser-wrapper">
															<button type="button" class="tickets_modal-addUser-Btn">
																<span>Добавить</span>
															</button>
															<div class="tickets_modal-addUser-Dropdown animated">
																<span class="tickets_modal-addUser-ttl">Добавить участника</span>
																<div class="tickets_modal-field">
																	<input type="text" name="" @input="searchusers" id="searchusers" placeholder="Введите ник или ID" autocomplete="off">
																</div>
																<div class="tickets_modal-addUser-container scrollPro mCustomScrollbar _mCS_2">
																	<div class="tickets_modal-addUser-inner mCS-light mCSB_vertical mCSB_inside">
																		<a class="tickets_modal-addUser-participant" v-for="us in findusers" v-on:click="adduser(us.id)" v-if="user.id !== us.id">
																			<div class="tickets_modal-addUser-left">
																				<div class="streams_aside_table_icon"><img :src="us.avatar" alt="littleIcon"/></div>
																				<span class="tickets_modal-addUser-name">{{ us.name }}</span>
																			</div>
																			<div class="tickets_modal-addUser-right">
																				<span class="tickets_modal-addUser-id">ID {{ us.id }}</span>
																			</div>
																		</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
  											<div class="tickets_modal-field">
  												<label for="tickets_modalAdminComplain">На кого жалоба (ID админа)</label>
  												<input type="text" name="complaint6" id="tickets_modalAdminComplain" @input="searchusers" autocomplete="off">
  											</div>
  											<div class="tickets_modal-field">
  												<textarea name="problemdesc6" id="newticketdesc" placeholder="Детальное описание проблемы"></textarea>
  											</div>
  										</div>
  									</div>
  								</div>
  							</div>
  						</div>
  					</div>
  					<div class="myPopupNewTicket_footer">
  						<button type="button" class="popup_button buttonFor_myPopupNewTicket-close fix_fillColorBtn" v-on:click="create()" onclick="closeGame()">
  							<span>Создать тикет</span>
  						</button>
							<span v-if="filecount > 0">Прикреплено файлов: {{ filecount }}</span>
							<span v-if="filecount > 0" v-on:click="deletefiles()" style="cursor: pointer;">×</span>
  						<div class="file-upload">
  							<label>
  								<input type="file" name="file" id="file" ref="file" @change="adding" multiple accept="image/*,image/jpeg">
  								<span>Приложить файл</span>
  							</label>
  						</div>
  					</div>
  				</form>
  			</div>
  		</div>
  	</div>
  </div>
</div>
</template>

<script>
export default {
  props: ['tickets', 'show', 'showform', 'sort', 'create', 'change', 'sortchange', 'adding', 'filecount', 'deletefiles', 'sortvalue', 'participants', 'searchusers', 'findusers', 'adduser', 'close', 'user', 'sortchangeforadmin', 'searchrequest', 'searchtickets', 'page', 'toshow', 'pages', 'changepage'],
  components: {
  },
  methods: {
		checkTicket: function(ticket_id) {
			if (this.toshow.findIndex(x => x.id === ticket_id) == -1) {
				return false;
			} else {
				return true;
			}
		},
		check: function(e) {
			if (e.target.value >= 0 || e.target.value <= 60) {
					e.target.value = e.target.value.substring(0, 2);
			}
		},
  }
}
</script>

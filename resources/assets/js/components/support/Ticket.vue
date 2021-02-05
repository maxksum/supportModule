<template>
<div id="general">

	<!-- КОД ПИСАТИ ТУТ -->

	<div class="container" v-if="user.role == 'administrator'">
		<div class="tickets__wrap border-box" style="margin-top: 50px">
			<div class="admin-tickets">
				<div class="admin-tickets__lt">
					<div class="tickets__info">
						<div class="tickets__info-lt">
							<router-link :to="{ name: 'Support' }"><a v-on:click="show()">< Все тикеты</a></router-link>
							<div class="tickets__info-id">ID {{ ticket.id }}</div>
							<div class="tickets__info-status" v-if="ticket.state == 1 || ticket.state == 2" style="color: green;">Открытый</div>
							<div class="tickets__info-status" v-if="ticket.state == 3 || ticket.state == 4" style="color: red;">Закрыт</div>
							<div class="tickets__info-category">{{ ticket.category }}</div>
						</div>
						<div class="tickets__info-rt">
							<div class="tickets__info-date"><span>{{ dateformat(ticket.created_at) }} </span></div>
						</div>
					</div>
					<h1 class="h1 h1_27" v-if="ticket.category == 'Жалоба на игрока' || ticket.category == 'Жалоба на админа'">
					<span>Жалоба на </span>
						<span class="ticket-player">
							<span class="ticket-player-img h-object-fit">
								<img :src="ticket.complaint.avatar" alt="">
							</span>
							<span class="ticket-player-name">{{ ticket.complaint.name }}</span>
						</span>
					</h1>
					<h1 class="h1 h1_27" v-else>{{ ticket.title }}</h1>
					<div class="tickets__one-wrap">
						<div class="tickets__one">
							<div class="tickets__one-items">
								<div class="tickets__one-item" v-bind:class="[user.id == message.author_id ? 'tickets__one-item' : 'tickets__one-item tickets__one-item_new']" v-for="message in ticket.messages">
									<div class="tickets__one-item-top">
										<div class="tickets__one-item-top-user">
											<span class="ticket-player">
												<span class="ticket-player-img h-object-fit">
													<img :src="message.author.avatar" alt="">
												</span>
												<span class="ticket-player-name">{{ message.author.name}}</span>
											</span>
										</div>
										<div class="tickets__info-date"><span>{{ dateformat(message.created_at) }} ({{ message.forhumans }})</span></div>
									</div>
									<div class="tickets__one-item-main">
										<p>{{ message.text }}</p>
										<p v-if="ticket.moments !== null" v-for="moment in ticket.moments"> {{ moment.moment }} - {{ moment.comment }} </p>
										<p v-for="image in message.images"><img :src="'/tickets_images/' + image.url"></p>
									</div>
								</div>
							</div>
						</div>
						<form class="tickets__one-msg" v-if="ticket.state != '3' && ticket.state != '4'">
							<div class="tickets__one-msg-input-wrap" style="cursor: pointer">
								<div class="ticket-player-add file-upload-plus">
										<label>
											<input type="file" name='file' id="fileformessageadmin">
											<span></span>
										</label>
									</div>
								<button type="button" class="tickets__one-msg-input-sbm" v-on:click="addMessage(ticket.id)"></button>
								<input type="text" class="tickets__one-msg-input" id="messageforadmin" @keyup.enter="addMessage(ticket.id)" onkeydown="if(event.keyCode==13){return false;}" placeholder="Ваш ответ" autocomplete="off">
							</div>
						</form>
					</div>
				</div>
				<div class="admin-tickets__rt">
					<div class="admin-tickets__rt-wrap">
						<div class="admin-tickets__rt-top">
							<a onClick="" class="admin-tickets__rt-title active">Операции</a>
							<a onClick="" class="admin-tickets__rt-title">История</a>
							<a onClick="" class="admin-tickets__rt-title">Обсуждение</a>
						</div>
						<div id="admin-tickets__rt-operations" class="admin-tickets__rt-block admin-tickets__rt-block-operation admin-tickets__rt-tab-item active">
							<div class="ticket-player">
								<span class="ticket-player-img h-object-fit">
									<img class="operation-img" src="/images/minigames-coin/lock-2.svg" alt="alt">
									<img class="operation-img-white" src="/images/minigames-coin/lock.svg" alt="alt">
								</span>
								<a onclick="myPopupCloseTicket()" class="ticket-player-name">Закрыть тикет</a>
							</div>
							<!--<div class="ticket-player">
								<span class="ticket-player-img h-object-fit">
									<img class="operation-img" src="images/minigames-coin/arrow-replace-2.svg" alt="alt">
									<img class="operation-img-white" src="images/minigames-coin/arrow-replace.svg" alt="alt">
								</span>
								<a href="#" class="ticket-player-name">Сменить категорию</a>
							</div>
							<div class="ticket-player">
								<span class="ticket-player-img h-object-fit">
									<img class="operation-img" src="images/minigames-coin/user-refresh-2.svg" alt="alt">
									<img class="operation-img-white" src="images/minigames-coin/user-refresh.svg" alt="alt">
								</span>
								<a href="#" class="ticket-player-name">Сменить ответственного</a>
							</div>-->
							<div class="ticket-player">
								<!--<span class="ticket-player-img h-object-fit">-->
									<!--<img class="operation-img" src="images/minigames-coin/plus-button-2.svg" alt="alt">-->
									<!--<img class="operation-img-white" src="images/minigames-coin/plus-button.svg" alt="alt">-->
								<!--</span>-->
								<div class="tickets_modal-addUser">
									<div class="tickets_modal-addUser-top">
										<div class="tickets_modal-addUser-panel">
											<div class="streams_aside_table_icon" v-for="participant in ticket.participants" v-if="participant != null"><a v-if="participant != null" :href="'/user/' + participant.id"><img :src="participant.avatar_medium" alt="littleIcon"/></a></div>
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
															<a class="tickets_modal-addUser-participant" v-for="user in findusers" v-on:click="adduser(user.id)">
																<div class="tickets_modal-addUser-left">
																	<div class="streams_aside_table_icon"><img :src="user.avatar" alt="littleIcon"/></div>
																	<span class="tickets_modal-addUser-name">{{ user.name }}</span>
																</div>
																<div class="tickets_modal-addUser-right">
																	<span class="tickets_modal-addUser-id">ID {{ user.id }}</span>
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
							<div class="admin-tickets__rt-cheats" v-if="ticket.category == 'Читы'">
								<div class="admin-tickets__rt-cheats-top">
									Был ли чит хотя бы на одном из моментов?
								</div>
								<div class="admin-tickets__rt-cheats-rating">
									<div class="admin-tickets__rt-cheats-rating-item" v-bind:style="{ height: parseInt(ticket.yesvotes / (ticket.yesvotes + ticket.novotes) * 100) + '%' }">
										<div class="admin-tickets__rt-cheats-rating-item-val" v-if="!isNaN(parseInt(ticket.yesvotes / (ticket.yesvotes + ticket.novotes) * 100))">{{ parseFloat((ticket.yesvotes / (ticket.yesvotes + ticket.novotes) * 100).toFixed(1)) }}%</div>
										<div class="admin-tickets__rt-cheats-rating-item-val" v-else>0%</div>
										<div class="admin-tickets__rt-cheats-rating-item-col"></div>
									</div>
									<div class="admin-tickets__rt-cheats-rating-item" v-bind:style="{ height: parseInt(ticket.novotes / (ticket.yesvotes + ticket.novotes) * 100) + '%' }">
										<div class="admin-tickets__rt-cheats-rating-item-val" v-if="!isNaN(parseInt(ticket.novotes / (ticket.yesvotes + ticket.novotes) * 100))">{{ parseFloat((ticket.novotes / (ticket.yesvotes + ticket.novotes) * 100).toFixed(1)) }}%</div>
										<div class="admin-tickets__rt-cheats-rating-item-val" v-else>0%</div>
										<div class="admin-tickets__rt-cheats-rating-item-col"></div>
									</div>
								</div>
								<div class="admin-tickets__rt-cheats-voting scrollPro mCustomScrollbar _mCS_2">
									<form class="admin-tickets__rt-cheats-voting-inner mCustomScrollBox mCS-light mCSB_vertical mCSB_inside">
										<div class="admin-tickets__rt-cheats-voting-col">
											<div class="form-group-voting">
												<label class="radio-label">
													<input type="radio" name="type_of_command" value="Yes" v-on:change="voteforcheats(1, ticket.id)" class="hidden-input" v-if="ticket.voted == 0"/>
													<input type="radio" name="type_of_command" value="Yes" v-on:change="voteforcheats(1, ticket.id)" class="hidden-input" checked disabled v-else-if="ticket.voted == 2"/>
													<input type="radio" name="type_of_command" value="Yes" v-on:change="voteforcheats(1, ticket.id)" class="hidden-input" disabled v-else/>
													<span class="check-icon"></span><span class="check-value">Да, скорее всего</span>
												</label>
											</div>
											<div class="streams_aside_table_itemLeft" v-if="vote != null && vote.vote" v-for="vote in ticket.votes">
												<div class="streams_aside_table_icon">
													<a v-if="vote != null" :href="'/user/' + vote.user.id"><img :src="vote.user.avatar_medium" alt="littleIcon"/></a>
												</div>
												<a v-if="vote != null" :href="'/user/' + vote.user.id"><span>{{ vote.user.name }}</span></a>
											</div>

										</div>
										<div class="admin-tickets__rt-cheats-voting-col">
											<div class="form-group-voting">
												<label class="radio-label">
													<input type="radio" name="type_of_command" value="No" v-on:change="voteforcheats(0, ticket.id)" class="hidden-input" v-if="ticket.voted == 0"/>
													<input type="radio" name="type_of_command" value="No" v-on:change="voteforcheats(0, ticket.id)" class="hidden-input" checked disabled v-else-if="ticket.voted == 1"/>
													<input type="radio" name="type_of_command" value="No" v-on:change="voteforcheats(0, ticket.id)" class="hidden-input" disabled v-else/>
													<span class="check-icon"></span><span class="check-value">Нет, не вижу</span>
												</label>
											</div>
											<div class="streams_aside_table_itemLeft" v-if="vote != null && vote.vote !== 1" v-for="vote in ticket.votes">
												<div class="streams_aside_table_icon">
													<a v-if="vote != null" :href="'/user/' + vote.user.id"><img :src="vote.user.avatar_medium" alt="littleIcon"/></a>
												</div>
												<a v-if="vote != null" :href="'/user/' + vote.user.id"><span>{{ vote.user.name }}</span></a>
											</div>


										</div>
									</form>
								</div>
							</div>
						</div>
						<div id="admin-tickets__rt-history" class="admin-tickets__rt-block admin-tickets__rt-tab-item">
							<div class="admin-tickets__rt-history-scroll scrollPro" style="overflow: hidden;">

								<!--<div class="admin-tickets__rt-history-select">
									<div class="player_ttl_select player_select_pure">
										<select>
											<option>Фильтр по админу</option>
											<option>Фильтр по админу</option>
											<option>Фильтр по админу</option>
											<option>Фильтр по админу</option>
											<option>Фильтр по админу</option>
											<option>Фильтр по админу</option>
										</select>
									</div>
									<div class="player_ttl_select player_select_pure">
										<select>
											<option>Фильтр по времени</option>
											<option>Фильтр по времени</option>
											<option>Фильтр по времени</option>
											<option>Фильтр по времени</option>
											<option>Фильтр по времени</option>
											<option>Фильтр по времени</option>
										</select>
									</div>
								</div>-->
								<vue-scrollbar classes="logs-scrollbar" ref="logscroll">
								<div class="admin-tickets__rt-block-history" v-if="ticket.logs !== null" v-for="log in ticket.logs">
									<div class="admin-tickets__rt-block-history-time">
										{{ dateformat(log.created_at) }}
									</div>
									<div class="ticket-player">
										<span class="ticket-player-img h-object-fit">
											<a :href="'/user/' + log.userinfo.id"><img :src="log.userinfo.avatar_medium" alt="alt"></a>
										</span>
										<span class="ticket-player-name">{{ log.comment }}</span>
									</div>
								</div>
							</vue-scrollbar>
							</div>
						</div>
						<div class="admin-tickets__rt-block admin-tickets__rt-tab-item">
							<div class="admin-tickets__rt-history-scroll admin-tickets__rt-discussion-scroll scrollPro" style="overflow: hidden;">
								<vue-scrollbar classes="adminmessages-scrollbar" ref="adminmessagesscroll">
								<div class="admin-tickets__rt-block-history" v-if="ticket.adminmessages !== null" v-for="message in ticket.adminmessages">
									<div class="admin-tickets__rt-block-history-time">
										{{ dateformat(message.created_at) }}
									</div>
									<div class="ticket-player">
										<span class="ticket-player-img h-object-fit">
											<a :href="'/user/' + message.user.id"><img :src="message.user.avatar_medium" alt="alt"></a>
										</span>
										<span class="ticket-player-name">{{ message.text }}</span>
									</div>
								</div>
							</vue-scrollbar>
							</div>
							<form class="tickets__one-msg">
								<div class="tickets__one-msg-input-wrap tickets__one-msg-input-wrap_mod">
									<button type="button" class="tickets__one-msg-input-sbm" v-on:click="addadminmessage(ticket.id)"></button>
									<input type="text" class="tickets__one-msg-input" id="adminmessage" @keyup.enter="addadminmessage(ticket.id)" onkeydown="if(event.keyCode==13){return false;}" placeholder="">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

		<div class="container" v-else>
			<div class="tickets__wrap border-box" style="margin-top: 50px">
				<div class="tickets__info">
					<div class="tickets__info-lt">
						<router-link :to="{ name: 'Support' }"><a>< Все тикеты</a></router-link>
						<div class="tickets__info-id">ID {{ ticket.id }}</div>
						<div class="tickets__info-status" v-if="ticket.state == 1 || ticket.state == 2" style="color: green;">Открытый</div>
            <div class="tickets__info-status" v-if="ticket.state == 3 || ticket.state == 4" style="color: red;">Закрыт</div>
						<div class="tickets__info-category">{{ ticket.category }}</div>
						<div class="tickets_modal-addUser-top">
							<span class="tickets_modal-addUser-top-ttl">Участники</span>
							<div class="tickets_modal-addUser-panel">
								<div class="streams_aside_table_icon" v-for="participant in ticket.participants" v-if="participant != null"><a v-if="participant != null" :href="'/user/' + participant.id"><img :src="participant.avatar_medium" alt="littleIcon"/></a></div>
								<div class="tickets_modal-addUser-wrapper" v-if="ticket.state == 1 || ticket.state == 2">
									<button type="button" class="tickets_modal-addUser-Btn">
										<span>Добавить</span>
									</button>
									<div class="tickets_modal-addUser-Dropdown animated">
										<span class="tickets_modal-addUser-ttl">Добавить участника</span>
										<div class="tickets_modal-field">
											<input type="text" name="" id="searchusers" placeholder="Введите ник или ID" @input="searchusers" autocomplete="off">
										</div>
										<div class="tickets_modal-addUser-container scrollPro mCustomScrollbar _mCS_2">
											<div class="tickets_modal-addUser-inner mCS-light mCSB_vertical mCSB_inside">
												<a class="tickets_modal-addUser-participant" v-for="user in findusers" v-on:click="adduser(user.id)">
													<div class="tickets_modal-addUser-left">
														<div class="streams_aside_table_icon"><img :src="user.avatar" alt="littleIcon"/></div>
														<span class="tickets_modal-addUser-name">{{ user.name }}</span>
													</div>
													<div class="tickets_modal-addUser-right">
														<span class="tickets_modal-addUser-id">ID {{ user.id }}</span>
													</div>
												</a>
											</div>
										</div>
									</div>
									</div>
								</div>
								</div>

					</div>
					<div class="tickets__info-rt">
						<div class="tickets__info-date"><span>{{ dateformat(ticket.created_at) }} </span></div>
					</div>

				</div>
        <h1 class="h1 h1_27" v-if="ticket.category == 'Жалоба на игрока' || ticket.category == 'Жалоба на админа'">
        <span>Жалоба на </span>
          <span class="ticket-player">
            <span class="ticket-player-img h-object-fit">
              <img :src="ticket.complaint.avatar" alt="">
            </span>
            <span class="ticket-player-name">{{ ticket.complaint.name }}</span>
          </span>
        </h1>
				<h1 class="h1 h1_27" v-else>{{ ticket.title }}</h1>
				<div class="tickets__one-wrap">
					<div class="tickets__one">
						<div class="tickets__one-items">
							<div class="tickets__one-item" v-bind:class="[user.id == message.author_id ? 'tickets__one-item' : 'tickets__one-item tickets__one-item_new']" v-for="message in ticket.messages">
								<div class="tickets__one-item-top">
									<div class="tickets__one-item-top-user">
										<span class="ticket-player">
											<span class="ticket-player-img h-object-fit">
												<img :src="message.author.avatar" alt="" v-if="message.author.role !== 'administrator'">
												<img src="" alt="" v-else>
											</span>
											<span class="ticket-player-name" v-if="message.author.role !== 'administrator'">{{ message.author.name}}</span>
											<span class="ticket-player-name" v-else	>Administrator</span>
										</span>
									</div>
									<div class="tickets__info-date"><span>{{ dateformat(message.created_at) }} ({{ message.forhumans }})</span></div>
								</div>
								<div class="tickets__one-item-main">
									<p>{{ message.text }}</p>
                  <p v-if="ticket.moments !== null" v-for="moment in ticket.moments"> {{ moment.moment }} - {{ moment.comment }} </p>
                  <p v-for="image in message.images"><img :src="'/tickets_images/' + image.url"></p>
								</div>
							</div>
						</div>
						<div class="tickets__one-link" v-if="ticket.state != '3' && ticket.state != '4' && ticket.user_id == user.id">
							<a class="btn btn_yellow-bord btn_ticket" onclick="myPopupCloseTicket()">Закрыть тикет</a>
							<label>
							</label>
						</div>
					</div>
					<form class="tickets__one-msg" v-if="ticket.state != '3' && ticket.state != '4'">
						<div class="tickets__one-msg-input-wrap">
									<div class="ticket-player-add file-upload-plus">
											<label>
												<input type="file" name='file' id="fileformessage" @change="adding">
												<span></span>
											</label>
										</div>
							<button type="button" class="tickets__one-msg-input-sbm" v-on:click="addMessage"></button>
							<input type="text" class="tickets__one-msg-input" id="message" @keyup.enter="addMessage" onkeydown="if(event.keyCode==13){return false;}" placeholder="Ваш ответ" autocomplete="off">
						</div>
					</form>
				</div>
			</div>
		</div>



<div id="popup" class="tickets-modals_wrap">
<div class="popup_content myPopupCloseTicketRating trade_links myPopupCommonStyles animated05 fadeOutUp">
		<a class="popup_close" onclick="closeGame()"></a>
		<div class="myPopupContentWrap">
			<div class="myPopupTitle">
				<h5>Закрыть тикет</h5>
			</div>
			<div class="myPopupContent">
				<form action="">
					<div class="myPopupCloseTicketSelect_mark">
						<span>Оценка качества ответа от администрации</span>
						<div data-rating="0" id="speed" class="myPopupCloseTicketSelect_rateWrap myStarsRating js-rating"></div>
					</div>
					<div class="myPopupCloseTicketSelect_mark">
						<span>Оценка скорости ответа от администрации</span>
						<div data-rating="0" id="quality" class="myPopupCloseTicketSelect_rateWrap myStarsRating js-rating"></div>
					</div>
					<div class="myPopupCloseTicketSelect_textarea">
						<textarea name="problem" id="problemclose"></textarea>
					</div>
					<div class="myPopupBtnWrap fix_single_btn">
						<button type="button" class="popup_button buttonFor_myPopupCloseTicketSelect-close fix_fillColorBtn" onclick="closeGame()" v-on:click="closeticket(ticket.id)">
							<span>Закрыть</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--<div class="popup_content myPopupCloseTicketSelect trade_links myPopupCommonStyles animated05 fadeOutUp">
		<a class="popup_close" onclick="closeGame()"></a>
		<div class="myPopupContentWrap">
			<div class="myPopupTitle">
				<h5>Закрыть тикет</h5>
			</div>
			<div class="myPopupContent">
				<form action="">
					<div class="myPopupCloseTicketSelect_mark">
						<span>Ваша оценка саппорта</span>
						<div data-rating="0" class="myPopupCloseTicketSelect_rateWrap myStarsRating js-rating"></div>
					</div>
				</form>
			</div>
		</div>
	</div>-->
	<div class="popup_content myPopupCloseTicket trade_links myPopupCommonStyles animated05 fadeOutUp">
		<a class="popup_close" onclick="closeGame()"></a>
		<div class="myPopupContentWrap">
			<div class="myPopupTitle">
				<h5>Закрыть тикет</h5>
			</div>
			<div class="myPopupContent">
				<div class="myPopupContent__info">
					<p>
						Ваша проблема решена?
					</p>
				</div>
				<div class="myPopupBtnWrap">
  					<button type="button" class="popup_button buttonFor_myPopupCloseTicket-close fix_fillColorBtn" onclick="closeGameFormRating()" v-on:click="closestate(4)">
  						<span>Да</span>
					</button>
					<button type="button" class="popup_button buttonFor_myPopupCloseTicket-close fix_fillColorBtn" onclick="closeGameFormRating()" v-on:click="closestate(3)">
						<span>Нет</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
</div><!--====end general====-->
</template>

<script>
export default {
  props: ['ticket', 'show', 'addMessage', 'showform', 'closeticket', 'user', 'findusers', 'searchusers', 'dateformat', 'addadminmessage', 'voteforcheats', 'adding', 'adduser', 'closestate'],
	components: {

  },
	mounted() {
	  this.createStars();
	},
  methods: {
		createStars: function() {
	    (function(){
	      var rating_items = $('.js-rating');
	      rating_items.each(function (index) {
	          var th = $(this);
	          if (th.hasClass('rating_static')) {
	              th.starRating({
	                  totalStars: 5,
	                  useFullStars: true,
	                  emptyColor: '#ffffff',
	                  hoverColor: '#f9cf28',
	                  activeColor: '#f9cf28',
	                  ratedColor: '#f9cf28',
	                  starShape: 'custom',
	                  strokeWidth: 0,
	                  useGradient: false,
	                  readOnly: true
	              });
	          } else {
	              th.starRating({
	                  totalStars: 5,
	                  useFullStars: true,
	                  emptyColor: '#ffffff',
	                  hoverColor: '#f9cf28',
	                  activeColor: '#f9cf28',
	                  ratedColor: '#f9cf28',
	                  starShape: 'custom',
	                  strokeWidth: 0,
	                  useGradient: false,
	                  disableAfterRate: false
	              });
	          };
	      });
	  })();
	  },
  }
}
</script>

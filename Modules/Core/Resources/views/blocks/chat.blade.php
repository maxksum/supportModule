<div class="info_chat" onclick="$('.bg_close').show()">
	<a class="show-over-chat">
	<div class="author">:</div>
	<span id="messagetext"></span>
	<div class="count" id="maincount">0</div>
</a>
</div>

<div class="over-chat" id="overchat">
	<div class="content-over-chat">
		<!--LEFT-->
		<div class="left-chat">
			<div class="over-chat-title">
				<div class="title" v-if="to_userid != 0">Личные сообщения</div>
				<div class="title" v-else>Игровой чат OverPro.ru</div>
				<div class="link">
					<a class="over start">Развернуть</a> | <a class="close" onclick="$('.bg_close').hide()">Закрыть</a>
				</div>
			</div>
			<div class="send-over-chat">
				<vue-scrollbar classes="messages-scrollbar" ref="messagesscroll">
				<div class="send-inner-over-chat active" id="first-chat">
					<chat-message v-for="(message, index) in messages" :key="message.id" v-bind="{message: message, user: user, channel_id: channel_id, to_userid: to_userid, usermoderator: message.user.role != 'user', moderator: user && user.role != 'user'}"></chat-message>
				</div>
			</vue-scrollbar>
			</div>

			<ul class="over-tabs-chat">
				<chat-channels v-for="channel in channels" :key="channel.id" v-bind="{channel: channel, changeChannel}"></chat-channels>
				<vue-scrollbar classes="dialogs-scrollbar" ref="dialogsscroll">
				<div class="over-tabs-inner-chat">
					<chat-dialogs v-for="(dialog, index) in dialogs" :dialog="dialog" :newmes="dialog.newmessages != 0" :dialogs="dialogs" :index="index" :to_userid="to_userid" :key="to_userid" v-bind="{changeDialog, changeChannel, deleteDialog}"></chat-dialogs>
				</div>
			</vue-scrollbar>
			</ul>
			<chat-input v-bind:channel_id="channel_id" v-bind:to_userid="to_userid" v-if="user"></chat-input>
		</div>
		<div class="right-chat">
			<div class="over-chat-title">
				<div class="title">Сортировать список по:</div>
				<div class="link">
					<a href="/"  class="active" v-on:click="sortUsers('exp', $event)">Skill</a>
					<a href="/" v-on:click="sortUsers('name', $event)">ABC</a>
				</div>
			</div>
			<vue-scrollbar classes="players-scrollbar" ref="playersscroll">
			<div class="users-chat">
				<div class="item-chat">
					<a class="title">Администраторы - @{{admins.length}} онлайн</a>
					<chat-admins v-for="admin in admins" v-bind="{admin, dialogs, to_userid, newDialog, changeDialog, user}" :self="user && user.id == admin.id" :key="admin.id"></chat-admins>
				</div>

				<div class="item-chat">
					<a class="title">Игроки - @{{users_online.length}} онлайн</a>
					<chat-users v-for="user_online in users_online" v-bind="{user_online, dialogs, to_userid, newDialog, changeDialog, user}" :key="user_online.id" :self="user && user_online.id == user.id" :play="user_online.lobby_id"></chat-users>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>

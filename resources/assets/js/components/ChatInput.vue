<template>
<form class="input-text-chat" v-if="to_userid != -1">
<input type="text" @keyup.enter="sendMessage" placeholder="Введите текст сообщения" v-model="message" id="chat_input"/>
<input class="send-msg" name="" value="" v-on:click="sendMessage">
</form>
</template>

<script>
export default {
  props: ['channel_id', 'to_userid'],
  components: {
    'lobby-controls': require('./LobbyControls.vue'),
  },
	data: function() {
		return { message: '' }
	},
  methods: {
    sendMessage: function(event) {
      event.preventDefault();
      if(this.channel_id != 0) {
      $.post("/chat", {
          text: this.message,
          channel_id: this.channel_id
        })
        .done(function(data) {
          if (data.error) {
            alert(data.message);
          } else {
            $("#chat_input").val("");
          }
        });
        } else {
        $.post("/chat", {
            text: this.message,
            to_userid: this.to_userid
          })
          .done(function(data) {
            if (data.error) {
              alert(data.message);
            } else {
              $("#chat_input").val("");
            }
          });
        }
    }
  }
}
</script>

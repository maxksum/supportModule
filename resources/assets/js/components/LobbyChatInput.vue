<template>
<div class="detail_form" action="" method="">
  <input type="text" @keyup.enter="sendMessage" placeholder="Введите текст сообщения" required v-model="message" id="lobby_chat_input" />
  <button class="detail_button" v-on:click="sendMessage"></button>
</div>
</template>

<script>
export default {
  data: function() {
    return {
      message: "",
    };
  },
  methods: {
    sendMessage: function(e) {
      e.preventDefault();
      $.post("/lobby/message", {
          text: this.message
        })
        .done(function(data) {
          if (data.error) {
            alert(data.message);
          } else {
            $("#lobby_chat_input").val("");
          }
        });
    }
  }

}
</script>

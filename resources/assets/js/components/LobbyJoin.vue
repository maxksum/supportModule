<template>
<div class="item" v-on:click="joinLobby">
  <div class="preview_avatar">
  </div>
  <div class="preview_name" style="cursor: pointer">Присоединиться</div>
</div>
</template>

<script>
export default {
  props: ['team', 'user', 'lobby'],
  data: function() {
    return {
      sending: false,
    }
  },
  methods: {
    joinLobby: function(event) {
      if (!user) {
        alert("Вы не авторизованы!");
        return;
      }
      if (!this.sending) {
        this.sending = true;
        if (!user.lobby) {
          var input = {};
          if (this.lobby.password) {
            input['password'] = prompt("Введите пароль");
          }
          input['team'] = this.team;
          input['lobby_id'] = this.lobby.id;
          var temp = this;
          $.post("/lobby/join", input)
            .done(function(data) {
              setTimeout(function() {
                temp.sending = false;
              }, 1000);
              if (data.error) {
                alert(data.message);
              }
            });
        } else {
          this.sending = false;
        }
      }
    }
  }
}
</script>

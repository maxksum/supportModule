<template>
<div class="detail_logs">
  <div class="detail_logs_block scrollPro" id="chat_block" v-on:click="test">
    <div class="detail_logs_inner">
      <ul>
        <li is="lobby-chat-message" v-for="message in messages" :message="message" :key="message.id"></li>
      </ul>
    </div>
  </div>
  <lobby-chat-input v-if="user && user.lobby && user.lobby.id == lobby.id"></lobby-chat-input>
</div>
</template>

<script>
export default {
  props: ['messages', 'user', 'lobby'],
  methods: {
    test: function(e) {
      this.$forceUpdate();
    },
  },
  components: {
    'lobby-chat-input': require('./LobbyChatInput.vue'),
    'lobby-chat-message': require('./LobbyChatItem.vue'),
  },
}
</script>

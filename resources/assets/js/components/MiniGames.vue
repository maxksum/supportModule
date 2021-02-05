<template lang="html">

  <div class="minigames__wrap">
    <mini-crash-header :selectMethod="selectGame"></mini-crash-header>
    <mini-coin-header :selectMethod="selectGame"></mini-coin-header>
    <mini-knb-header :selectMethod="selectGame"></mini-knb-header>

    <mini-crash-content v-if="selected == 1" v-bind="{changeGame: selectGame}"></mini-crash-content>
    <mini-coin-content v-if="selected == 2" v-bind="{changeGame: selectGame}"></mini-coin-content>
    <mini-knb-content v-if="selected == 3" v-bind="{changeGame: selectGame}"></mini-knb-content>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      selected: 0
    }
  },
  methods: {
    selectGame: function(id) {
      this.selected = id;
    }
  },
  components: {
    'mini-crash-header': require('./MiniCrashHeader.vue'),
    'mini-crash-content': require('./MiniCrashContent.vue'),
    'mini-coin-header': require('./MiniCoinHeader.vue'),
    'mini-coin-content': require('./MiniCoinContent.vue'),
    'mini-knb-header': require('./MiniKnbHeader.vue'),
    'mini-knb-content': require('./MiniKnbContent.vue')
  }
}
</script>

<style lang="css">
</style>

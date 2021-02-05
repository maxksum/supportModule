<template lang="html">
  <div class="item" v-bind:class="{'active': activeItem}">
    <div class="title">РЕЙТИНГ ПО {{top.title}}</div>
    <div class="inner" v-on:click='clickMethod(index)'>
      <div class="inner_item" v-if="top.players[1]">
        <div class="name">{{top.players[1].user.name.length > 15 ? top.players[1].user.name.substring(0, 12) + "..." : top.players[1].user.name}}</div>
      </div>
      <div class="inner_item" v-if="top.players[0]">
        <div class="name">{{top.players[0].user.name.length > 15 ? top.players[0].user.name.substring(0, 12) + "..." : top.players[0].user.name}}</div>
      </div>
      <div class="inner_item" v-if="top.players[2]">
        <div class="name">{{top.players[2].user.name.length > 15 ? top.players[2].user.name.substring(0, 12) + "..." : top.players[2].user.name}}</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['activeItem', 'top', 'clickMethod', 'index']
}
</script>

<style lang="css">
</style>

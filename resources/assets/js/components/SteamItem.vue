<template lang="html">
  <div class="item" v-bind:class="{'active': item.selected, 'no-active': !item.selected}" v-on:click="clickmethod(item)">
    <div class="img"><img :src="'https://steamcommunity-a.akamaihd.net/economy/image/' + item.icon_url + '/150x150'"></div>
    <div class="count">{{Math.floor(item.price / money_multiplier)}}</div>
    <div class="text">
      <span>{{name}}</span>
      <p>{{fullname}} {{quality}}</p>
    </div>
  </div>
</template>

<script>
export default {
  props: ['item', 'clickmethod'],
  data: function() {
    return {
      name: "",
      fullname: "",
      quality: "",
      money_multiplier: money_multiplier
    }
  },
  updated() {
    if (this.item.container == true) {
      this.name = "Кейс";
      this.fullname = this.item.market_hash_name;
      this.quality = "";
    } else if (this.item.sticker == true) {
      this.name = "Наклейка";
      this.fullname = this.item.market_hash_name;
      this.quality = "";
    } else if (this.item.market_hash_name.indexOf("|") > -1) {
      var temp = this.item.market_hash_name.split(" | ");
      this.name = temp[0];
      this.fullname = temp[1].substring(0, temp[1].indexOf("(") - 1);
      this.quality = temp[1].substring(temp[1].indexOf("(") + 1, temp[1].indexOf(")"))
    } else {
      this.name = "";
      this.fullname = this.item.market_hash_name;
      this.quality = "";
    }
  },
  created() {
    if (this.item.type == "Base Grade Container") {
      this.name = "Кейс";
      this.fullname = this.item.market_hash_name;
      this.quality = "";
    } else if (this.item.sticker) {
      this.name = "Наклейка";
      this.fullname = this.item.market_hash_name;
      this.quality = "";
    } else if (this.item.market_hash_name.indexOf("|") > -1) {
      var temp = this.item.market_hash_name.split(" | ");
      this.name = temp[0];
      this.fullname = temp[1].substring(0, temp[1].indexOf("(") - 1);
      this.quality = temp[1].substring(temp[1].indexOf("(") + 1, temp[1].indexOf(")"))
    }
  }
}
</script>

<style lang="css">
</style>

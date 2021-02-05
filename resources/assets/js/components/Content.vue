<template>
<div id="general">
  <vue-progress-bar></vue-progress-bar>
  <navigation :user="user"></navigation>
  <header-content :news="news"></header-content>
  <header-shortcuts v-if="false"></header-shortcuts>
  <router-view></router-view>
  <footer-content></footer-content>
</div>
</template>

<script>
import Navigation from './Navigation.vue';
import HeaderShortcuts from './HeaderShortcuts.vue';
import HeaderContent from './Header.vue';
import FooterContent from './Footer.vue';

export default {
  data: function() {
    return {
      user: user,
      news: news,
    }
  },
  components: {
    Navigation,
    HeaderContent,
    FooterContent,
    HeaderShortcuts
  },
  created() {
    if (this.user) {
      Echo.channel("User" + this.user.id)
      .listen(".updated", (e) => {
        this.$set(this, 'user', e.user);
      })
      .listen(".notification", (e) => {
        alert(e.message);
      });
    }
  }
}
</script>

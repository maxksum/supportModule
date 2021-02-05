<template lang="html">
  <div id="navigation">
          <div id="nav-inner">
            <div class="nav-right">
                <div class="activ">
                    <a href="/ru">
                        <span>RUS</span>
                        <div class="img">
                            <img src="/images/ico-rus.png">
                        </div>
                    </a>
                </div>
            </div>
            <div class="rightSub">
                <a href="/">
                    <div class="img">
                        <img src="/images/ico-en.png">
                    </div>
                    <span>ENG</span>
                </a>
            </div>
            <navigation-menu></navigation-menu>

            <profile-head v-if="user" :user="user"></profile-head>
            <a v-else href="/user/login" class="login_steam_top">
              <span>ВОЙТИ ЧЕРЕЗ STEAM</span>
            </a>
          </div>
      </div>
</template>

<script>
import ProfileHead from './ProfileHead.vue';
import NavigationMenu from './NavigationMenu.vue';
export default {
  props: ['user'],
  components: {
    ProfileHead, NavigationMenu
  }
}
</script>

<style lang="css">
</style>

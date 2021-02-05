<template lang="html">
  <div id="wrapper">

		<div class="games__wrap border-box" v-if="user.role == 'administrator'">
				<mini-blocks></mini-blocks>

				<mini-games></mini-games>
			</div>

	</div>
</template>

<script>
export default {
  data: () => {
    return {
      user: user
    }
  },
  components: {
    'mini-blocks': require('./MiniBlocks.vue'),
    'mini-games': require('./MiniGames.vue')
  }
}
</script>

<style lang="css">
</style>

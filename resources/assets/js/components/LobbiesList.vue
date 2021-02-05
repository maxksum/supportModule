<template>
	<div class="tbody" id="lobbies_list">
		<div is="lobby-item" v-for="lobby in lobbies" :lobby="lobby" :key="lobby.id"></div>
	</div>
</template>

<script>
	export default {
		props: ['lobbies'],
		components: {
			'lobby-item': require('./LobbyItem.vue'),
		}
	}
</script>

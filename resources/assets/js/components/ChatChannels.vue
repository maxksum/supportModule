<template>
<li class="gen-chat">
  <a v-on:click="changeChannel(channel.id)">{{channel.title}}</a>
</li>
</template>

<script>
	export default {
		props: ['channel', 'changeChannel'],

	}
</script>

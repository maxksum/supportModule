<template>
  <li v-bind:class="[ to_userid == dialog.id ? 'active' : newmes ? 'new-message' : '']"> <i v-on:click="deleteDialog(index, dialog.id)"></i><a v-on:click="changeDialog(dialog.id)">{{dialog.title}} <span class="dialogcount">{{dialog.newmessages}}</span></a></li>
</template>

<script>
	export default {
		props: ['dialog', 'changeDialog', 'to_userid', 'index', 'changeChannel', 'dialogs', 'deleteDialog', 'newmes'],
  }
</script>

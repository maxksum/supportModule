<template>
<li :class="class_var">
  <div class="logs_time">{{message.created_at.date.substring(11, 19)}}</div>
  <div class="logs_name" v-if="message.user_id == -1">{{message.name}}:</div>
  <div class="logs_name" v-else><a :href="'/user/' + message.user_id" target="_blank">{{message.name}}</a>:</div>
  <div class="logs_text">
    {{message.text}}
  </div>
</li>
</template>

<script>
export default {
  props: ["message"],
	data: function() {
		return {class_var: ""};
	},
	created() {
		if (this.message.user_id == 0) {
			this.$set(this, "class_var", "systems");
		}
	}
}
</script>

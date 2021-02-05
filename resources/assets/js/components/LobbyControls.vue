<template>
  <ul class="preview_act">
    <li>
      <a class="with_title" title="Переместить&nbsp;в&nbsp;другую&nbsp;команду" v-on:click="move_method(player.user_id, $event)"></a>
    </li>
    <li>
      <a class="with_title" title="Кикнуть&nbsp;из&nbsp;лобби" v-on:click="kick_method(player.user_id, $event)"></a>
    </li>
  </ul>
</template>

<script>
export default {
  props: ['player', 'user', 'creator', 'kick_method', 'show_method', 'move_method'],
}
</script>

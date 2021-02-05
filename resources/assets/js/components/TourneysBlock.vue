<template lang="html">
  <div>
  <div is="tourney-item" v-for="tourney in tourneys" :tourney="tourney" :key="tourney.id"> </div>
</div>
</template>

<script>
import TourneyItem from './TourneyItem.vue';
export default {
  props: ['tourneys'],
  data: function() {
    return {

    }
  },
  components: {
    TourneyItem
  }
}
</script>

<style lang="css">
</style>

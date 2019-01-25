<template>
  <div>
    Mesaj sayısı {{ countMessages }}
    <button class="btn btn-default" v-on:click="removeAll()">Remove All Messages</button>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  computed: {
    ...mapGetters([
      'countMessages'
    ]),
  },
  methods: {
    ...mapActions([
      'removeAllMessages'
    ]),
    removeAll: function() {
      this.removeAllMessages();
    }
  }
}
</script>

<style>

</style>

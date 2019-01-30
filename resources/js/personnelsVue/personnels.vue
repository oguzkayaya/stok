<template>
  <div>
    <router-view></router-view>    
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  data: function() {
    return {

    }
  },
  created: function() {
    this.loadPersonnels();
    this.loadPayments();
  },
  methods: {
    ...mapActions([
        'loadPersonnels',
        'loadPayments'
      ]),
  }
}
</script>

<style>
 
</style>


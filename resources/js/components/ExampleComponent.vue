<template>
    <div class="container col-md-12">
      <div class="top">
        <h3>Component 1</h3>
        {{ getTitle }}


        <input type="text" v-model="newMessage">
        <button v-on:click="addMessage(newMessage)">Add</button>

        <ul>
          <li v-for="(message, index) in getMessages" :key="index">
            {{ message }}
            <button v-on:click="removeMessage(index)" class="btn btn-danger btn-sm" style="margin:10px;">Remove</button>
          </li>
        </ul>
      </div>
      <hr>
      <div class="bot">
        <h3>Component 2</h3>
        <ex2></ex2>
      </div>
    </div>
</template>

<script>
import ex2 from './ex2.vue';
import { mapGetters, mapMutations, mapActions } from "vuex";
  export default {
    data: function() {
      return {
        newMessage: '',
      }
    },
    computed: {
      ...mapGetters([
        'getTitle',
        'getMessages'
      ])
    },
    methods: {
      ...mapMutations([
        'ADD_MESSAGE'
      ]),
      ...mapActions([
        'removeMessage'
      ]),
      addMessage: function() {
        this.ADD_MESSAGE(this.newMessage);
        this.newMessage = ''; 
      },
      removeMsg: function(message) {
        this.removeMessage(message);
      }
    },
    components: {
      ex2,
    }
  }
</script>


<style>
.top {
  background-color: darkgrey;
  padding: 30px;
  margin: 30px;
}
.bot {
  background-color: lavender;
  padding: 30px;
  margin: 30px;
}
</style>

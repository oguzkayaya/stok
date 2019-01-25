import Vuex from 'vuex';
window.Vue = require('vue');
Vue.use(Vuex);


export default new Vuex.Store({
  state: {
    title: 'Mesajler',
    messages: [
      '123',
      '456',
      '789'
    ],
  },
  getters: {
    countMessages: function(state) {
      return state.messages.length;
    },
    getMessages: function(state) {
      return state.messages;
    },
    getTitle: function(state) {
      return state.title;
    }
  },
  mutations: {
    ADD_MESSAGE: function(state, message) {
      state.messages.push(message);
    },
    REMOVE_MESSAGE: function(state, messageIndex) {
      state.messages.splice(messageIndex, 1);
    },
    REMOVE_ALL_MESSAGES: function(state) {
      state.messages = [];
    }
  },
  actions: {
    removeMessage: function(context, messageIndex) {
      context.commit('REMOVE_MESSAGE', messageIndex);
    },
    // removeAllMessages: function(context) {
    //   context.commit('REMOVE_ALL_MESSAGES');
    // },
    removeAllMessages({commit}) {
      return new Promise((resolve, reject) => {
        setTimeout(() => {
          commit('REMOVE_ALL_MESSAGES');
          resolve();
        }, 1500)
      })
    }
  }
})
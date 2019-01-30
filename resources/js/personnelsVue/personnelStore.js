import Vuex from 'vuex';
window.Vue = require('vue');
Vue.use(Vuex);



export default new Vuex.Store({
  state: {
    personnels: {},
    isLoading: true,
    payments: {},
  },
  getters: {
    personnels: function(state) {
      return state.personnels;
    },
    isLoading: function(state) {
      return state.isLoading;
    },
    payments: function(state) {
      return state.payments;
    }
  },
  mutations: {
    INIT_PERSONNELS: function(state, personnels) {
      state.personnels = personnels;
      state.isLoading = false;
    },
    INIT_PAYMENTS: function(state, payments) {
      state.payments = payments;
    },
    REMOVE_PERSONNEL: function(state, index) {
      state.personnels.splice(index, 1);
    },
    ADD_PERSONNEL: function(state, personnel) {
      state.personnels.push(personnel);
    },
    REMOVE_PAYMENT: function(state, index) {
      state.payments.splice(index, 1);
    },
    ADD_PAYMENT: function(state, payment) {
      state.payments.push(payment);
    }
  },
  actions: {
    loadPersonnels: function(context) {
      axios
      .get('http://127.0.0.1:8000/getPersonnels')
      .then(response => {
        context.commit('INIT_PERSONNELS', response.data.personnels);
      })
    },
    _removePersonnel: function(context, index) {
      const deletedPersonnelId = context.state.personnels[index].id;
      axios
        .delete('http://127.0.0.1:8000/personnels/' + deletedPersonnelId)
        .then((response) => {
          if(response.data == 1) {
            context.commit('REMOVE_PERSONNEL', index);
          } else if(response.data == 0) {
            alert('Silinemiyor');
          }
        })
    },
    _addPersonnel: function(context, personnel) {
      axios
      .post('/personnels', personnel)
      .then((response) => {
        if(response.data.createdPersonnel)
          context.commit('ADD_PERSONNEL', response.data.createdPersonnel);
        else
          alert('Eklenemiyor');
      })
    },

    loadPayments: function(context) {
      axios
      .get('http://127.0.0.1:8000/getPayments')
      .then(response => {
        context.commit('INIT_PAYMENTS', response.data.payments);
      })
    },
    _removePayment: function(context, index) {
      const deletedPayment = context.state.payments[index].id;
      axios
        .delete('http://127.0.0.1:8000/payments/' + deletedPayment)
        .then((response) => {
          if(response.data == 1) {
            context.commit('REMOVE_PAYMENT', index);
          } else if(response.data == 0) {
            alert('Silinemiyor');
          }
        })
      context.commit('REMOVE_PAYMENT', index);
    },
    _addPayment: function(context, newPayment) {
      axios
      .post('/payments', newPayment)
      .then((response) => {
        if(response.data.createdPayment) {
          context.commit('ADD_PAYMENT', response.data.createdPayment);
          this.$router.push({ path: '/personnel/payments' })
        }
        else
          alert('Eklenemiyor');
      })
    }
  }
})
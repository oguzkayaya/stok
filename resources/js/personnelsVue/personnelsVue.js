require('../bootstrap');


window.Vue = require('vue');


import VueRouter from 'vue-router';
Vue.use(VueRouter);

import store from './personnelStore'


const personnels = Vue.component('personnels', require('./personnels.vue').default);
const personelList = Vue.component('personelList', require('./personnelList.vue').default);
const personelPayment = Vue.component('pPayments', require('./pPayments.vue').default);
const newPayment = Vue.component('newPayment', require('./newPayment.vue').default);

const routes = [
  { path: '/personnels', component: personelList },
  { path: '/personnel/payments', component: personelPayment },
  { path: '/personnel/newPayment', component: newPayment }
]


const router = new VueRouter({
  mode: 'history',
  routes // short for `routes: routes`
})



var app = new Vue({
  el: '#personnel',
  router,
  store,
})

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import VueRouter from 'vue-router';
import Vuelidate from 'vuelidate';
window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(Vuelidate);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const exampleComponent = Vue.component('example-component', require('./components/ExampleComponent.vue').default);
const customerTable = Vue.component('customer-table' , require('./components/customer-table.vue').default);

const status = Vue.component('status', require('./components/status.vue').default);

const createIncome = Vue.component('create-income', require('./components/create-income.vue').default);
const incomeTable = Vue.component('income-table', require('./components/income-table.vue').default);
const editIncome = Vue.component('edit-income', require('./components/edit-income.vue').default);

import store from './store'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const routes = [
  { path: '/incomes/new', component: createIncome },
  { path: '/incomes', component: incomeTable },
  { path: '/incomes/:income_id/edit', component: editIncome },
  { path: '/incomes/example', component: exampleComponent }
]
const router = new VueRouter({
  mode: 'history',
  routes // short for `routes: routes`
})

var app = new Vue({
    el: '#app',
    router,
    store,
  })


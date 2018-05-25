
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('searchRoom', require('./components/room/searchRoom.vue'));
// Vue.component('buttonCreateRoom', require('./components/room/buttonCreateRoom.vue'));
Vue.component('listRoom', require('./components/room/listRoom.vue'));
Vue.component('list-users', require('./components/user/listUser'));
Vue.component('reservations', require('./components/reservation/reservations'));
Vue.component('allStatistics', require('./components/statistics/allStatistics'));

Vue.component('card', require('./components/shared/card'));
Vue.component('loader', require('./components/shared/loader'));

const app = new Vue({
    el: '#app',
});

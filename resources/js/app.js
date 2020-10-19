/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueLocalStorage from 'vue-localstorage'
import vSelect from 'vue-select'
import App from './components/App'

Vue.use(VueLocalStorage);

import numeral from 'numeral';
import numFormat from 'vue-filter-number-format';

Vue.filter('numFormat', numFormat(numeral));

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('v-select', vSelect);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import store from './store.js'
import router from './router/index.js'
import Axios from 'axios'

Vue.prototype.$http = Axios;

const token = localStorage.getItem('token');

if (token) {
    Vue.prototype.$http.defaults.headers.common['Authorization'] = token
}

new Vue({
    el: '#app',
    store: store,
    components: { App },
    router: router,
    beforeMount() {
        this.$store.dispatch('me');

        if(this.$localStorage.get('cart')) this.$store.commit('setCart', JSON.parse(this.$localStorage.get('cart')));
        if(this.$localStorage.get('currency')) this.$store.commit('setCurrency', JSON.parse(this.$localStorage.get('currency')));
    },
});

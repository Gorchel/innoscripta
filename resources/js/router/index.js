import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Home from '../components/layout/Home.vue';
import Login from '../components/layout/Login.vue';
import Cart from '../components/layout/Cart.vue';

const routes = [
    { path: '/', component: Home },
    { path: '/login', component: Login },
    { path: '/cart', component: Cart },
];

const router = new VueRouter({
    routes
});

export default router;


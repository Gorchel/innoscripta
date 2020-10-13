import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Home from '../components/pages/Home.vue';
import Login from '../components/pages/Login.vue';
import Registration from '../components/pages/Registration.vue';
import Cart from '../components/pages/Cart.vue';
import Secure from '../components/pages/Secure.vue';

const routes = [
    { path: '/', component: Home },
    { path: '/login', component: Login },
    { path: '/cart', component: Cart },
    { path: '/registration', component: Registration },
    { path: '/secure', component: Secure },
];

const router = new VueRouter({
    routes
});

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            next()
            return
        }
        next('/login')
    } else {
        next()
    }
});

export default router;


import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        currency: {},
        cart: {},
        cartCount: 0,
        token: localStorage.getItem('token') || '',
        user : {},
        status: '',
    },
    actions: {
        login({commit}, user){
            return new Promise((resolve, reject) => {
                commit('auth_request')
                axios({url: '/api/auth/login', data: user, method: 'POST' })
                    .then(resp => {
                        const token = resp.data.token_type + ' ' + resp.data.access_token;
                        const user = resp.data.user;
                        localStorage.setItem('token', token);
                        axios.defaults.headers.common['Authorization'] = token;
                        commit('auth_success', token, user);
                        resolve(resp)
                    })
                    .catch(err => {
                        commit('auth_error')
                        localStorage.removeItem('token');
                        reject(err)
                    })
            })
        },
        register({commit}, user){
            return new Promise((resolve, reject) => {
                commit('auth_request')
                axios({url: '/api/auth/register', data: user, method: 'POST' })
                    .then(resp => {
                        const token = resp.data.token_type + ' ' + resp.data.access_token;
                        const user = resp.data.user;
                        localStorage.setItem('token', token);
                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                        commit('auth_success', token, user);
                        resolve(resp)
                    })
                    .catch(err => {
                        commit('auth_error', err)
                        localStorage.removeItem('token');
                        reject(err)
                    })
            })
        },
        logout({commit}){
            return new Promise((resolve, reject) => {
                commit('logout')
                localStorage.removeItem('token');
                delete axios.defaults.headers.common['Authorization'];
                resolve()
            })
        },
        me({commit}){
            return new Promise((resolve, reject) => {
                axios({url: '/api/auth/me', data: {}, method: 'POST' })
                    .then(resp => {
                        commit('setUser', resp.data);
                    });
            });
        },
    },
    mutations: {
        setCurrency(state, currency) {
            state.currency = currency;
        },
        setCart(state, cart) {
            state.cart = cart;
            localStorage.setItem('cart', JSON.stringify(cart));
        },
        incrementCart(state, good) {
            if (_.isUndefined(state.cart[good.id])) {
                good.count = 1;
                state.cart[good.id] = good;
            } else {
                state.cart[good.id]['count'] = state.cart[good.id]['count'] + 1;
            }
        },
        setCartCount(state) {
            var count = 0;

            _.each(state.cart, function(item){
                count += item.count;
            });

            state.cartCount = count;
        },
        setUser(state, user) {
            state.user = user;
        },
        auth_request(state){
            state.status = 'loading'
        },
        auth_success(state, token, user){
            state.status = 'success'
            state.token = token
            state.user = user
        },
        auth_error(state){
            state.status = 'error'
        },
        logout(state){
            state.status = ''
            state.token = ''
        },
    },
    getters: {
        getCart: state => {
            return state.cart;
        },
        getCartCount: state => state.cartCount,
        isLoggedIn: state => !!state.token,
        authStatus: state => state.status,
        getUserName: state => state.user.name,
    },
});

export default store;

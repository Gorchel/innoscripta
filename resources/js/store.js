import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        currency: {},
        cart: {},
    },
    mutations: {
        setCurrency(state, currency) {
            state.currency = currency;
        },
        setCart(state, cart) {
            state.cart = cart;
        },
        incrementCart(state, good) {
            if (_.isUndefined(state.cart[good.id])) {
                good.count = 1;
                state.cart[good.id] = good;
            } else {
                state.cart[good.id]['count'] = state.cart[good.id]['count'] + 1;
            }
        },
    },
    getters: {
        getCart: state => {
            return state.cart;
        },
        getCartCount: state => {
            var count = 0;

            _.each(state.cart, function(item){
                count += item.count;
            });

            return count;
        },
    },
});

export default store;

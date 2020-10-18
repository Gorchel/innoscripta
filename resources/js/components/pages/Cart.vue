<template>
    <div v-if="!successStatus" class="cart-page">
        <div class="row" v-if="checkNotEmpty($store.state.cart)">
            <CartGood
                v-for="item in $store.state.cart"
                :key="item.id"
                :item="item"
            ></CartGood>
            <hr/>
            <div class="col-12 cart-delivery-select">
                <div class="row">
                    <div class="col-6">
                        <label for="delivery">Выберите доставку</label>
                        <select v-model="selectedDelivery" id="delivery" class="form-control" requred="requered">
                            <option :value="deliveryItem.id" :key="deliveryItem.id" v-for="deliveryItem in deliveryList">{{getDeliveryName(deliveryItem)}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="fixed-bottom cart-footer">
                <div class="container">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <h2>Итого: {{getAmountWithCurrency() | numFormat('0.00')}} {{this.$store.state.currency.sign}}</h2>
                            </div>
                            <div class="col-6 text-right">
                                <router-link v-if="!this.$store.getters.isLoggedIn" to="/login" class="btn cart-btn">Login</router-link>
                                <button v-else class="btn cart-btn" @click="checkout">Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-else>
            <div class="col-12">
                <p>There are no items in the cart</p>
            </div>
        </div>
    </div>
    <div v-else>
        <p>Your order has been created</p>
        <p>
            <router-link v-if="this.$store.getters.isLoggedIn" to="/history" class="btn cart-btn">History</router-link>
        </p>
    </div>

</template>

<script>
    import CartGood from '../cart/CartGood';
    import numeral from 'numeral';

    export default {
        name: 'cart',
        data() {
            return {
                deliveryList: {
                    1: {id: 1, name: 'delivery 1', cost: 0.50},
                    2: {id: 2, name: 'delivery 2', cost: 0.60},
                    3: {id: 3, name: 'delivery 3', cost: 0.80},
                },
                selectedDelivery: 1,
                successStatus: false,
            }
        },
        components: {CartGood},
        methods: {
            getRecordFromCart(id)
            {
                var key = _.findLastIndex(this.cartList.data, {
                    id: id
                });

                if (key === -1) {
                    return {};
                }

                return this.cartList.data[key];
            },
            getAmountWithCurrency()
            {
                return this.getAmount() * this.$store.state.currency.currency;
            },
            getAmount()
            {
                var amount = 0;

                $.each(this.$store.state.cart, function(key, value) {
                    amount += (value.count * value.price);
                });

                amount += this.deliveryList[this.selectedDelivery].cost;

                return amount;
            },
            getDeliveryName(deliveryItem)
            {
                return deliveryItem.name + ' (' + numeral(deliveryItem.cost * this.$store.state.currency.currency).format('0.00') + ' ' + this.$store.state.currency.sign + ')';
            },
            checkNotEmpty(object) {
                return !_.isEmpty(object);
            },
            checkout()
            {
                var data = {
                    delivery_id: this.selectedDelivery,
                    total: this.getAmount(),
                    goods_ids: {},
                };

                $.each(this.$store.state.cart, function(key, value) {
                    data['goods_ids'][key] = value.count;
                });

                console.log(data);

                axios({url: '/api/order/checkout', data: data, method: 'POST' })
                    .then(resp => {
                        this.successStatus = true;
                        this.$store.commit('setCart', {});
                        // const token = resp.data.access_token
                        // const user = resp.data.user
                        // localStorage.setItem('token', token)
                        // axios.defaults.headers.common['Authorization'] = token
                        // commit('auth_success', token, user)
                        // resolve(resp)
                    })
                    .catch(err => {
                        reject(err)
                    })
            }
        }
    }
</script>
<style>
    .cart-footer {
        background-color: white;
    }

    .cart-footer > .container {
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        padding: 10px;
    }

    .cart-page {
        padding-bottom: 100px;
    }

    .cart-delivery-select {
        margin: 15px 0px;
    }

    .cart-delivery-select label {
        font-weight: bold;
        font-size: 20px;
    }

    .cart-delivery-select select {
        border-color: orange;
    }

    .cart-btn {
        border: 2px solid orange;
        margin-left: 10px;
    }

    .cart-btn:hover {
        background-color: orange;
        color: white;
    }
</style>

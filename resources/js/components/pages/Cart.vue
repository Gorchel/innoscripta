<template>
    <div v-if="status === 1" class="cart-page">
        <div class="row" v-if="checkNotEmpty($store.state.cart)">
            <CartGood
                v-for="item in $store.state.cart"
                :key="item.id"
                :item="item"
            ></CartGood>
            <hr/>
            <div class="fixed-bottom cart-footer">
                <div class="container">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <h2>Итого: {{getAmountWithCurrency() | numFormat('0.00')}} {{this.$store.state.currency.sign}}</h2>
                            </div>
                            <div class="col-6 text-right">
                                <button class="btn cart-btn" @click="step(2)">Checkout</button>
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
    <div v-else-if="status === 2" class="row">
        <div class="col-6 offset-md-3">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="name" v-model="form.body.name" class="form-control orange-input" id="name" placeholder="name" required="required">
                <span class="text-center errors">{{ form.errors.name }}</span>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="address" v-model="form.body.address" id="address" class="form-control orange-input" placeholder="address" required="required">
                <span class="text-center errors">{{ form.errors.address }}</span>
            </div>
            <hr/>
            <div class="form-group">
                <label for="delivery">Выберите доставку</label>
                <select v-model="form.body.delivery_id" id="delivery" class="form-control orange-input" requred="requered">
                    <option :value="deliveryItem.id" :key="deliveryItem.id" v-for="deliveryItem in deliveryList">{{getDeliveryName(deliveryItem)}}</option>
                </select>
                <span class="text-center errors">{{ form.errors.delivery_id }}</span>
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
                            <button class="btn cart-btn" @click="checkout">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
        <p>Your order has been created</p>
        <p>
            <router-link v-if="!this.$store.getters.isLoggedIn" to="/" class="btn cart-btn">Home</router-link>
            <router-link v-else to="/history" class="btn cart-btn">History</router-link>
        </p>
    </div>

</template>

<script>
    import CartGood from '../cart/CartGood';
    // import AddressForm from '../cart/AddressForm';
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
                status: 1,
                form: {
                    body: {
                        name: '',
                        address: '',
                        delivery_id: 1,
                        goods_ids: {},
                    },
                    errors: '',
                }
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

                amount += this.deliveryList[this.form.body.delivery_id].cost;

                return amount;
            },
            setStatus(status) {
              this.status = status;
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
                var data = this.form.body,
                    _this = this;

                data['total'] = this.getAmount();

                $.each(this.$store.state.cart, function(key, value) {
                    data['goods_ids'][key] = value.count;
                });

                axios({url: '/api/order/checkout', data: data, method: 'POST' })
                    .then(resp => {
                        console.log(resp);
                        this.status = 3;
                        this.$store.commit('setCart', {});
                        this.$store.commit('setCartCount');
                    })
                    .catch(err => {
                        console.log(err.response);
                        _this.form.errors = err.response.data;
                    })
            },
            step(step) {
                this.setStatus(step);

                if (!this.checkNotEmpty(this.form.body.name)) {
                    this.form.body.name = this.$store.getters.getUserName;
                }
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

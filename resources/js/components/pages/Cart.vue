<template>
    <div class="row" v-if="$store.state.cart">
        <CartGood
            v-for="item in $store.state.cart"
            :key="item.id"
            :item="item"
        ></CartGood>
        <hr/>
        <div class="col-12">
            <div class="row">
                <div class="col-4">
                    <label for="delivery">Выберите доставку</label>
                    <select v-model="selectedDelivery" id="delivery" class="form-control" requred="requered">
                        <option :value="deliveryItem.id" :key="deliveryItem.id" v-for="deliveryItem in deliveryList">{{deliveryItem.name}}</option>
                    </select>
                </div>
            </div>
        </div>
        <hr/>
        <div class="col-12">
            <h2>Итого: {{getAmount() | numFormat('0.00')}} {{this.$store.state.currency.sign}}</h2>
        </div>
    </div>
    <div class="row" v-else>
        <div class="col-12">
            <p>Товары в корзине отсутствуют</p>
        </div>
    </div>
</template>

<script>
    import CartGood from '../cart/CartGood';

    export default {
        name: 'cart',
        data() {
            return {
                deliveryList: {
                    1: {id: 1, name: 'delivery 1', cost: '0.50'},
                    2: {id: 2, name: 'delivery 2', cost: '0.60'},
                    3: {id: 3, name: 'delivery 3', cost: '0.80'},
                },
                selectedDelivery: 1,
            }
        },
        components: {CartGood},
        mounted() {
            // this.getCartList();
        },
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
            getAmount()
            {
                var amount = 0,
                    _this = this;

                $.each(this.$store.state.cart, function(key, value) {
                    amount += (value.count * value.price) * _this.$store.state.currency.currency;
                });

                return amount;
            }
        }
    }
</script>

<template>
    <div class="row" v-if="$store.state.cart">
        <CartGood
            v-for="item in $store.state.cart"
            :key="item.id"
            :item="item"
        ></CartGood>
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
        // data() {
        //     return {
        //         cartList: {},
        //     }
        // },
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
            }
        }
    }
</script>

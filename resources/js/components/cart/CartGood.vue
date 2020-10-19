<template>
    <div class="good-cart col-12">
        <div class="row">
            <div class="col-3">
                <img class="good-img" :src="item.img_path" :alt="item.name">
            </div>
            <div class="col-6">
                <p class="good-name"><b>{{item.name}}</b></p>
                <p class="good-description">{{item.description}}</p>
                <p>Count: {{item.count}}</p>
                <p class="good-price">
                    <span>{{ getPrice(item.price) | numFormat('0.00')}} {{this.$store.state.currency.sign}}</span>
                </p>
            </div>
            <div class="col-2">
                <span class="good-delete" @click="removeItem(item.id)">x</span>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "cart_good",
        props: ['item','count'],
        methods: {
            getPrice() {
                return this.item.price * this.$store.state.currency.currency * this.item.count;
            },
            removeItem(id) {
                // delete this.$store.state.cart[id];
                Vue.delete(this.$store.state.cart, id);
                this.$store.commit('setCartCount');
                this.changeLocalStorageCart();
            },
            changeLocalStorageCart() {
                this.$localStorage.set('cart', JSON.stringify(this.$store.state.cart));
            },
        }
    }
</script>
<style>
    .good-cart .good-img {
        width: 100%;
    }

    .good-cart .good-description {
        color: grey;
    }

    .good-cart .good-price {
        font-weight: bold;
    }

    .good-delete {
        color: orange;
        cursor: pointer;
    }
</style>

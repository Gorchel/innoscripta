<template>
    <div class="good-cart col-12">
        <div class="row">
            <div class="col-4">
                <img :src="item.img_path" :alt="item.name">
            </div>
            <div class="col-6">
                <p>{{item.name}}</p>
                <p>{{item.description}}</p>
                <p>{{item.count}}</p>
                <p>
                    <span>{{ getPrice(item.price) | numFormat('0.00')}} {{this.$store.state.currency.sign}}</span>
                </p>
            </div>
            <div class="col-2">
                <span @click="removeItem(item.id)">x</span>
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
                this.changeLocalStorageCart();
            },
            changeLocalStorageCart() {
                this.$localStorage.set('cart', JSON.stringify(this.$store.state.cart));
            },
        }
    }
</script>

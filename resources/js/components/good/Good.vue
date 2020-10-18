<template>
    <div class="good-cart col-lg-4 col-md-6">
        <img :src="good.img_path" :alt="good.name">
        <p><b>{{good.name}}</b></p>
        <p class="good-description">{{good.description}}</p>
        <p>
            <span class="good-price">{{ getPrice(good.price) | numFormat('0.00')}} {{this.$store.state.currency.sign}}</span>
            <button class="btn choose-btn" @click="addToCart(good)">Choose</button>
        </p>
    </div>
</template>
<script>
    export default {
        name: "good",
        props: ['good'],
        methods: {
            addToCart(good) {
                this.$store.commit('incrementCart', good);
                this.changeLocalStorageCart();
            },
            changeLocalStorageCart() {
                this.$localStorage.set('cart', JSON.stringify(this.$store.getters.getCart));
            },
            getPrice(price) {
                return price * this.$store.state.currency.currency;
            }
        }
    }
</script>
<style>
    .choose-btn {
        border: 2px solid orange;
        margin-left: 10px;
    }

    .choose-btn:hover {
        background-color: orange;
        color: white;
    }

    .good-description {
        color: grey;
    }

    .good-price {
        font-weight: bold;
    }
</style>

<template>
    <router-link to="/cart" class="btn header-btn">{{this.$store.getters.getCartCount}}</router-link>
</template>
<script>
    export default {
        name: "cart",
        mounted() {
            this.$store.commit('setCartCount');
        }
    }
</script>

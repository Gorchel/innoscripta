<template>
    <router-link to="/cart" class="btn header-btn">{{getGoodCount()}}</router-link>
</template>
<script>
    export default {
        name: "cart",
        methods: {
            getGoodCount() {
                return this.$store.getters.getCartCount;
            }
        }
    }
</script>

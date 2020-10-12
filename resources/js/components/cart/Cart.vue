<template>
    <router-link to="/cart" class="btn btn-info">{{getGoodCount()}}</router-link>
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

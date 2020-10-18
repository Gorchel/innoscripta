<template>
    <div>
        <header class="header fixed-top">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <h1><router-link to="/" class="navbar-brand">{{title}}</router-link></h1>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mr-auto">

                        </ul>
                        <form class="">
                            <currency-select></currency-select>
                            <span v-if="!this.$store.getters.isLoggedIn">
                                    <router-link  to="/login" class="btn header-btn">Login</router-link>
                            </span>
                            <span v-else>
                                    <router-link to="/history" class="btn header-btn">History</router-link>
                                    <button class="btn header-btn" @click="$store.dispatch('logout', $store.state)">Logout</button>
                                </span>
                            <cart></cart>
                        </form>
                    </div>
                </nav>
            </div>
        </header>
        <div style="height: 55px;"></div>
    </div>
</template>
<script>
    import currencySelect from '../currency/CurrencySelect'
    import cart from '../cart/Cart'

    export default {
        name: "vue_header",
        props: ['title'],
        components: {currencySelect, cart},
    }
</script>
<style lang="css" scoped>
    .header-btn {
        border: 2px solid orange;
        margin-left: 10px;
    }

    .header-btn:hover {
        background-color: orange;
        color: white;
    }

    .fixed-top {
        background-color: white;
    }

    .navbar-brand:hover {
        color: orange;
    }
</style>

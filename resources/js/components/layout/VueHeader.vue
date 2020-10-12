<template>
    <div>
        <header class="header fixed-top">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <div class="row">
                        <router-link to="/" class="navbar-brand">{{title}}</router-link>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <form class="">
                                <currency-select></currency-select>
                                <router-link to="/login" class="btn btn-info">Login</router-link>
                                <cart></cart>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <div style="height: 20px;"></div>
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

</style>

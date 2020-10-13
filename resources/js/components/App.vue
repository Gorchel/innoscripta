<template>
    <div>
        <vue_header title="Pizza"></vue_header>
        <div class="container">
            <hr/>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    import vue_header from './layout/VueHeader'

    export default {
        name: "app",
        components: {vue_header},
        created: function () {
            this.$http.interceptors.response.use(undefined, function (err) {
                return new Promise(function (resolve, reject) {
                    if (err.status === 401 && err.config && !err.config.__isRetryRequest) {
                        this.$store.dispatch(logout)
                    }
                    throw err;
                });
            });
        }
    }
</script>

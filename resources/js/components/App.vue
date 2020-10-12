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
    }
</script>

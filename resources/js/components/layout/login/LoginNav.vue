<template>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <router-link to="/login" class="navbar-brand">Login</router-link>
            </li>
            <li class="nav-item">
                <router-link to="/registration" class="navbar-brand">Registration</router-link>
            </li>
        </ul>
    </div>
</template>
<script>
    export default {
        name: "login_nav",
    }
</script>
<style lang="css" scoped>
    .router-link-active {
        color:red;
    }
</style>

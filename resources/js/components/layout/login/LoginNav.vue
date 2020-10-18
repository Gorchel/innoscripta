<template>
    <div class="login-nav">
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
    .login-nav a {
        color: black;
        cursor: pointer;
    }

    .login-nav a.router-link-active {
        color:orange;
    }

    .login-nav ul {
        justify-content: center;
    }

    .login-nav {
        margin-bottom: 15px;
    }
</style>

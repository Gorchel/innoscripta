<template>
    <div>
        <LoginNav></LoginNav>
        <form @submit.prevent="register" id="login-form">
            <div class="col-6 offset-md-3">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="name" v-model="form.body.name" id="name" class="form-control" placeholder="name" required="required">
                    <span class="text-center errors">{{ form.errors.name }}</span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" v-model="form.body.email" id="email" class="form-control" placeholder="email" required="required">
                    <span class="text-center errors">{{ form.errors.email }}</span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" v-model="form.body.password" class="form-control" id="password" placeholder="password" required="required">
                    <span class="text-center errors">{{ form.errors.password }}</span>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Password</label>
                    <input type="password" v-model="form.body.password_confirmation" class="form-control" id="password_confirmation" placeholder="password_confirmation" required="required">
                    <span class="text-center errors">{{ form.errors.password_confirmation }}</span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn login-btn" value="Submit">
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import LoginNav from '../layout/login/LoginNav'

    export default {
        name: 'registration',
        components: {LoginNav},
        data() {
            return {
                form: {
                    body: {
                        name: '',
                        email: '',
                        password: '',
                        password_confirmation: '',
                    },
                    errors: '',
                }
            }
        },
        methods: {
            errors(res) {
                this.form.errors = Object.fromEntries(res.data.errors.map(item => [item.field, item.msg]));
            },
            register: function () {
                let data = this.form.body,
                    _this = this;

                this.form.errors = {};

                this.$store.dispatch('register', data)
                    .then(() => this.$router.push('/'))
                    .catch(function(err) {
                        _this.form.errors = err.response.data.errors;
                        console.log(err.response)
                    });
            }
        },
    }
</script>
<style>
    @import '../../../sass/login/login.css';
</style>

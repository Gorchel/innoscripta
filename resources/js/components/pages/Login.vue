<template>
    <div>
        <LoginNav></LoginNav>
        <form @submit.prevent="login">
            <div class="col-6 offset-md-3">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" v-model="form.body.email" id="email" class="form-control" placeholder="email" required="required">
                    <div>{{ form.errors.email }}</div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" v-model="form.body.password" class="form-control" id="password" placeholder="password" required="required">
                    <div>{{ form.errors.password }}</div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Submit">
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import LoginNav from '../layout/login/LoginNav'

    export default {
        name: 'login',
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
                    errors: {},
                }
            }
        },
        methods: {
            login: function () {
                let data = this.form.body;

                this.$store.dispatch('login', data)
                    .then(() => this.$router.push('/'))
                    .catch(err => console.log(err))
            }
        }
    }
</script>

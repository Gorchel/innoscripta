<template>
    <div>
        <LoginNav></LoginNav>
        <form @submit.prevent="register">
            <div class="col-6 offset-md-3">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="name" v-model="form.body.name" id="name" class="form-control" placeholder="name" required="required">
                    <div>{{ form.errors.name }}</div>
                </div>
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
                    <label for="password_confirmation">Password</label>
                    <input type="password" v-model="form.body.password_confirmation" class="form-control" id="password_confirmation" placeholder="password_confirmation" required="required">
                    <div>{{ form.errors.password_confirmation }}</div>
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
                    errors: {},
                }
            }
        },
        methods: {
            errors(res) {
                this.form.errors = Object.fromEntries(res.data.errors.map(item => [item.field, item.msg]));
            },
            register: function () {
                let data = {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                };

                this.$store.dispatch('register', data)
                    .then(() => this.$router.push('/'))
                    .catch(err => console.log(err))
            }
        },
    }
</script>

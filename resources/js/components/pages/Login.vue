<template>
    <div>
        <LoginNav></LoginNav>
        <form action="/login" method="post">
            <div class="col-6 offset-md-3">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="email" required="required">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="password" required="required">
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
    }
</script>

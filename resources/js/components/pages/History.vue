<template>
    <div class="row">
        <div v-if="checkNotEmpty(historyList)" class="col-12">
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Дата</th>
                        <th>Тип доставки</th>
                        <th>Сумма</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="history in historyList">
                        <td>{{history.id}}</td>
                        <td>{{history.created_at}}</td>
                        <td>{{history.delivery_id}}</td>
                        <td>{{getTotalWithCurrency(history.total)}} {{$store.state.currency.sign}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-else>
            <p>No order history</p>
        </div>
    </div>
</template>

<script>
    import numeral from 'numeral';

    export default {
        name: 'history',
        data() {
            return {
                historyList: {},
            }
        },
        mounted() {
            this.getList();
        },
        methods: {
            getList() {
                var _this = this;
                axios({url: '/api/order/orderHistory', data: {}, method: 'POST' })
                    .then(resp => {
                        _this.historyList = resp.data.data;
                        // this.$store.state.cart = {};
                        // const token = resp.data.access_token
                        // const user = resp.data.user
                        // localStorage.setItem('token', token)
                        // axios.defaults.headers.common['Authorization'] = token
                        // commit('auth_success', token, user)
                        // resolve(resp)
                    })
                    .catch(err => {
                        reject(err)
                    })
            },
            getTotalWithCurrency(total)
            {
                return numeral(total * this.$store.state.currency.currency).format('0.00');
            },
            checkNotEmpty(object) {
                return !_.isEmpty(object);
            },
        }
    }
</script>
<style>
    .table td, table th {
        border-color: orange !important;
    }

    .table th {
        font-weight: 500;
    }
</style>

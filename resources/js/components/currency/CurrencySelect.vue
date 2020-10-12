<template>
    <select name="currency" id="currency-list"
            @change="changeCurrency($event)"
            v-model="$store.state.currency.id"
    >
        <option v-for="(currency_item, index) in list"
                v-bind:value="index"

        >{{currency_item.name}}</option>
    </select>
</template>
<script>
    export default {
        name: "currency_select",
        data() {
            return {
                list: {},
            }
        },
        mounted() {
            this.getList();
        },
        methods: {
            getList() {
                //Get currency list from config
                axios.get("/api/currency/list").then(response => {
                    this.list = response.data;

                    if (_.isEmpty(this.$store.state.currency)) {
                        this.setCurrency(this.list[1]);
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            changeCurrency(event) {
                this.setCurrency(this.list[event.target.value]);
            },
            setCurrency(currency) {
                this.$store.commit('setCurrency', currency);
                this.$localStorage.set('currency', JSON.stringify(currency));
            }
        },

    }
</script>
<style lang="css" scoped>

</style>


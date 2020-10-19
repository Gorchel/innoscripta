<template>
    <div class="row">
        <good
            v-for="item in list.data"
            :key="item.id"
            :good="item"
        ></good>
    </div>
</template>

<script>
    import Good from '../good/Good';

    export default {
        name: 'home',
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
                var type = this.$route.query.type;

                if (_.isEmpty(type)) {
                    type = 'pizza';
                }

                //Get currency list from config
                axios.get("/api/good/list/" + type).then(response => {
                    this.list = response.data;
                }).catch(error => {
                    console.log(error.response);
                });
            },
        },
        components: {Good},
    }
</script>

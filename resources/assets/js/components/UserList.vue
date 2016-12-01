<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">Users</div>
            <div class="panel-body">
                <div class="list-group">
                    <a v-for="user in users" type="button" class="list-group-item" href="#">{{ user.name }}</a>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .list-group .list-group-item {
        border: none;
    }
</style>
<script>
    export default{
        data(){
            return{
                msg:'hello vue',
                users: []
            }
        },
        created(){
            this.fetchData();

        },
        methods: {
            fetchData: function () {
                self = this;
                this.$http.get('/users').then((response) => {
                    self.users = response.body;
                });
            }
        }
    }
</script>

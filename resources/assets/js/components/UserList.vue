<template>
    <div>
            <h3>Users</h3>
            <div class="list-group">
                <a v-for="user in users" type="button" class="list-group-item" href="#">{{ user.name }}</a>
            </div>
    </div>
</template>
<style>

</style>
<script>
    export default {
        data() {
            return {
                users: []
            }
        },
        created(){
            this.fetchData();
        },
        methods: {
            fetchData: function () {
                this.$http.get('/api/user').then((response) => {
                    this.users = response.body;
                });
            }
        }
    }
</script>

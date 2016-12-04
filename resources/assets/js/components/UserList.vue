<template>
    <div>
            <h3>Users</h3>
            <div class="list-group">
                <a v-for="user in users" @click="toggleSelect(user)" type="button" class="list-group-item" :class="{ active: selectedUsers.indexOf(user) !== -1 }" href="#">{{ user.name }}</a>
            </div>
    </div>
</template>
<style>

</style>
<script>
    export default {
        data() {
            return {
                users: [],
                selectedUsers: []
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
            },
            toggleSelect: function(user) {
                var index = this.selectedUsers.indexOf(user);
                if (index === -1) {
                    this.selectedUsers.push(user);
                } else {
                    this.selectedUsers.splice(index, 1);
                }
            }
        }
    }
</script>

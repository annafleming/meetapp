<template>
    <div class="columns">
        <div class="column is-one-quarter">
            <user-list :users="users"></user-list>
        </div>

        <div class="column">
            <meeting-list :users="users"></meeting-list>
        </div>
    </div>
</template>
<script>
    import MeetingList from './MeetingList.vue';
    import UserList from './UserList.vue';

    export default{
        data(){
            return{
                users: [],
            }
        },
        created(){
            this.fetchData();
        },
        methods: {
            fetchData: function () {
                self = this;
                axios.get('/api/user').then((response) => {
                    self.users = response.data;
                });
            },
        },
        components:{
            MeetingList,
            UserList
        }
    }
</script>

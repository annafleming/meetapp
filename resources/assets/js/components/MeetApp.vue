<template>
    <div>
        <div>
            <meeting-list :users="users"></meeting-list>
        </div>

        <div>
            <user-list :users="users"></user-list>
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
                this.$http.get('/api/user').then((response) => {
                    self.users = response.body;
                });
            },
        },
        components:{
            MeetingList,
            UserList
        }
    }
</script>

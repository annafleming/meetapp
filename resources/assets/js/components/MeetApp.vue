<template>
    <div class="row">
        <div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4">
            <meeting-list :users="users"></meeting-list>
        </div>

        <div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8 col-sm-offset-0">
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

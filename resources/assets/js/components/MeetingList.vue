<template>
    <div>
        <h3><i class="fa fa-calendar"></i> Meetings <button v-on:click="addNewMeeting()">+ Schedule New Meeting</button></h3>
        <div>
            <meeting :meeting="newMeeting" :users="users"  v-if="newMeeting"></meeting>
        </div>
        <div v-for="meeting in meetings">
            <meeting :meeting="meeting" :users="users"></meeting>
        </div>
        <div class="text-center">
            <a v-if="!showingAll && total > limit" v-on:click="fetchData(0)" href="#">Show All Meetings</a>
            <a v-if="showingAll" v-on:click="fetchData(limit)"  href="#">Show Last {{ limit }} Meetings</a>
        </div>
    </div>
</template>
<script>
    import Meeting from './Meeting.vue';
    export default {
        props: {
            users: Array
        },
        components: { Meeting },
        data(){
            return{
                meetings: [],
                showingAll: false,
                meetingTemplate: null,
                newMeeting: null,
                limit: 5,
                total: 0,

            }
        },
        created() {
            this.fetchData(this.limit);
        },
        methods: {
            fetchData: function (limit) {
                if (limit == null){ var limit = 0; }
                if (limit == 0){ this.showingAll = true; } else { this.showingAll = false; }
                axios.get('/api/meeting?limit=' + limit).then((response) => {
                    this.meetings = response.data.meetings;
                    this.total = response.data.total;
                });
            },
            addNewMeeting: function () {
                if (this.meetingTemplate){
                    this.newMeeting = Vue.util.extend({},this.meetingTemplate);
                }
                self = this;
                if (!this.meetingTemplate){
                    axios.get('/api/meeting/create').then((response) => {
                        self.meetingTemplate = response.body;
                        self.newMeeting = Vue.util.extend({},self.meetingTemplate);
                    });
                }
            },
            hideNewMeeting : function (refresh = false) {
                this.newMeeting = null;
                if (refresh)
                    this.fetchData(this.limit);
            }
        }
    }
</script>

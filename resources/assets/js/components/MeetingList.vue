<template>
    <div>
            <h3>Meetings <button class="pull-right btn btn-primary btn-xs">+ Schedule New Meeting</button></h3>
            <div v-for="meeting in meetings">
                <meeting :meeting="meeting"></meeting>
            </div>
        <div class="text-center">
            <a v-if="!showingAll" v-on:click="fetchData(0)" class="btn btn-default" href="#">Show All Meetings</a>
            <a v-if="showingAll" v-on:click="fetchData(5)" class="btn btn-default" href="#">Show Last 5 Meetings</a>
        </div>
    </div>
</template>
<script>
    import Meeting from './Meeting.vue';
    export default {
        components: { Meeting },
        data(){
            return{
                meetings: [],
                showingAll: false
            }
        },
        created() {
            this.fetchData(5);
        },
        methods: {
            fetchData: function (limit) {
                if (limit == null){ var limit = 0; }
                if (limit == 0){ this.showingAll = true; } else { this.showingAll = false; }
                this.$http.get('/api/meetings?limit=' + limit).then((response) => {
                    this.meetings = response.body;
                });
            }
        }
    }
</script>

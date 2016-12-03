<template>
    <div>
            <h3>Meetings <button class="pull-right btn btn-primary btn-xs">+ Schedule New Meeting</button></h3>
            <div v-for="meeting in meetings">
                <meeting :meeting="meeting"></meeting>
            </div>
    </div>
</template>
<script>
    import Meeting from './Meeting.vue';
    export default {
        components: { Meeting },
        data(){
            return{
                meetings: []
            }
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData: function () {
                this.$http.get('/api/meetings').then((response) => {
                    this.meetings = response.body;
                });
            }
        }
    }
</script>

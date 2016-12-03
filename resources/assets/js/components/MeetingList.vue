<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">Meetings <button class="pull-right btn btn-primary btn-xs">+ Schedule New Meeting</button></div>
            <div class="panel-body">
                <div v-for="meeting in meetings">
                    <meeting :meeting="meeting"></meeting>
                </div>
            </div>
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

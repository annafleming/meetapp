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


    export default{
        components: { Meeting },
        data(){
            return{
                meetings: [
                    {username: 'Adam Williams', date: '10 Dec 2016'},
                    {username: 'Joshua Jones', date: '15 Nov 2016'},
                    {username: 'Everett Green', date: '3 Nov 2016'},
                ]
            }
        }
    }
</script>

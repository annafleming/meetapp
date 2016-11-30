<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">Meetings <button class="pull-right btn btn-primary btn-xs">+ Schedule New Meeting</button></div>
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="meeting in meetings">
                        <td>{{ meeting.title }}</td>
                        <td>{{ meeting.date }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return{
                meetings: [
                    {title: 'Future Meeting', date: '10 Dec 2016'},
                    {title: 'Meeting Title', date: '15 Nov 2016'},
                    {title: 'Another Meeting Title', date: '3 Nov 2016'},
                ]
            }
        }
    }
</script>

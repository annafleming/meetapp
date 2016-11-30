<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">Users</div>
            <div class="panel-body">
                <div class="list-group">
                    <a v-for="user in users" type="button" class="list-group-item" href="#">{{ user }}</a>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .list-group .list-group-item {
        border: none;
    }
</style>
<script>
    export default{
        data(){
            return{
                msg:'hello vue',
                users: ['Joshua Jones', 'Anna Fleming', 'David Angel']
            }
        }
    }
</script>

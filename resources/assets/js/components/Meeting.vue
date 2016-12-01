<template>
    <div>
        <div class="head">
            <a v-on:click="folded = false" v-show="folded">Show</a>
            <a v-on:click="folded = true" v-show="!folded">Hide</a>
            {{ meeting.date }} - {{ meeting.username}}</div>
        <div v-show="!folded" class="body"> Addition info</div>
    </div>
</template>
<style>
    .head {
        padding : 1em;
        background-color: #f5f8fa;
        margin-top: 0.5em;
    }
    a {
        cursor: pointer;
    }

    .body {
        border: 3px solid #f5f8fa;
        margin-bottom: 0.5em;
        padding : 1em;
    }
</style>
<script>

    export default{
        props: {
            meeting: Object,
        },

        data(){
            return {
                folded: true,
            }
        }
    }
</script>

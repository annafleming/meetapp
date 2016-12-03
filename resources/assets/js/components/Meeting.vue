<template>
    <div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title" v-on:click="folded = !folded">
                    {{ meeting.scheduled_at }}
                    <span class="pull-right" v-if="folded">Show</span>
                    <span class="pull-right" v-if="!folded">Hide</span>
                </h3>
            </div>
            <div class="panel-body" v-show="!folded">
                <p>Date: {{ meeting.scheduled_at }} Participants: {{ meeting.participants }}</p>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Agenda</h3>
                        </div>
                        <div class="panel-body">
                            {{ meeting.agenda }}
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Takeaways</h3>
                        </div>
                        <div class="panel-body">
                            {{ meeting.takeaways }}
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Notes</h3>
                        </div>
                        <div class="panel-body">
                            {{ meeting.notes }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .panel-heading { cursor: pointer; }
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

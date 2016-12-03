<template>
    <div>
        <form>
        <div class="panel panel-default">
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
                    <div class="form-group">
                    <label>Agenda</label>
                    <textarea class="form-control" rows="8">{{ meeting.agenda }}</textarea>
                    </div>

                    <div class="form-group">
                    <label>Takeaways</label>
                    <textarea class="form-control" rows="8">{{ meeting.takeaways }}</textarea>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea class="form-control" rows="20">{{ meeting.notes }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</template>
<style>
    .panel-heading { cursor: pointer; }
    .panel-body textarea { border: none; box-shadow: none; }
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

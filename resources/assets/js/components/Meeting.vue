<template>
    <div>
        <form>
        <div class="panel panel-default">
            <div class="list-group" >
                <a href="#" class="list-group-item" v-on:click="folded = !folded">
                    <span class="pull-right" v-if="folded">Show</span>
                    <span class="pull-right" v-if="!folded">Hide</span>
                    <h4 class="list-group-item-heading">{{ participants }}</h4>
                    <p class="list-group-item-text">{{ meeting.scheduled_at }}</p>
                </a>
            </div>
            <transition name="slide-fade">
            <div class="panel-body" v-show="!folded">
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
            </transition>
        </div>
        </form>
    </div>
</template>
<style>
    .panel-heading { cursor: pointer; }
    .panel-body { overflow: hidden; }
    .panel-body textarea { border: none; box-shadow: none; }

    .slide-fade-enter-active {
      transition: all .5s ease;
      max-height: 1000px;
    }
    .slide-fade-leave-active {
      transition: all .2s ease;
    }
    .slide-fade-enter, .slide-fade-leave-active {
      transform: translateY(-20px);
      opacity: 0;
      max-height: 0;
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
        },
        computed: {
            participants: function() {
                return this.meeting.users.map(function(user) {return user.name;}).join(', ');
            }
        }
    }
</script>

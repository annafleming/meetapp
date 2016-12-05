<template>
    <div>
        <form>
        <div class="panel panel-default">
            <div class="list-group" >
                <a href="#" class="list-group-item" v-on:click="folded = !folded" v-bind:class="{ active: !folded }">
                    <span class="pull-right" v-if="folded">Show</span>
                    <span class="pull-right" v-if="!folded">Hide</span>
                    <h4 class="list-group-item-heading">{{ participants }}</h4>
                    <p class="list-group-item-text">{{ meeting.scheduled_at }}</p>
                </a>
            </div>
            <transition name="slide-fade">
            <div class="panel-body" v-show="!folded">
                <div class="col-md-12">
                    <label>Participants</label>
                    <multiselect
                            :options="users"
                            :value="meeting.users"
                            :multiple="true"
                            :searchable="true"
                            :close-on-select="false"
                            :clear-on-select="false"
                            @input="updateSelected"
                            placeholder="Select participants"
                            label="name"
                            track-by="id"
                    ></multiselect>
                </div>
                <div class="col-md-4">
                    <div class="form-group" v-bind:class="{ changed: isChanged('agenda') }">
                    <label>Agenda</label>
                    <textarea class="form-control" rows="8" v-model="meeting.agenda"></textarea>
                    </div>

                    <div class="form-group" v-bind:class="{ changed: isChanged('takeaways') }">
                    <label>Takeaways</label>
                    <textarea class="form-control" rows="8" v-model="meeting.takeaways"></textarea>
                    </div>

                    <div class="form-group" v-bind:class="{ changed: isChanged('scheduled_at') }">
                        <label>Meeting Date</label>
                        <input class="form-control" type="date" v-model="meeting.scheduled_at">
                    </div>

                    <div class="form-group" v-bind:class="{ changed: isChanged('completed') }">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" v-model="meeting.completed"> Meeting Completed
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group" v-bind:class="{ changed: isChanged('notes') }">
                        <label>Notes</label>
                        <textarea class="form-control" rows="20" v-model="meeting.notes"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="pull-right btn btn-primary btn-s" v-on:click="saveMeeting()">Save</button>
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
    .form-group.changed label{
        color: darkred;
    }
</style>
<script>
    import Multiselect from 'vue-multiselect';
    export default{
        components: { Multiselect },
        props: {
            meeting: Object,
            users: Array
        },
        data(){
            return {
                folded: true,
                oldData : Object,
            }
        },
        created() {
            for (var key in this.meeting) {
                if (this.meeting[key] === null)
                    this.meeting[key] = '';
            }
            this.oldData = Vue.util.extend({},this.meeting);
        },
        computed: {
            participants: function() {
                return this.meeting.users.map(function(user) {return user.name;}).join(', ');
            },
        },
        methods: {
            saveMeeting: function () {
                self = this;
                this.$http.post('/api/meeting', self.meeting).then((response) => {
                    self.oldData = Vue.util.extend({},self.meeting);
                }, (response) => {
                });
            },
            isChanged: function (field) {
                if (this.oldData[field] !== 'undefined'){
                    return this.oldData[field] != this.meeting[field];
                }
            },
            updateSelected(value) {
               this.meeting.users = value;
            }
        }
    }
</script>

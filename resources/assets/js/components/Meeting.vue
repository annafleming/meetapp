<template>
    <div>
        <form>
        <div>
            <div>
                <a href="#" v-on:click="folded = !folded" :class="{ active: !folded }">
                    <span v-if="folded">Show</span>
                    <span v-if="!folded">Hide</span>
                    <h4>{{ participants || 'Add participants' }}</h4>
                    <p>{{ meeting.scheduled_at || 'Add meeting date' }}</p>
                </a>
            </div>
            <transition name="slide-fade">
            <div v-show="!folded">
                <div>

                    <div :class="{ changed: isChanged('scheduled_at') }">
                        <label><i class="fa fa-calendar-o"></i> Meeting Date</label>
                        <input type="date" v-model="meeting.scheduled_at">
                    </div>

                    <div :class="{ changed: isChanged('agenda') }">
                    <label><i class="fa fa-list-ol"></i> Agenda</label>
                    <textarea rows="8" v-model="meeting.agenda"></textarea>
                    </div>

                    <div :class="{ changed: isChanged('takeaways') }" v-if="meeting.id">
                    <label><i class="fa fa-list-ul"></i> Takeaways</label>
                    <textarea rows="8" v-model="meeting.takeaways"></textarea>
                    </div>
                </div>
                <div>

                    <div :class="{ changed: isChanged('users') }">
                        <label><i class="fa fa-user-plus"></i> Participants</label>
                        <multiselect
                                v-model="meeting.users"
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

                    <div :class="{ changed: isChanged('notes') }" v-if="meeting.id">
                        <label><i class="fa fa-pencil-square-o"></i> Notes</label>
                        <textarea rows="20" v-model="meeting.notes"></textarea>
                    </div>

                </div>
                <div>

                    <div>
                        <a v-on:click="cancel()">
                            <span v-show="!meeting.id">Cancel</span>
                        </a>
                        <a v-on:click="saveMeeting()">
                            <i v-show="isSaving" class="fa fa-circle-o-notch fa-spin"></i>
                            <span v-show="!isSaving">Save</span>
                        </a>
                    </div>
                    
                </div>
            </div>
            </transition>
        </div>
        </form>
    </div>
</template>
<style>
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
                isSaving: false
            }
        },
        created() {
            for (var key in this.meeting) {
                if (this.meeting[key] === null)
                    this.meeting[key] = '';
            }
            this.oldData = Vue.util.extend({},this.meeting);
            if (!this.meeting.id) {
                this.folded = false;
            }
        },
        computed: {
            participants: function() {
                return this.meeting.users.map(function(user) {return user.name;}).join(', ');
            },
        },
        methods: {
            saveMeeting: function () {
                this.isSaving = true;
                if (this.meeting.id)
                    this.updateMeeting();
                else
                    this.createMeeting();
            },
            updateMeeting: function () {
                self = this;
                this.$http.put('/api/meeting/'+self.meeting.id, self.meeting).then((response) => {
                    self.oldData = Vue.util.extend({},self.meeting);
                    self.isSaving = false;
                }, (response) => {
                });
            },
            createMeeting: function () {
                self = this;
                this.$http.post('/api/meeting', self.meeting).then((response) => {
                    self.$parent.hideNewMeeting(true);
                }, (response) => {
                });
            },
            isChanged: function (field) {
                if (this.oldData[field] !== 'undefined'){
                    return this.oldData[field] != this.meeting[field];
                }
            },
            updateSelected: function(value) {
               this.meeting.users = value;
            },
            cancel: function () {
                this.$parent.hideNewMeeting(false);
            }
        }
    }
</script>

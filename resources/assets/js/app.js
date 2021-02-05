require('./bootstrap');

import axios from 'axios'
import Vue from 'vue'
import VueRouter from 'vue-router';
import VueScrollbar from 'vue2-scrollbar';
import VueProgressBar from 'vue-progressbar';

if (process.env.MIX_LOCAL == false) {
  Vue.config.devtools = false;
  Vue.config.debug = false;
  Vue.config.silent = true;
}

const options = {
  color: '#f9cf28',
  failedColor: '#fb0b0b',
  thickness: '5px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
  },
  autoRevert: true,
  location: 'top',
  inverse: false
}

import Home from './pages/Home.vue';
import Support from './pages/Support.vue';

import {
  routes
} from './routes';

Vue.use(VueRouter);
Vue.use(VueProgressBar, options)



const router = new VueRouter({
  mode: 'history',
  routes
});

import ContentLayer from './components/Content.vue';

new Vue({
  el: '#main-app',
  components: {
    ContentLayer
  },
  router
});

if (document.getElementById("overchat")) {
const chatApp = new Vue({
  el: "#overchat",
  data: {
    messages: chat_messages,
    channels: chat_channels,
    dialogs: [],
    users_online: users_online,
    admins: null,
    channel_id: 1,
    lastmessage: null,
    msgs_count: 0,
    to_userid: 0,
    user: user,
    sort: 1,
    sound: false,
  },
  components: {
    'chat-input': require('./components/ChatInput.vue'),
    'chat-stats': require('./components/ChatStats.vue'),
    'chat-message': require('./components/ChatMessage.vue'),
    'chat-admins': require('./components/ChatAdmins.vue'),
    'chat-users': require('./components/ChatUsers.vue'),
    'chat-channels': require('./components/ChatChannels.vue'),
    'chat-dialogs': require('./components/ChatDialogs.vue'),
    VueScrollbar,
  },
  created() {
    this.$nextTick(function() {
      setTimeout(this.$refs.messagesscroll.scrollToY(999999), 300);
    });
    $("#maincount").html(0);
    this.lastmessage = this.messages[this.messages.length - 1];
    if (this.lastmessage.user.name.length > 15) {
      $(".author").html(this.lastmessage.created_at.substr(10, 6) + " " + this.lastmessage.user.name.substring(0, 13) + "..." + ": ");
    }
    else {
      $(".author").html(this.lastmessage.created_at.substr(10, 6) + " " + this.lastmessage.user.name + ": ");
    }

    if ((this.lastmessage.text.length + this.lastmessage.user.name.length) > 50) {
      $("#messagetext").html(this.lastmessage.text.substring(0, 18) + "...");
    }
    else {
      $("#messagetext").html(this.lastmessage.text);
    }
    this.admins = this.users_online.filter(user => user.role == 'administrator' || user.role == 'moderator');
    this.users_online = this.users_online.filter(user => user.role == 'user');
    this.sort == 0 ? this.sortUsers('name') : this.sortUsers('own_rank');
    Echo.channel("Stats")
      .listen(".update", (e) => {
        this.today = e.mixes_today;
        this.playing = e.playing_now;
        this.total = e.total_mixes;
        var new_users = e.users_online;
        this.admins = new_users.filter(user => user.role == 'administrator' || user.role == 'moderator');
        this.users_online = new_users.filter(user => user.role == 'user');
        this.sort == 0 ? this.sortUsers('name') : this.sortUsers('own_rank');
      });
    Echo.channel("Chat").listen(".add", (e) => {
        var msgs_count = $("#maincount").html();
        var isDialog = true;
        if (this.user && e.message.channel_id == null && this.to_userid != e.message.user_id && this.user.id != e.message.user_id && e.message.to_userid == this.user.id) {
          isDialog = false;
          if (this.dialogs.length != 0) {
            for (var i = 0; i < this.dialogs.length; i++) {
              if (this.dialogs[i]['id'] == e.message.user_id) {
                if (this.to_userid != e.message.user_id) {
                  this.msgs_count++;
                  this.dialogs[i]['newmessages']++;
                }
                this.isDialog = true;
              }
              isDialog = true;
            }
          } else {
            this.isDialog = false;
          }
          if (this.isDialog == false) {
            this.newDialog(e.message.user_id, e.message.user.name, 1, true);
          }
        }
        if (e.message.channel_id == 1) {
          if (this.channel_id == 0) {
            this.msgs_count++;
          }
        }
        $("#maincount").html(this.msgs_count);
        if (isDialog) {
          this.$set(this.messages, this.messages.length, e.message);
        }
        if (e.message.channel_id == 1) {
          this.lastmessage = e.message;
          if (this.lastmessage.user.name.length > 15) {
            $(".author").html(this.lastmessage.created_at.substr(10, 6) + " " + this.lastmessage.user.name.substring(0, 13) + "..." + ": ");
          }
          else {
            $(".author").html(this.lastmessage.created_at.substr(10, 6) + " " + this.lastmessage.user.name + ": ");
          }

          if ((this.lastmessage.text.length + this.lastmessage.user.name.length) > 50) {
            $("#messagetext").html(this.lastmessage.text.substring(0, 18) + "...");
          }
          else {
            $("#messagetext").html(this.lastmessage.text);
          }
        }
        if (parseFloat($('.scrollbar.vue-scrollbar-transition').get(0).style.height) + parseFloat($('.scrollbar.vue-scrollbar-transition').get(0).style.top) > 95) {
          this.$nextTick(function() {
            setTimeout(this.$refs.messagesscroll.scrollToY(999999), 300);
          });
        }
        if (this.sound) {
          var mus = document.getElementById('messageplayer');
          mus.volume = 0.5;
          if (typeof mus.play !== "undefined") {
            mus.play();
          }
        }
      })
      .listen(".delete", (e) => {
        var index = this.messages.findIndex(function(el) {
          return el.id == e.message
        });
        this.$delete(this.messages, index);
      });
  },
  methods: {
    toggleSound: function(e) {
      e.preventDefault();
      this.$set(this, 'sound', !this.sound);
    },
    sortUsers(param, event) {
      if (event) {
        event.preventDefault();
      }
      for (var i = 0; i < this.users_online.length-1; i++)
       { for (var j = 0; j < this.users_online.length-1-i; j++)
          { if (param == 'exp') {
             if (this.users_online[j+1]['csgo']['exp'] > this.users_online[j]['csgo']['exp'])
              { var t = this.users_online[j+1];
                this.sort = 1;
                this.$set(this.users_online, j+1, this.users_online[j]);
                this.$set(this.users_online, j, t);
              }
            }
            else
            {
              if (this.users_online[j+1][param] < this.users_online[j][param])
              { var t = this.users_online[j+1];
                this.$set(this.users_online, j+1, this.users_online[j]);
                this.$set(this.users_online, j, t);
                this.sort = 0;
              }
            }
          }
       }
    },
    changeChannel: function(id) {
      this.to_userid = 0;
      this.channel_id = id;
      this.msgs_count = 0;
      for (var i = 0; i < this.dialogs.length; i++) {
        this.msgs_count += this.dialogs[i]['newmessages'];
      }
      $("#maincount").html(this.msgs_count);
      this.$nextTick(function() {
        setTimeout(this.$refs.messagesscroll.scrollToY(999999), 300);
      });
    },
    changeDialog: function(id, event) {
      if (event) {
        event.preventDefault();
      }
      this.channel_id = 0;
      this.to_userid = id;
      $("#chat_input").focus();
      for (var i = 0; i < this.dialogs.length; i++) {
        if (this.dialogs[i]['id'] == this.to_userid) {
          this.msgs_count -= this.dialogs[i]['newmessages'];
          $("#maincount").html(this.msgs_count);
          this.dialogs[i]['newmessages'] = 0;
        }
      }
      this.$nextTick(function() {
        setTimeout(this.$refs.messagesscroll.scrollToY(999999), 300);
      });
    },
    newDialog: function(id, name, newmessages, isDialog = false) {
      if (id != -1) {
        this.dialogs.push({
          id: id,
          title: name,
          newmessages: newmessages
        });
      } else {
        this.dialogs.push({
          id: -1,
          title: "SYSTEM",
          newmessages: newmessages
        });
      }
        var temp = this;
        $.post("/chat/newdialog", {
          to_userid: id,
        }, function(data) {
          data.forEach(function(message) {
            temp.messages.push(message);
          });
          temp.$nextTick(function() {
            setTimeout(temp.$refs.messagesscroll.scrollToY(999999), 300);
          });
        });
      if (isDialog == false) {
        this.changeDialog(id);
      }
      else {
        this.msgs_count++;
        $("#maincount").html(this.msgs_count);
      }
    },
    deleteDialog: function(index, id) {
      var toChannel = false;
      if (this.dialogs[index]['id'] == this.to_userid) {
        toChannel = true;
      }
      this.msgs_count -= this.dialogs[index]['newmessages'];
      $("#maincount").html(this.msgs_count);
      this.$delete(this.dialogs, index);
      var temp = this;
      temp.messages = temp.messages.filter(function(message) {
        return !(message['to_userid'] == id || (message['to_userid'] == temp.user.id && message['user_id'] == id))
      });
      if (toChannel) {
          this.changeChannel(1);
      }
    }
  },
  computed: {

  }
});
}

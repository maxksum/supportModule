<template>
<div id="support_app">
<ticket-show v-if="show_ticket" :ticket="ticket" :show="showAll" :addMessage="addMessage" :showform="closeFormShow" :closeticket="changeTicketState" :user="user" :findusers="searchusers" :searchusers="toSearchUsers" :dateformat="dateCreate" :addadminmessage="addAdminMessage" :voteforcheats="voteForCheats" :adding="addNewFile" :adduser="addUserToParticipants" :closestate="setCloseState"></ticket-show>
<tickets-list v-if="tickets_list" :tickets="tickets" :show="showTicket" :showform="createFormShow" :sort="sortTickets" :create="createTicket" :change="changeCategory" :sortchange="sortChange" :adding="addNewFile" :filecount="filecount" :deletefiles="deleteFiles" :sortvalue="sort" :participants="participants" :searchusers="toSearchUsers" :findusers="searchusers" :adduser="addUserToParticipants" :close="createFormClose" :user="user" :sortchangeforadmin="sortChangeForAdmin" :searchrequest="searchrequest" :searchtickets="searchTickets" :page="page" :toshow="toshow" :pages="totalpages" :changepage="changePage"></tickets-list>
</div>
</template>

<script>
import lodash from 'lodash';
import VueScrollbar from 'vue2-scrollbar';
export default {
data() {
  return {
    tickets: tickets.data,
    ticket: null,
    show_ticket: false,
    sort: "all",
    tickets_list: true,
    category: 1,
    user: user,
    complaintuser: null,
    filecount: 0,
    searchusers: null,
    participants: [],
    searchrequest: "",
    totalpages: 0,
    toshow: true,
    page: 1,
    close_state: 0,
  };
},
components: {
  'tickets-list': require('../components/support/TicketsList.vue'),
  'ticket-show': require('../components/support/Ticket.vue'),
  VueScrollbar,
},
watch: {
  $route (to, from){
    this.routeCheck();
    this.sort = 'created_at';
  }
},
created: function() {
  this.totalpages = tickets.last_page;
  this.page = tickets.current_page;
  this.routeCheck();
  if (this.tickets.length == 0) {
    this.toshow = false;
  }
  Echo.channel("Ticket")
    .listen(".ticket", (e) => {
      if ((e.ticket.participants.findIndex(part => part.id == this.user.id) !== -1) || (this.user.role == 'administrator') && (e.ticket.user_id !== this.user.id)) {
        if (response.data.error == null) {
            this.changePage(this.page);
        }
      }
  })
    .listen(".message", (e) => {
      var ticket = this.tickets.filter(t => t.id == e.ticket.ticket_id)[0];
      if ((ticket !== null) && (e.ticket.author_id !== this.user.id)) {
        this.tickets[ticket.id].newmessages++;
        this.$set(ticket.messages, ticket.messages.length, e.ticket);
      }
      if ((ticket !== null) && (e.ticket.author_id == this.user.id)) {
        this.ticket.newmessages = 0;
      }
  })
    .listen(".part", (e) => {
      var ticket = this.tickets.filter(t => t.id == e.ticket.ticket_id)[0];
      if ((ticket !== null) && (this.ticket.participants.filter(participant =>
        e.ticket.id == participant.id
      )[0] == null)) {
        this.$set(ticket.participants, ticket.participants.length, e.ticket);
        this.searchusers = null;
        this.participants = [];
      }
  })
    .listen(".adminmessage", (e) => {
      var ticket = this.tickets.filter(t => t.id == e.ticket.ticket_id)[0];
      if ((ticket !== null) && (e.ticket.admin_id !== this.user.id) && (this.user.role == 'administrator')) {
        this.$set(ticket.adminmessages, ticket.adminmessages.length, e.ticket);
      }
  })
    .listen(".log", (e) => {
      var ticket = this.tickets.filter(t => t.id == e.ticket.ticket_id)[0];
      if ((ticket !== null) && (e.ticket.user !== this.user.id) && (this.user.role == 'administrator'))
        this.$set(this.ticket.logs, this.ticket.logs.length, e.ticket);
  })
    .listen(".state", (e) => {
      var ticket = this.tickets.filter(t => t.id == e.ticket.id)[0];
      if ((ticket !== null) && (e.ticket.admin_id !== this.user.id)) {
        this.ticket.state = e.ticket.state;
      }
  });
},
methods: {
  routeCheck: function() {
    var showticket = false;
    if (typeof(this.$route.params.id) != 'undefined') {
        axios.post('/support/checkroute', {
          params: {
            id: this.$route.params.id,
          }
        })
          .then(response => {
            if (response.data.length == 1) {
              this.showTicket(this.$route.params.id);
              showticket = true;
            } else {
              this.$router.push({ name: "Support"})
            }
          });
        }
    if (showticket == false) {
      this.showAll();
    }
  },
  changePage: function(pagenumber) {
    this.page = pagenumber;
    axios.post("/support?tickets_page=" + pagenumber, {
      params: {
        tickets_page: pagenumber,
        sort: this.sort,
        searchrequest: this.searchrequest,
      }
    })
      .then(response => {
        if (response.data.length !== 0) {
          this.totalpages = response.data.last_page;
          this.tickets = response.data.data;
        }
      });
  },
  showTicket: function(id) {
    var temp = this;
    temp.ticket = temp.tickets.filter(ticket =>
      ticket.id == id
    )[0];
    this.show_ticket = true;
    this.tickets_list = false;
    this.create_ticket = false;
  },
  toSearchUsers: lodash.debounce(
  function(e) {
  var vm = this;
    axios.post('/support/searchusers', {
      params: {
        searchusers: e.target.value,
      }
    })
      .then(response => {
        this.searchusers = response.data;
      });
  }, 10),
  sortChange: function() {
    this.page = 1
    this.sort = $('#sortdropdown').val();
    axios.post('/support/', {
      params: {
        sort: this.sort,
      }
    })
    .then(response => {
      this.tickets = response.data.data;
      this.totalpages = response.data.last_page;
    });
  },
  sortChangeForAdmin: function(value) {
    this.sort = value;
    this.page = 1;
    this.changePage(1);
    axios.post('/support/', {
      params: {
        sort: this.sort,
        pagenumber: this.page,
        searchrequest: this.searchrequest,
      }
    })
    .then(response => {
        this.tickets = response.data.data;
        this.totalpages = response.data.last_page;
        $("input[name='searchticket']").val('');
    });
  },
  deleteFiles: function() {
    $('input#file').val('');
    $('input#fileformessage').val('');
    $('input#fileformessageadmin').val('');
    this.filecount = 0;
  },
  addUserToParticipants: function(id) {
    var searchuser = this.searchusers.filter(searchuser =>
      searchuser.id == id
    )[0];
    if (this.participants.filter(participant =>
      participant.id == id
    )[0] == null) {
      if (id != this.user.id) {
        if (this.show_ticket) {
          if (this.ticket.participants.filter(participant =>
            participant.id == id
          )[0] == null) {
            axios.post('/support/addtoparticipants', {
              params: {
                ticket_id: this.ticket.id,
                user_id: searchuser.id,
              }
            });
            this.searchusers = null;
          }
        } else {
          this.participants.push(searchuser);
          this.searchusers = null;
        }
      }
    }
  },
  addNewFile: function(e) {
    this.filecount = e.target.files.length;
  },
  setCloseState: function(value) {
      this.close_state = value;
  },
  changeTicketState: function(id) {
    var speedrating = $('#speed').starRating('getRating');
    var qualityrating = $('#quality').starRating('getRating');
    var option = $('#rateadministration').val();
    var comment = $("textarea[name='problem']").val();
    var state = this.close_state;
    axios.post('/support/changestate', {
      params: {
        speedrating: speedrating,
        qualityrating: qualityrating,
        option: option,
        ticket_id: id,
        comment: comment,
        state: state,
      }
    });
  },
  searchTickets: function() {
    this.searchrequest = $("input[name='searchticket']").val();
    axios.post('/support/', {
      params: {
        searchrequest: this.searchrequest,
        sort: this.sort,
      }
    })
    .then(response => {
      this.tickets = response.data.data;
      this.totalpages = response.data.last_page;
    });
    this.changePage(1);
  },
  showAll: function() {
    this.show_ticket = false;
    this.tickets_list = true;
    this.create_ticket = false;
    this.ticket = null;
    this.close_ticket = 0;
  },
  dateCreate: function(date) {
    var t = date.split(/[- :]/);
    var str = t[2] + "." + t[1] + "." + t[0] + " - " + t[3] + ":" + t[4];
    return str;
  },
  createFormShow: function(index) {
    this.create_ticket = index;
  },
  createFormClose: function() {
    this.searchusers = null;
    this.participants = [];
  },
  closeFormShow: function(index) {
    this.close_ticket = index;
  },
  changeCategory: function(value) {
    this.category = value;
    this.searchusers = null;
  },
  addMessage: function() {
    if (this.user.role == "administrator") {
      if ($.trim($("#messageforadmin").val()).length > 0) {
        axios.post('/support/addmessage', {
          params: {
            ticket_id: this.ticket.id,
            text: $("#messageforadmin").val(),
          }
        })
        .then(response => {
          this.$set(this.ticket.messages, this.ticket.messages.length, response.data);
          this.handleFileUpload(response.data.id);
        });

        $("#messageforadmin").val("");
      }
    } else {
      if ($.trim($("#message").val()).length > 0) {
        axios.post('/support/addmessage', {
          params: {
            ticket_id: this.ticket.id,
            text: $("#message").val(),
          }
        })
        .then(response => {
          this.$set(this.ticket.messages, this.ticket.messages.length, response.data);
          this.handleFileUpload(response.data.id);
        });
        $("#message").val("");
      }
    }
  },
  addAdminMessage: function(id) {
    axios.post('/support/addadminmessage', {
      params: {
        ticket_id: id,
        text: $("#adminmessage").val(),
      }
    })
    .then(response => {
        this.$set(this.ticket.adminmessages, this.ticket.adminmessages.length, response.data);
    });
    $("#adminmessage").val("");
  },
  voteForCheats: function(value, id) {
    axios.post('/support/voteforcheats', {
      params: {
        vote: value,
        ticket: id,
      }
    })
    .then(response => {
        this.$set(this.ticket.votes, this.ticket.votes.length, response.data);
    });
    if (value == 0) {
      this.ticket.novotes++;
      this.ticket.voted = 1;
    } else {
      this.ticket.yesvotes++;
      this.ticket.voted = 2;
    }
  },
  sortTickets: function() {
    var param = this.sort;
    for (var i = 0; i < this.tickets.length-1; i++)
    {
      for (var j = 0; j < this.tickets.length-1-i; j++)
      {
        if (param == "created_at" || param == "all") {
          if (this.tickets[j+1].messages[this.tickets[j+1].messages.length - 1].created_at > this.tickets[j].messages[this.tickets[j].messages.length - 1].created_at)
          {
            var t = this.tickets[j+1];
            this.$set(this.tickets, j+1, this.tickets[j]);
            this.$set(this.tickets, j, t);
            this.sort = param;
          }
        }
      }
    }
  },
  handleFileUpload: async function(message_id) {
    if (this.show_ticket) {
      if (this.user.role == 'administrator') {
        var imagefile = document.querySelector('#fileformessageadmin');
      } else {
        var imagefile = document.querySelector('#fileformessage');
      }
    } else {
      var imagefile = document.querySelector('#file');
    }
    if (typeof imagefile.files != "undefined") {
      var files = imagefile.files;
      for (var i = 0; i < files.length; i++) {
        var formData = new FormData();
        formData.append("image", imagefile.files[i]);
        var res = await axios.post('/support/upload_file', formData, {
          timeout: 8000,
          headers: {
            'Content-Type': 'multipart/form-data'
          },
          params: {
              message_id: message_id,
            }
        })
        .then(response => {
          this.setImageToMessage(response.data, message_id);
        });
      }
      this.deleteFiles();
    }
  },
  setImageToMessage: function(image, message_id) {
    if (this.show_ticket) {
      var img = this.ticket.messages.filter(msg =>
        msg.id == message_id
      )[0];
    } else {
      var img = this.tickets[0].messages.filter(msg =>
        msg.id == message_id
      )[0];
    }
    img.images.push(image);
  },
  createTicket: function() {
    var category = this.category;
    var complete = false;
    switch (category) {
      case 1:
      {
        if ($.trim($("input[name='problem1']").val()).length > 0) {
          var problem = $("input[name='problem1']").val();
          var participants = new Array();
          for(var i = 0; i < this.participants.length; i++) {
            participants.push(this.participants[i].id)
          }
          if ($.trim($("textarea[name='problemdesc1']").val()).length > 0) {
            complete = true;
            var desc = $("textarea[name='problemdesc1']").val();
          }
        }
        break;
      }
      case 2:
      {
        if ($.trim($("input[name='problem2']").val()).length > 0) {
          var problem = $("input[name='problem2']").val();
          var participants = new Array();
          for(var i = 0; i < this.participants.length; i++) {
            participants.push(this.participants[i].id)
          }
          var times = new Array();
          var timecomments = new Array();
          times = $("input[name='time']")
                .map(function(){return $(this).val();}).get();
          timecomments = $("input[name='timecomment']")
                .map(function(){return $(this).val();}).get();
          if (($.trim($("input[name='gamenumber']").val()).length > 0) && ($.trim($("input[name='cheatplayer']").val()).length > 0)) {
            complete = true;
            var gamenumber = $("input[name='gamenumber']").val();
            var cheatplayer = $("input[name='cheatplayer']").val();
          }
          $("#input[name='problem2']").val('');
        }
        break;
      }
      case 3:
      {
        if ($.trim($("input[name='problem3']").val()).length > 0) {
          var problem = $("input[name='problem3']").val();
          var participants = new Array();
          for(var i = 0; i < this.participants.length; i++) {
            participants.push(this.participants[i].id)
          }
          if ($.trim($("textarea[name='problemdesc3']").val()).length > 0) {
            complete = true;
            var desc = $("textarea[name='problemdesc3']").val();
          }
        }
        break;
      }
      case 4:
      {
        if ($.trim($("input[name='problem4']").val()).length > 0) {
          var problem = $("input[name='problem4']").val();
          var participants = new Array();
          for(var i = 0; i < this.participants.length; i++) {
            participants.push(this.participants[i].id)
          }
          if ($.trim($("textarea[name='problemdesc4']").val()).length > 0) {
            complete = true;
            var desc = $("textarea[name='problemdesc4']").val();
          }
        }
        break;
      }
      case 5:
      {
        if ($.trim($("input[name='problem5']").val()).length > 0) {
          var problem = $("input[name='problem5']").val();
          var participants = new Array();
          for(var i = 0; i < this.participants.length; i++) {
            participants.push(this.participants[i].id)
          }
          if (($.trim($("textarea[name='problemdesc5']").val()).length > 0) && ($.trim($("input[name='complaint5']").val()).length > 0)) {
            var desc = $("textarea[name='problemdesc5']").val();
            var complaint = $("input[name='complaint5']").val();
            complete = true;
          }
        }
        break;
      }
      case 6:
      {
        if ($.trim($("input[name='problem6']").val()).length > 0) {
          var problem = $("input[name='problem6']").val();
          var participants = new Array();
          for(var i = 0; i < this.participants.length; i++) {
            participants.push(this.participants[i].id)
          }
          if (($.trim($("textarea[name='problemdesc6']").val()).length > 0) && ($.trim($("input[name='complaint6']").val()).length > 0)) {
            var desc = $("textarea[name='problemdesc6']").val();
            var complaint = $("input[name='complaint6']").val();
            complete = true;
          }
        }
        break;
      }
      case 7:
      {
        if ($.trim($("input[name='problem7']").val()).length > 0) {
          var problem = $("input[name='problem7']").val();
          var participants = new Array();
          for(var i = 0; i < this.participants.length; i++) {
            participants.push(this.participants[i].id)
          }
          if ($.trim($("textarea[name='problemdesc7']").val()).length > 0) {
            complete = true;
            var desc = $("textarea[name='problemdesc7']").val();
          }
        }
        break;
      }
    }
    if (complete) {
      axios.post('/support/addticket', {
      headers: {
        'Content-Type': 'multipart/form-data'
      },
        params: {
            category: category,
            problem: problem,
            desc: desc,
            participants: participants,
            complaint: complaint,
            times: times,
            timecomments: timecomments,
            cheatplayer: cheatplayer,
            gamenumber: gamenumber,
          }
        })
        .then(response => {
          if (response.data.error == null) {
            if (response.data.user_id == this.user.id) {
              this.handleFileUpload(response.data.messages[response.data.messages.length-1].id);
              this.changePage(this.page);
            }
          }
        });
        this.searchusers = null;
        this.participants = [];
      }
  }
}
}
</script>

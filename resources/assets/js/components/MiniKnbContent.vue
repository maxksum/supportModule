<template lang="html">
  <div class="minigames__coin-wrap-third" v-if="!inGame">

    <div class="minigames__coin">

      <div class="minigames__coin-left">
        <div class="minigames__coin-left-top">
          <span>Игра К.Н.Б</span>
          <a href="#"><img src="/images/minigames-icon/information.png" alt="Icon"></a>
          <a href="#"><img src="/images/minigames-icon/clipboards.png" alt="Icon"></a>
          <div class="knb-bet">
            <div class="knb-bet__item" v-on:click="joinRoom(room)" v-bind:class="{active:myRoom==room.id}" v-for="room in rooms" v-if="room.sum<=user.money">
              <span class="main-bet">{{room.sum}}</span>
              <a href="#" class="circle"></a>
              <span>({{room.users.length}})</span>
            </div>
          </div>
        </div>
        <div class="minigames-scroll">
          <div class="minigames__coin-left-middle ">
            <div class="minigames__coin-side minigames__knb-side">
              <a v-if="false" v-on:click="join" v-bind:class="{active:isVisible}" href="#" class="circle-plus" style="background-image: url(/images/new-plus.png);" title="Войти в комнату"></a>
              
              <a href="#" class="circle minigames__coin-side-ava h-object-fit" ><img src="/images/ava2.png" alt="" title="Случайный игрок"></a>
            </div>
            <div class="minigames__coin-side" v-for="room in rooms" v-if="room.id==myRoom">
              <!-- <a href="#" class="circle minigames__coin-side-ava  active h-object-fit" ><img src="/images/ava.png" alt=""></a> -->
              <a href="#" class="circle minigames__coin-side-ava h-object-fit" v-for="user in room.users"><img v-bind:src="user.avatar" alt="" v-bind:title="user.id" v-on:click="joinGame(user)"></a>
            </div>
          </div>
        </div>

      </div>

      <div class="minigames__coin-right">
        <div class="minigames__coin-right-bet">
          <a href="#" class="circle"></a>
          <span>x4.37</span>
        </div>
        <div class="minigames__coin-right-bet">
          <a href="#" class="circle" style="background-image: url(/images/game/clock.png);"></a>
          <span>9:35</span>
          <div class="minigames-count">5</div>
        </div>
        <div class="minigames__coin-right-circle">
          <a href="#" class="circle h-object-fit"><img src="/images/minigames-icon/paper_white.png" alt=""></a>
        </div>

      </div>

    </div>
    <!-- <a href="#" class="skill_close"></a> -->
  </div>

  <div class="minigames__coin-wrap-third" v-else>

    <div class="minigames__coin">

      <div class="minigames__coin-left">
        <div class="minigames__coin-left-top">
          <span>Игра К.Н.Б</span>
          <a href="#"><img src="/images/minigames-icon/information.png" alt="Icon"></a>
          <a href="#"><img src="/images/minigames-icon/clipboards.png" alt="Icon"></a>
          <div class="knb-bet">
            <div class="knb-bet__item" v-for="room in rooms">
              <span class="main-bet">{{room.sum}}</span>
              <a href="#" class="circle"></a>
              <span>({{room.count}})</span>
            </div>
          </div>
        </div>

        <div class="result__knb-wrap">
          <div class="result__knb-contender">
            <div class="contender-prev">
              <img src="/images/arrow-back.png" alt="">
            </div>
            <p>Соперник</p>
            <a href="#" class="circle h-object-fit"><img src="/images/ava.png" alt="Alt"></a>
            <p>nickname</p>
          </div>
          <div class="result__knb-choise-wrap">
            <p>Выберите</p>
            <div class="result__knb-choise" v-if="!myBet">
              <a v-on:click="bet('k')" v-bind:class="{'knb-active':myBet=='k', active: isActive}" href="#" class="circle result__knb-choise-item h-object-fit" ><img src="/images/minigames-icon/blank-file.png" alt="Alt"></a>
              <a v-on:click="bet('n')" v-bind:class="{'knb-active':myBet=='n', active: isActive}" href="#" class="circle result__knb-choise-item h-object-fit" ><img src="/images/minigames-icon/cut.png" alt="Alt"></a>
              <a v-on:click="bet('b')" v-bind:class="{'knb-active':myBet=='b', active: isActive}" href="#" class="circle result__knb-choise-item h-object-fit" ><img src="/images/minigames-icon/cave-painting.png" alt="Alt"></a>
            </div>
            <div class="result__knb-choise" v-else>
              <a v-if="myBet=='k'" href="#" class="circle result__knb-choise-item h-object-fit" ><img src="/images/minigames-icon/blank-file.png" alt="Alt"></a>
              <a v-if="myBet=='n'" href="#" class="circle result__knb-choise-item h-object-fit" ><img src="/images/minigames-icon/cut.png" alt="Alt"></a>
              <a v-if="myBet=='b'" href="#" class="circle result__knb-choise-item h-object-fit" ><img src="/images/minigames-icon/cave-painting.png" alt="Alt"></a>
            </div>
          </div>
          <div class="you-win">
            <p>Вы</p>
            <img v-bind:src="user.avatar" v-bind:title="user.name">
            <p>{{user.name}}</p>
            <!-- <button type="button" class="you-win-button">Сыграть еще</button> -->
          </div>

        </div>

      </div>

      <div class="minigames__coin-right">
        <div class="minigames__coin-right-bet">
          <a href="#" class="circle"></a>
          <span>4.37x</span>
        </div>
        <div class="minigames__coin-right-bet">
          <a href="#" class="circle" style="background-image: url(/images/game/clock.png);"></a>
          <span>9:35</span>
          <div class="minigames-count">5</div>
        </div>
        <div class="minigames__coin-right-circle">
          <a href="#" class="circle h-object-fit"><img src="/images/minigames-icon/paper.png" alt=""></a>
        </div>

      </div>

    </div>
    <a href="#" class="skill_close"></a>
  </div>
</template>

<script>
export default {
  data: function(){
    return{
      money_multiplier: money_multiplier,
      myRoom: false,
      user: user,
      inGame: false,
      loadGame: false,
      // isVisible: false,
      // isSearchable: false,
      rooms: {},
      myBet: false
    }
  },
  methods: {
    joinGame: function(user){
      axios
        .post('/knb/joingame', {user: user.id})
        .then(response => (this.loadGame=true));
    },
    joinRoom: function(room){
      axios
      .post('/knb/joinroom', {
        leaveroom: this.myRoom,
        joinroom: room.id
      }).then(response => (console.log(response)))
      this.myRoom = room.id
    },
    bet: function(bet){
      this.myBet = bet;
    }
  },
  mounted: function(){
    axios
    .get('/knb')
    .then(response => (this.rooms = response.data))

    Echo.channel("Knb")
      .listen(".joinRoom", (e) => {
        this.rooms.forEach(function(room){
          if(room.id == e.room){
            room.users.unshift(e.user)
          } else {
            room.users.forEach(function(user,index){
              if (user.id == e.user.id)
                room.users.splice(index, 1)
            })
          }
        })
      })
      .listen(".startGame", (e) => {
        if(this.user.id == e.game.first.id || this.user.id == e.game.second.id)
          this.inGame = e.game.id;
      })
  },
  beforeDestroy: function(){
    axios
      .post('/knb/leaveroom', {user: user.id})
      .then(response => (this.inGame=false));
  }

}


</script>

<style lang="css">
.transparent {
    filter: alpha(Opacity=50);
    opacity: 0.5; 
   }
</style>

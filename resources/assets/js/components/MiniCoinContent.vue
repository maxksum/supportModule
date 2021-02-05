
<template lang="html">
  <div v-if="form" class="minigames__coin-wrap-second">

    <div class="minigames__coin">
      <div class="minigames__coin-left">

        <div class="minigames__coin-left-top">
          <span>Игра Монетка</span>
          <a href="#"><img src="/images/minigames-icon/information.png" alt="Icon"></a>
          <a href="#"><img src="/images/minigames-icon/clipboards.png" alt="Icon"></a>
          <form action="">
            <input id="minigames-auto2" type="checkbox">
            <label for="minigames-auto2">Авто</label>
          </form>
        </div>

        <div class="minigames__coin-left-middle">
          <div class="minigames__coin-enter">
            <span>Ставка на 
              <span v-if="bet=='tail'">РЕШКУ:</span>
              <span v-else>ОРЛА:</span>
            </span>
            <div class="donate_form">

              <form>
                <div class="item">
                  <input type="text" id="spinner3" name="" v-model="sum" step=""/>
                </div>
              </form>
            </div>
            <a href="#" class="circle"></a>
          </div>
          <div class="minigames__coin-side">
            <a v-on:click="send" href="#">Поставить</a>&nbsp;|&nbsp; 
            <a v-on:click="cancel" href="#">Отмена</a>
          </div>
        </div>

        <div class="minigames__coin-left-bottom">
          <a v-for="game in info.games" href="#" class="circle minigames__coin-left-bottom-item"></a>
          <a href="#" class="circle minigames__coin-left-bottom-item"></a>
          <a href="#" class="circle minigames__coin-left-bottom-item"></a>
          <a href="#" class="circle minigames__coin-left-bottom-item"></a>
          <a href="#" class="circle minigames__coin-left-bottom-item"></a>
          <a href="#" class="circle minigames__coin-left-bottom-item"></a>
          <a href="#" class="circle minigames__coin-left-bottom-item"></a>
          <a href="#" class="circle minigames__coin-left-bottom-item"></a>
          <a href="#" class="circle minigames__coin-left-bottom-item"></a>
          <a href="#" class="circle minigames__coin-left-bottom-item active"></a>
        </div>

        <div v-if="info.timer>0" class="minigames__coin-time">До броска монетки {{ info.timer }} секунд</div>
        <div v-else class="minigames__coin-time">Монета брошена</div>
      </div>

      <div class="minigames__coin-right">
        <div class="minigames__coin-right-bet">
          <a href="#" class="circle" style="background-image: url(/images/game/clock.png);"></a>
          <span>x4.37</span>
        </div>
        <div class="minigames__coin-right-circle">
          <a href="#" class="circle h-object-fit"><img src="/images/minigames-icon/coin_white.png" alt=""></a>
        </div>
        <div class="minigames__coin-right-bet">
          <a href="#" class="circle" style="background-image: url(/images/minigames-icon/user.png);"></a>
          <span>156</span>
        </div>

      </div>
    </div>

    <!-- <a href="#" class="skill_close"></a> -->
  </div>

  <div v-else class="minigames__coin-wrap-second">

    <div class="minigames__coin">
      <div class="minigames__coin-left">

        <div class="result__coin-top">
          <div class="result__coin-items">

              <a v-for="game in info.games" href="#" class="circle">
                <img v-if="game.result=='tail'" src="/images/minigames-icon/tail.png" alt="Alt">
                <img v-else src="/images/minigames-icon/eagle.png" alt="Alt">
              </a>

          </div>
          <div v-if="info.sidewin">
              <span v-if="info.sidewin=='tail'" href="#" class="minigames__coin-time">Выпала РЕШКА</span>
              <span v-if="info.sidewin=='head'" href="#" class="minigames__coin-time">Выпал ОРЕЛ</span>
          </div>
          <div v-else-if="info.timer>0" class="minigames__coin-time">До броска монетки {{ info.timer }} секунд</div>
        <div v-else class="minigames__coin-time">Монета брошена</div>
        </div>

        <div class="result__coin-wrap">

          <div class="result__coin-tails first">
            <p>РЕШКА</p>
            <div class="result__coin-tails-items ">
              <span>+{{Math.floor(info.game.tail_sum / money_multiplier)}}</span>
              <div v-for="tailer in info.tailers">
                <a href="#" class="circle h-object-fit" ><img v-bind:src="tailer.avatar" v-bind:alt="tailer.name"></a>
              </div>
              <a href="#" class="circle h-object-fit last" ><img src="/images/ava.png" alt="Alt">
                <span>+{{info.game.tail_count}}</span></a>
                <!-- <a  href="#" class="circle minigames__coin-side-item " style="margin-left:10px"><img src="/images/minigames-icon/tail.png" alt=""></a> -->
            </div>
            <!-- <p>И вы. 20 <span class="circle"></span> ваши!</p> -->
            <!-- <p><span>{{Math.round(info.game.tail_count/(0.1+info.game.tail_count+info.game.head_count)*100)}}%</span></p> -->
            <p><a v-on:click="tail" href="#">Поставить на РЕШКУ</a></p>
          </div>

          <div v-if="info.sidewin">
              <a v-if="info.sidewin=='tail'" href="#" class="circle h-object-fit"><img src="/images/minigames-icon/tail.png" alt=""></a>
              <a v-if="info.sidewin=='head'" href="#" class="circle h-object-fit"><img src="/images/minigames-icon/eagle.png" alt=""></a>
          </div>
          <div v-else-if="info.timer>0"><span class="cfcounter" >BET</span></div>
          <div v-else><span class="cfcounter">?</span></div>


          <div class="result__coin-tails second">
            <p>ОРЕЛ</p>
            <div class="result__coin-tails-items ">
              <!-- <a href="#" class="circle minigames__coin-side-item " style="margin-right:25px"><img src="/images/minigames-icon/eagle.png" alt=""></a> -->
              <div v-for="header in info.headers">
                <a href="#" class="circle h-object-fit" ><img v-bind:src="header.avatar" v-bind:alt="header.name"></a>
              </div>
              <a href="#" class="circle h-object-fit last" ><img src="/images/ava.png" alt="Alt">
                <span>+{{info.game.head_count}}</span></a>
              <span>+{{Math.floor(info.game.head_sum / money_multiplier)}}</span>
            </div>
            <p><a v-on:click="head" href="#">Постваить на ОРЛА</a></p>
            <!-- <p>{{Math.round(info.game.head_count/(0.1+info.game.tail_count+info.game.head_count)*100)}}%</p> -->
            <!-- <p>Повезет в следующий раз...</p> -->
          </div>

        </div>

      </div>

      <div class="minigames__coin-right">
        <div class="minigames__coin-right-bet">
          <a href="#" class="circle" style="background-image: url(/images/game/clock.png);"></a>
          <span>4.37x</span>
        </div>
        <div class="minigames__coin-right-circle">
          <a href="#" class="circle h-object-fit"><img src="/images/minigames-icon/coin.png" alt=""></a>
        </div>
        <div class="minigames__coin-right-bet">
          <a href="#" class="circle" style="background-image: url(/images/minigames-icon/user.png);"></a>
          <span>156</span>
        </div>

      </div>
    </div>

    <a href="#" class="skill_close" v-on:click="changeGame(0)"></a>
  </div>
</template>

<script>
export default {
  props: ['changeGame'],
  data: function(){
    return {
      money_multiplier: money_multiplier,
      form: false,
      sum: 10,
      bet: false,
      info: {
        game: {
          tail_count: 0,
          tail_sum: 0,
          head_count: 0,
          head_sum: 0,
        },
        timer: 0,
        games: [],
        headers: [],
        tailers: [],
        games: {},
        sidewin: false
      }
    }

  },
  methods:{
    tail: function(){
      this.form = true
      this.bet  = "tail"
    },
    head: function(){
      this.form = true
      this.bet  = "head"
    },
    send: function(){
      this.form = false;
      axios
        .post("/coinflip/bet", {
          sum: this.sum,
          bet: this.bet
        }).then(response => (this.state=false))
    },
    cancel: function(){
      this.form = false
      this.bet = false 
    },
    tick: function(){
      this.info.timer--;
    },
    fresh: function(){
      this.info.game = {
          tail_count: 0,
          tail_sum: 0,
          head_count: 0,
          head_sum: 0,
        }
        this.info.timer = 15;
        this.info.headers = [];
        this.info.tailers = [];
        this.info.sidewin=false;
    }
  },
  mounted: function(){
    setInterval(this.tick, 1000)
    axios
      .get('/coinflip')
      .then(response => (this.info = response.data));
    Echo.channel("Coinflip")
      .listen(".join", (e) => {
        if(e.info.bet == 'head'){
          this.info.game.head_count++;
          this.info.game.head_sum += e.info.sum
          this.info.headers.splice(4,1)
          this.info.headers.unshift(e.info.user)

        } else {
          this.info.game.tail_count++;
          this.info.game.tail_sum += e.info.sum
          this.info.tailers.splice(4,1)
          this.info.tailers.unshift(e.info.user)
        }
      })
      .listen(".spin", (e) => {
        setTimeout(this.fresh, 2000)
        this.info.games = e.info.games;
        this.info.sidewin = e.info.sidewin;
      })
  },
}
</script>

<style lang="css">
.cfcounter{
  display:block;
  vertical-align:middle;
  text-align:center;
  line-height:68px;
  width:68px;
  height:68px;
  border-radius: 50%;
  border-width:3px;
  border-color: yellow;
  border-style: solid;
}
</style>

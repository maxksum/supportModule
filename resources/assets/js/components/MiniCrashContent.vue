<template lang="html">
  <div class="minigames__coin-wrap-first">

    <div class="minigames__coin">
      <div class="minigames__coin-left">

        <div class="minigames__coin-left-top">
          <span>Игра Крушение</span>
          <a href="#"><img src="/images/minigames-icon/information.png" alt="Icon"></a>
          <a href="#"><img src="/images/minigames-icon/clipboards.png" alt="Icon"></a>
          <div class="minigames-count-crash">5</div>
          <form action="">
            <input id="minigames-auto" type="checkbox">
            <label for="minigames-auto">Авто</label>
          </form>
        </div>

        <div class="minigames__coin-left-middle crash-coefficient-wrap">
          <div class="minigames__coin-enter crash-enter">
            <span>Ставка</span>
            <div class="donate_form">
              <form>
                <div class="item">
                  <input type="text" id="spinner1" name="" value="100" step="100"/>
                </div>
              </form>
            </div>
          </div>
          <div class="minigames__coin-enter crash-enter">
            <span>Коэф.</span>
            <div class="donate_form">
              <form>
                <div class="item">
                  <input type="text" id="spinner2" name="" value="12.1" step="0.1"/>
                </div>
              </form>
            </div>
          </div>
          <button class="crash-buttton" type="button">ПОСТАВИТЬ</button>
        </div>

        <div class="minigames__coin-left-bottom">
          <div class="crash-coefficient">x1.43</div>
          <div class="crash-coefficient">x1.43</div>
          <div class="crash-coefficient">x1.43</div>
          <div class="crash-coefficient">x1.43</div>
          <div class="crash-coefficient">x1.43</div>
          <div class="crash-coefficient">x1.43</div>
          <div class="crash-coefficient">x1.43</div>
          <div class="crash-coefficient">x1.43</div>
          <div class="crash-coefficient">x1.43</div>
          <div class="crash-coefficient active">x1.43</div>
        </div>

        <div class="minigames__coin-time">До конца ставок <span>9</span> секунд</div>
      </div>

      <div class="minigames__coin-right">
        <div class="minigames__coin-right-circle">
          <a href="#" class="circle h-object-fit"><img src="/images/minigames-icon/crash_white.png" alt=""></a>
        </div>
        <div class="minigames__coin-right-bet">
          <a href="#" class="circle" style="background-image: url(/images/game/clock.png);"></a>
          <span>9.3</span>
          <div class="minigames-count">5</div>
        </div>
        <div class="minigames__coin-right-bet">
          <a href="#" class="circle" style="background-image: url(/images/minigames-icon/user.png);"></a>
          <span>156</span>
        </div>

      </div>
    </div>

    <!-- <a href="#" class="skill_close"></a> -->
  </div>

  <!-- <div class="minigames__coin-wrap-first1">

    <div class="minigames__coin">
      <div class="minigames__coin-left">

        <div class="minigames__coin-left-top">
          <span>Ваша ставка 100</span>
          <a href="#" class="circle"></a>
          <span>на коэф 12,1x</span>
        </div>

        <div class="minigames__coin-left-middle">
          <canvas id=minigamesCanvas></canvas>
        </div>
      </div>

      <div class="minigames__coin-right">
        <div class="minigames__coin-right-circle">
          <a href="#" class="circle h-object-fit"><img src="/images/minigames-icon/crash.png" alt=""></a>
        </div>
        <div class="minigames__coin-right-bet">
          <a href="#" class="circle" style="background-image: url(/images/game/clock.png);"></a>
          <span>9.3</span>
          <div class="minigames-count">5</div>
        </div>
        <div class="minigames__coin-right-bet">
          <a href="#" class="circle" style="background-image: url(/images/minigames-icon/user.png);"></a>
          <span>156</span>
        </div>

      </div>
    </div>

    <a href="#" class="skill_close"></a>
  </div>

  <div class="minigames__coin-wrap-first2">

    <div class="minigames__coin">
      <div class="minigames__coin-left">
        <div class="minigames__coin-fail">
          <p>x4.17<span>:(</span></p>
          <p>Неудача</p>
        </div>
      </div>

      <div class="minigames__coin-right">
        <div class="minigames__coin-right-circle">
          <a href="#" class="circle h-object-fit"><img src="/images/minigames-icon/crash.png" alt=""></a>
        </div>
        <div class="minigames__coin-right-bet">
          <a href="#" class="circle" style="background-image: url(/images/game/clock.png);"></a>
          <span>9.3</span>
          <div class="minigames-count">5</div>
        </div>
        <div class="minigames__coin-right-bet">
          <a href="#" class="circle" style="background-image: url(/images/minigames-icon/user.png);"></a>
          <span>156</span>
        </div>

      </div>
    </div>

    <a href="#" class="skill_close"></a>
  </div>

  <div class="minigames__coin-wrap-first3">

    <div class="minigames__coin">
      <div class="minigames__coin-left">
        <div class="minigames__coin-fail">
          <p>12.47 <span>:)</span></p>
          <p>Выиграш 100 x 12.47<div class="circle h-object-fit" ></div> = 1247<div class="circle h-object-fit" ></div></p>
        </div>
      </div>

      <div class="minigames__coin-right">
        <div class="minigames__coin-right-circle">
          <a href="#" class="circle h-object-fit"><img src="/images/minigames-icon/crash.png" alt=""></a>
        </div>
        <div class="minigames__coin-right-bet">
          <a href="#" class="circle" style="background-image: url(/images/game/clock.png);"></a>
          <span>9.3</span>
          <div class="minigames-count">5</div>
        </div>
        <div class="minigames__coin-right-bet">
          <a href="#" class="circle" style="background-image: url(/images/minigames-icon/user.png);"></a>
          <span>156</span>
        </div>

      </div>
    </div>

    <a href="#" class="skill_close"></a>
  </div> -->
</template>

<script>
export default {
}
</script>

<style lang="css">
</style>

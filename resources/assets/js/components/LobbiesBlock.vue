<template lang="html">
  <div id="wrapper" class="game_list">
      <div class="game_list_block">
          <div class="thead">
              <div class="inner">
                  <div class="item">Название команд</div>
                  <div class="item">Создатель</div>
                  <div class="item">Ставка</div>
                  <div class="item">Приз</div>
                  <div class="item">Игроков</div>
                  <div class="item">Карта</div>
                  <div class="item with_title" title="Античит&nbsp;EasyAntiCheat&nbsp;-&nbsp;игроки&nbsp;не смогут&nbsp;зайти&nbsp;на&nbsp;сервер&nbsp;без запущенной программы античита"><img src="/images/game/ico-1.png"></div>
  					      <div class="item with_title" title="При&nbsp;готовности&nbsp;участников система&nbsp;автоматически распределит&nbsp;игроков&nbsp;по&nbsp;уровню по&nbsp;командам&nbsp;таким&nbsp;образом, чтобы&nbsp;силы&nbsp;команд&nbsp;были максимально&nbsp;равными"><img src="/images/game/ico-2.png"></div>
  					      <div class="item with_title" title="До&nbsp;начала&nbsp;игры&nbsp;на&nbsp;сервере&nbsp;все никнеймы&nbsp;игроков&nbsp;в&nbsp;лобби&nbsp;будут скрыты"><img src="/images/game/ico-3.png"></div>
                  <div class="item">Скилл</div>
                  <div class="item"><img src="/images/game/loc.png"></div>
                  <div class="item"><img src="/images/game/clock.png"></div>
                  <div class="item">&nbsp;</div>
              </div>
              <a class="show_sets"></a>
              <a class="show_sets2"></a>
          </div>

          <div class="tsets">
              <div class="inner">
                  <div class="item child">
                      Локация
                      <form class="subTsets">
                          <div class="subItem">
                              <input type="checkbox" v-model="filter_location" name="" id="location1" checked>
                              <label for="location1">ПОКАЗАТЬ ВСЕ</label>
                          </div>
                          <div class="subItem">
                              <input type="checkbox" v-model="filter_location" name="" id="location2">
                              <label for="location2">Москва</label>
                          </div>
                      </form>
                  </div>
                  <div class="item child">
                      Карта

                      <form class="subTsets">
                          <div class="subItem">
                              <input type="checkbox" name="" id="map1" checked>
                              <label for="map1">ПОКАЗАТЬ ВСЕ</label>
                          </div>
                          <div class="subItem">
                              <input type="checkbox" name="" id="map2">
                              <label for="map2">de_dust 2</label>
                          </div>
                          <div class="subItem">
                              <input type="checkbox" name="" id="map3">
                              <label for="map3">de_dust 3</label>
                          </div>
                          <div class="subItem">
                              <input type="checkbox" name="" id="map4">
                              <label for="map4">de_dust 4</label>
                          </div>
                      </form>
                  </div>
                  <div class="item child">
                      Режим

                      <form class="subTsets">
                          <div class="subItem">
                              <input type="checkbox" name="" id="mode1" checked>
                              <label for="mode1">ПОКАЗАТЬ ВСЕ</label>
                          </div>
                          <div class="subItem">
                              <input type="checkbox" name="" id="mode2">
                              <label for="mode2">1x1</label>
                          </div>
                          <div class="subItem">
                              <input type="checkbox" name="" id="mode3">
                              <label for="mode3">3x3</label>
                          </div>
                          <div class="subItem">
                              <input type="checkbox" name="" id="mode4">
                              <label for="mode4">5x5</label>
                          </div>
                      </form>
                  </div>
                  <div class="item child">
                      Античит

                      <form class="subTsets">
                          <div class="subItem">
                              <input type="checkbox" name="" id="cheats1" checked>
                              <label for="cheats1">ПОКАЗАТЬ ВСЕ</label>
                          </div>
                          <div class="subItem">
                              <input type="checkbox" name="" id="cheats2">
                              <label for="cheats2">ON</label>
                          </div>
                          <div class="subItem">
                              <input type="checkbox" name="" id="cheats3">
                              <label for="cheats3">OFF</label>
                          </div>
                      </form>
                  </div>
                  <div class="item">
                      <div class="tsets_title">от <span>0</span> до <span>10000</span></div>
                      <div id="param2"></div>
                  </div>
                  <div class="item">
                      <div class="tsets_title">от <span class="rank">LS</span> до <span class="rank">OP</span></div>
                      <div id="param3"></div>
                  </div>
              </div>
              <div class="tsets_link">
                  <a href="#"><img src="/images/sets/save.png"></a>
                  <a href="#"><img src="/images/sets/delete.png"></a>
                  <a class="close_tsets"><img src="/images/sets/close.png"></a>
              </div>
          </div>

          <vue-scrollbar classes="lobbies-scrollbar" ref="Scrollbar">
            <div class="tbody" id="lobbies_list">
          		<div is="lobby-item" v-for="lobby in show_lobbies" :lobby="lobby" :key="lobby.id" :show_method="show_method"></div>
          	</div>
          </vue-scrollbar>
      </div>
  </div>

</template>

<script>
import LobbyItem from './LobbyItem.vue';
import VueScrollbar from 'vue2-scrollbar';
export default {
  props: ['filter_location', 'show_lobbies', 'show_method'],
  components: { LobbyItem, VueScrollbar }
}
</script>

<style lang="css">
</style>

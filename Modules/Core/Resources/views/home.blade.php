@extends('core::layouts.master')

@section("content")
<content-layer>

 </content-layer>
@endsection

@push("header_scripts")
  <script type="text/javascript">
      $(function() {
          var spinner = $("#spinner").spinner();
          $("#spinner").each(function(){
              var count = $(this).attr('step');
              $(this).spinner({
                  step: count,
                  min: 0
              });
          });
      });
      $(function() {
          var spinner1 = $("#spinner1").spinner();
          $("#spinner1").each(function(){
              var count = $(this).attr('step');
              $(this).spinner({
                  step: count,
                  min: 0
              });
          });
      });
      $(function() {
          var spinner2 = $("#spinner2").spinner();
          $("#spinner2").each(function(){
              var count = $(this).attr('step');
              $(this).spinner({
                  step: count,
                  min: 0
              });
          });
      });
      $(document).ready(function(){
          var slider = document.getElementById('param');
          noUiSlider.create(slider, {
              start: [1, 7],
              connect: true,
              step: 1,
              range: {
                  'min': 1,
                  'max': 7
              }
          });
          slider.noUiSlider.on('change', function(values, handle){
              var name1, name2;
              switch (parseInt(values[0])) {
                case 1:
                name1 = 'Low Skill'
                break;
                case 2:
                name1 = 'Medium Skill'
                break;
                case 3:
                name1 = 'Amateur Skill'
                break;
                case 4:
                name1 = 'High Skill'
                break;
                case 5:
                name1 = 'Semi-pro Skill'
                break;
                case 6:
                name1 = 'Pro Skill'
                break;
                case 7:
                name1 = 'OverPro Skill'
                break;
              }
              switch (parseInt(values[1])) {
                case 1:
                name2 = 'Low Skill'
                break;
                case 2:
                name2 = 'Medium Skill'
                break;
                case 3:
                name2 = 'Amateur Skill'
                break;
                case 4:
                name2 = 'High Skill'
                break;
                case 5:
                name2 = 'Semi-pro Skill'
                break;
                case 6:
                name2 = 'Pro Skill'
                break;
                case 7:
                name2 = 'OverPro Skill'
                break;
              }
              $(".skill_line p").html(name1 + ' - ' + name2);
           });
      });
      $(document).ready(function(){
          var slider = document.getElementById('param2');
          noUiSlider.create(slider, {
              start: [20, 80],
              connect: true,
              range: {
                  'min': 0,
                  'max': 100
              }
          });
      });
      $(document).ready(function(){
          var slider = document.getElementById('param3');
          noUiSlider.create(slider, {
              start: [20, 80],
              connect: true,
              range: {
                  'min': 0,
                  'max': 100
              }
          });
      });
  </script>
@endpush


@push("footer_scripts")
<script>
    var deathmatch_servers = [];
    var tourney_teams = [];
    var dm_top = [];

    $(document).ready(function() {
      updater();
      $(".dm_prize").html(dm_top.prize);
    });
</script>


<script async type="text/javascript">
    jQuery( document ).ready(function() {
      jQuery.getScript("//vk.com/js/api/openapi.js?152", function(data, textStatus, jqxhr) {
        if (jqxhr.status == 200) {
          VK.init({
            apiId: 5797724
          });
          document.getElementById('vk_groups').innerHTML = "";
          VK.Widgets.Group("vk_groups", {mode: 3, width: 'auto', no_cover: 1, color1: '101111', color2: 'f9cf28', color3: 'f9cf28'}, 38751500);
        }
      });
    });
</script>
@endpush

@push("popups")
  <div class="popup_fade" onclick="closeGame()"></div>
  <div class="popup_content ready_game animated05 fadeOutUp">
    <a class="beta" onclick="betaGame()"></a>
      <div class="popup_title">ВАША ИГРА ГОТОВА</div>
      <div class="popup_links">
          <a onclick="ready()">Я ГОТОВ К ИГРЕ</a>
          <a onclick="leave()">ВЫЙТИ</a>
      </div>
  </div>
  <div class="popup_content lobby_game animated05 fadeOutUp">
      <a class="popup_close" onclick="closeGame()"></a>
      <div class="popup_head">
          <div class="item">
              КОМАНДА <span id="popup_team1name">RED</span>
          </div>
          <div class="item">
              КОМАНДА <span id="popup_team2name">BLUE</span>
          </div>
      </div>
      <div class="popup_body">
          <div class="item" id="popup_team1">

          </div>
          <div class="item" id="popup_team2">

          </div>
      </div>
  </div>
@endpush

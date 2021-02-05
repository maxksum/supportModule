<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="title"/>
    <meta name="keywords" content="title"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>eSports Battle Games</title>
    <link rel="stylesheet" href="/css/style.css?{{$rev}}" type="text/css" />
    <link rel="stylesheet" href="/css/slick.css?{{$rev}}" type="text/css" />
    <link rel="stylesheet" href="/css/media.css?{{$rev}}" type="text/css" />
    <link rel="stylesheet" href="/css/select.css?{{$rev}}" type="text/css" />
    <link rel="stylesheet" href="/css/nouislider.css?{{$rev}}" type="text/css" />
    <link rel="stylesheet" href="/css/jquery.mCustomScrollbar.css?{{$rev}}" type="text/css" />
    <link rel="stylesheet" href="/css/animate.css?{{$rev}}" type="text/css" />
    <link rel="stylesheet" href="/css/chat.css?{{$rev}}" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:300,400,600,700&amp;subset=cyrillic" rel="stylesheet">

    <script type="text/javascript" src="/js/jquery.js?{{$rev}}"></script>
    <script type="text/javascript" src="/js/custom.js?{{$rev}}"></script>
    <script type="text/javascript" src="/js/js.js?{{$rev}}"></script>
    <script type="text/javascript" src="/js/slick.js?{{$rev}}"></script>
    <script type="text/javascript" src="/js/step.js?{{$rev}}"></script>
    <script type="text/javascript" src="/js/select.js?{{$rev}}"></script>
    <script type="text/javascript" src="/js/nouislider.js?{{$rev}}"></script>
    <script type="text/javascript" src="/js/chat.js?{{$rev}}"></script>
    <script type="text/javascript" src="/js/star-rating.js?{{$rev}}"></script>
    <script type="text/javascript" src="/js/jquery.mCustomScrollbar.js?{{$rev}}"></script>
    <script type="text/javascript" src="/js/tab.js?{{$rev}}"></script>
    <script type="text/javascript" src="/js/util.js?{{$rev}}"></script>
    <script type="text/javascript" src="/js/tab-function.js?{{$rev}}"></script>
    <script src="//{{ Request::getHost() }}:8443/socket.io/socket.io.js"></script>
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-85110508-1', 'auto');
        ga('send', 'pageview');
    </script>
    <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = 'https://vk.com/rtrg?p=VK-RTRG-208011-6uSFl';</script>
    @stack('header_scripts')
</head>
<script>
(function(){
var widget_id = 895853;
_shcp =[{widget_id : widget_id}];
var lang =(navigator.language || navigator.systemLanguage
|| navigator.userLanguage ||"en")
.substr(0,2).toLowerCase();
var url ="widget.siteheart.com/widget/sh/"+ widget_id +"/"+ lang +"/widget.js";
var hcc = document.createElement("script");
hcc.type ="text/javascript";
hcc.async =true;
hcc.src =("https:"== document.location.protocol ?"https":"http")
+"://"+ url;
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(hcc, s.nextSibling);
})();
</script>
<script charset="UTF-8" src="//cdn.sendpulse.com/9dae6d62c816560a842268bde2cd317d/js/push/ac85afd15139aee8cf43823302e910ea_0.js" async></script>
<script>
function closeChat() {
  $(".info_chat").show();
  $(".over-chat").hide();
  $(".bg_close").hide();
}
</script>


<body class="">
  <div class="bg_close" onClick="closeChat()"></div>
<script type="text/javascript">

$.ajaxSetup({
    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
});

function refreshToken() {
  $.get('refresh-csrf').done(function(data){
    if (data) {
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': data}
    });
    $('meta[name="csrf-token"]').attr('content', data);
  }
  });
}

setInterval(refreshToken, 1800000);
</script>
    <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=k5pwaxdBudoKiXcmbCJedvsaJa0sZ3xBbeVLQtQz0qbFvrrWhNHbZHMcYMX1VOuD9xFT1PNPWG708mTHcRjVithUOc*SD4QvKHQ8jeb0T*a9IWZNr/iiay2bhSDEvUS/f83oGGsuGvGHsAjsu4vrvEjMqLf1J9SC4xNwizd2PD4-&pixel_id=1000030580';</script>
<div id="bg"></div>
<div id="main-app">
	@yield('content')
</div>
@if (Request::is("/"))
  @include("core::blocks.userpopup")
@endif
@include("core::blocks.skills")
@if (Module::has("Chat"))
	@include("core::blocks.chat")
@endif
<div id="popup">
    @stack("popups")
</div>

<div class="beta_game">
	<div class="beta_content ready_game">
		<div class="beta_title">ВАША ИГРА ГОТОВА</div>
		<div class="beta_links">
			<a onclick="readyGame();closeBeta()">ПОДТВЕРЖДЕНИЕ ГОТОВНОСТИ</a>
		</div>
	</div>
</div>
@include("core::blocks/javascript_footer")
@stack('footer_scripts')
<audio id="goplayer" src="/music/veto_begin.wav"></audio>
<audio id="messageplayer" src="/music/message.mp3"></audio>
<script defer src="{{mix("/js/app.js")}}"></script>
<link rel="stylesheet" href="{{mix("/css/app.css")}}">
</body>
</html>

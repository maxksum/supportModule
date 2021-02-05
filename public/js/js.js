$(document).ready(function(){
    //Ховер для списка игр
	$('body').on('mouseenter', '.nav-left .activ, .leftSub.showSub', function(){
		$('.leftSub').addClass('act showSub');
	});
	$('body').on('mouseleave', '.nav-left', function(){
		$('.leftSub').removeClass('act');
        setTimeout(function(){
            $('.leftSub').removeClass('showSub');
        }, 100);
	});
    $('body').on('mouseleave', '.leftSub', function(){
        $('.leftSub').removeClass('act showSub');
    });
    //Ховер для списка языков
    $('body').on('mouseenter', '.nav-right .activ, .rightSub.showSub', function(){
        $('.rightSub').addClass('act showSub');
    });
    $('body').on('mouseleave', '.nav-right', function(){
        $('.rightSub').removeClass('act');
        setTimeout(function(){
            $('.rightSub').removeClass('showSub');
        }, 100);
    });
    $('body').on('mouseleave', '.rightSub', function(){
        $('.rightSub').removeClass('act showSub');
    });
    //Ховер для профиля
    $('.profile').addClass('profile_sub');
    $('body').on('mouseenter', '.profile_sub', function(){
        $('.profile .sub').addClass('act');
    });
    $('body').on('mouseleave', '.profile_sub', function(){
        $('.profile').removeClass('profile_sub');
        $('.profile .sub').removeClass('act');
        setTimeout(function(){
            $('.profile').addClass('profile_sub');
        }, 200);
    });
		$('body').on('mouseenter', '.nav .navi li a', function(){
			 $(this).parent().find('.sub').addClass('act');
	 });
	 $('body').on('mouseleave', '.nav .navi li', function(){
			 $(this).find('.sub').removeClass('act');
	 });
});

$(document).ready(function(){
    $('body').on('click', '.slider_close', function(){
        $(this).hide();
        $('.slider').addClass('bounceOut');
        setTimeout(function(){
            $('.slider').hide();
        }, 500);
    });
});

$(document).ready(function() {
  var t = $('.slider');
  t.slick({
    dots: false,
    arrows: true,
    infinite: true,
    speed: 500,
    slidesToShow: 1,
    autoplay: true,
    autoplaySpeed: 6000,
    cssEase: 'linear',
    responsive: [{
      breakpoint: 1000,
      //сообщает, при какой ширине экрана нужно включать настройки
      settings: {
        speed: 500
      }
    }]
  });
  t.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
    var s = t.find('[data-slick-index="' + nextSlide + '"]').attr('data');
    t.slick('setOption', 'autoplaySpeed', s);
  });
});

function initShowMore() {
  $('#wrapper.setting, #death_detail, #tournament_detail, #stream_detail, #rank_stats_block').hide().addClass('animated');
  $('.show_more_info#showMore').append('<span class="moreSpan">СМОТРЕТЬ МЕНЬШЕ</span>');
}


$(document).ready(function() {

  $('body').on('click', 'a#showMore', function(e) {
    var href = $(this).attr('href');
    e.preventDefault();
    if ($(href).is(':visible')) $(href).removeClass('flipInX').addClass('bounceOut'),
      $(this).removeClass('UP'),
      $(this).css({
        fontSize: '12px'
      }),
      $(this).find('span.moreSpan').css({
        fontSize: '0px'
      });
    if ($(href).is(':visible')) setTimeout(function() {
      $(href).hide()
    }, 500);
    else $(href).show().removeClass('bounceOut').addClass('flipInX'),
      $(this).addClass('UP'),
      $(this).css({
        fontSize: '0px'
      }),
      $(this).find('span.moreSpan').css({
        fontSize: '12px'
      });
    var height = $(href).height();
    var top = $(href).offset().top - height;
    $('html, body').animate({
      scrollTop: top
    }, 500);
  });

  $('body').on('click', '.avatar.admin', function(){
        var leftx = event.clientX;
        var topy = event.clientY;
        $('.user_profile.admin_users').show().css({left: leftx + 20, top: topy, opacity: '1'});
        $('#general').addClass('profile_vision');
    });
    $('body').on('click', '.user_profile.admin_users', function(){
        $('#general').addClass('profile_vision');
    });
    $('body').on('click', '.profile_vision', function(){
        $('#general').removeClass('profile_vision');
        $('.user_profile.admin_users').hide();
    });

    $('body').on('click', '.avatar.users', function(){
          var leftx = event.clientX;
          var topy = event.clientY;
          $('.user_profile.normal_users').show().css({left: leftx + 20, top: topy, opacity: '1'});
          $('#general').addClass('profile_vision');
      });
      $('body').on('click', '.user_profile.normal_users', function(){
          $('#general').addClass('profile_vision');
      });
      $('body').on('click', '.profile_vision', function(){
          $('#general').removeClass('profile_vision');
          $('.user_profile.normal_users').hide();
      });

  $('.with_title').each(function() {
    var title = $(this).attr('title');
    $(this).append('<div class="link_title">' + title + '</div>');
    var width = $(this).find('.link_title').width();
    $(this).find('.link_title').css({
      left: '50%',
      marginLeft: -width / 2
    });
    $(this).attr('title', '');
  });

  // показ доп строки инфорации в списке активных серверов
  $('.game_list_block .show_sets, .game_list_block .tsets .tsets_link .close_tsets').click(function() {
    $('.game_list_block .tsets').slideToggle(100);
  });
  // увеличение и уменьшение высоты списка активных серверов
  list = 1;
  $('.show_sets2').click(function() {
    if (list == 1) {
      $('.game_list_block .tbody').animate({
        height: '800px'
      }, 300);
      $(this).addClass('active');
      list = 2;
    } else if (list == 2) {
      $('.game_list_block .tbody').animate({
        height: '264px'
      }, 300);
      list = 1;
      $(this).removeClass('active');
    }
  });
  // показ скрытых блоков
  $('#wrapper.setting, #death_detail, #tournament_detail, #stream_detail, #rank_stats_block').hide().addClass('animated');
  $('.show_more_info#showMore').append('<span class="moreSpan">СМОТРЕТЬ МЕНЬШЕ</span>');
  initShowMore();
  // показ скрытых блоков при клике на регистрацию команды, а также смена надписи на кнопке показа
  $('#showMoreTour').click(function(e) {
    var href = $(this).attr('href');
    e.preventDefault();
    if ($(href).is(':visible')) $(href).removeClass('flipInX').addClass('bounceOut'),
      $('.show_more_info.showMoreStyle').removeClass('UP'),
      $('.show_more_info.showMoreStyle').css({
        fontSize: '12px'
      }),
      $('.show_more_info.showMoreStyle').find('span.moreSpan').css({
        fontSize: '0px'
      });
    if ($(href).is(':visible')) setTimeout(function() {
      $(href).hide()
    }, 500);
    else $(href).show().removeClass('bounceOut').addClass('flipInX'),
      $('.show_more_info.showMoreStyle').addClass('UP'),
      $('.show_more_info.showMoreStyle').css({
        fontSize: '0px'
      }),
      $('.show_more_info.showMoreStyle#showMore').find('span.moreSpan').css({
        fontSize: '12px'
      });
    var height = $(href).height();
    var top = $(href).offset().top - height;
    $('html, body').animate({
      scrollTop: top
    }, 500);
  });
  // предпросмотр списка рейтинга скилла при клике на скилл
  $('.skill_lists').hide();
  $('body').on('click', '.rank', function() {
    $('.skill_lists').show(10).animate({
      right: '20px',
      opacity: '1'
    }, 200);
  });
  $('.skill_lists .skill_close').click(function() {
    $('.skill_lists').animate({
      right: '-300px',
      opacity: '0'
    }, 200).hide(10);
  });
  // скрыть head в чате
  chat = 205;
  $('.chat_head_close').click(function() {
    $('#chat .head').hide();
    var win = $(window).height();
    chat = 139;
    // $('#chat .body').css({
    //   height: win - chat
    // });
    chat = 139;
  });
  // смени иконки звука
  mute = 2;
  $('.chat_mute').click(function() {
    if (mute == 1) {
      $('.chat_mute').removeClass('on').addClass('off');
      mute = 2;
    } else if (mute == 2) {
      $('.chat_mute').removeClass('off').addClass('on');
      mute = 1;
    }
  });
  // автоматическая высота чата
  $(window).resize(function() {
    var win = $(window).height();
    // $('#chat .body').css({
    //   height: win - chat
    // });
  });
  $(window).resize();

  // предпросмотр списка рейтинга скилла при клике на скилл
  $('#chat').hide();
  $('.show_chat').click(function() {
    $('#chat').show(10).animate({
      left: '0px',
      opacity: '1'
    }, 200);
  });
  $('#chat .chat_close').click(function() {
    $('#chat').animate({
      left: '-330px',
      opacity: '0'
    }, 200).hide(10);
  });
  // скролл по якорям
  $('.scrollLinks').click(function() {
    var link = $(this).attr('data-link');
    var go = $(link).offset().top - 100;
    $('html, body').animate({
      scrollTop: go
    }, 300);
  });
  // подача жалобы на игрока
  $('.end_stats_block .report').click(function() {
    $('#popup').show().animate({
      opacity: '1'
    }, 300);
    $('#popup .popup_content.report_player').show().removeClass('fadeOutUp').addClass('fadeInDown');
    $('body').css({
      overflow: 'hidden'
    });
  });
  // оценка игрока
  /*
      $('.praised .dislike, .praised .like').each(function(){
          var a = $(this).find('a');
          $(a).click(function(){
              $(a).addClass('active');
          });
      });
  */
  // причина дизлайка
  $('.dislike_form').hide();
  $('.praised .dislike').click(function() {
    $('.dislike_form').show();
  });
  // переключение TAB-ов на странице рейтингов
  $('.rank_items .item').click(function() {
    $('.rank_items .item').removeClass('active');
    $(this).addClass('active');
  });
  // добавление и удаление предметов в сделке

  // ативный вариант пополнения счёта
  $('.option_links li').click(function() {
    $('.option_links li').removeClass('active');
    $(this).addClass('active');
  });
  // редактирование информации в профиле
  $('body').on('mouseenter', '#general .prof_top .prof_data', function() {
    $('#general').removeClass('profile_vision');
  });
  $('body').on('mouseleave', '#general .prof_top .prof_data', function() {
    $('#general').addClass('profile_vision');
  });
  $('body').on('click', '.prof_top .prof_data', function() {
  //  $('.prof_top .prof_data input').addClass('active');
    $('.prof_top .prof_data textarea:not([disabled])').addClass('active');
    $('.social_block').addClass('active');
  });
  $('body').on('click', '.profile_vision', function() {
  //  $('.prof_top .prof_data input').removeClass('active');
    $('.prof_top .prof_data textarea:not([disabled])').removeClass('active');
    $('.social_block').removeClass('active');
    $('.soc_block_form').removeClass('active');
  });
  // Добавление соц иконки
  // $('.social_block_item').append('<div class="item empty">' +
  //   '<a class="intro"><img src=""></a>' +
  //   '<div class="social_block_icons">' +
  //   '<div class="soc_icon"><img src="/images/profile/icon/ico-1.png"></div>' +
  //   '<div class="soc_icon"><img src="/images/profile/icon/ico-2.png"></div>' +
  //   '<div class="soc_icon"><img src="/images/profile/icon/ico-3.png"></div>' +
  //   '<div class="soc_icon"><img src="/images/profile/icon/ico-4.png"></div>' +
  //   '<div class="soc_icon"><img src="/images/profile/icon/ico-5.png"></div>' +
  //   '<div class="soc_icon"><img src="/images/profile/icon/ico-6.png"></div>' +
  //   '<div class="soc_icon"><img src="/images/profile/icon/ico-7.png"></div>' +
  //   '<div class="soc_icon"><img src="/images/profile/icon/ico-8.png"></div>' +
  //   '<div class="soc_icon"><img src="/images/profile/icon/ico-9.png"></div>' +
  //   '</div>' +
  //   '</div>'
  // );
  // Развернуть и свернуть историю игр в профиле
  $('.prof_history_list .body .inner .inner_block').hide();
  $('.prof_history_list .body .inner .inner_item .item .show_more_stat').click(function() {
    var parent = $(this).parent();
    var par = $(parent).parent();
    var button = $(this);
    $(par).parent().find('.inner_block').slideToggle('fast', function() {
      var vis = $(par).parent().find('.inner_block');
      if ($(vis).is(':visible')) $(button).html('Свернуть').addClass('act');
      else $(button).html('Развернуть').removeClass('act');
    });

    var top = $(parent).offset().top;
    $('html, body').animate({
      scrollTop: top - 150
    }, 200);
  });
});



// Popup
function readyGame() {
  $('#popup').show().animate({
    opacity: '1'
  }, 300);
  $('#popup .popup_content.ready_game').show().removeClass('fadeOutUp').addClass('fadeInDown');
  $('body').css({
    overflow: 'hidden'
  });
}

function closeGame() {
  $('#popup').animate({
    opacity: '0'
  }, 300).hide(50);
  $('#popup .popup_content').removeClass('fadeInDown').addClass('fadeOutUp');
  setTimeout(function() {
    $('#popup .popup_content').hide();
  }, 300);
  $('body').css({
    overflow: 'auto'
  });
}

function closeGameFormRating() {
  $('#popup .popup_content').removeClass('fadeInDown').addClass('fadeOutUp');
    $('#popup .popup_content').hide();
	$('#popup').show().animate({opacity: '1'}, 300);
	$('#popup .popup_content.myPopupCloseTicketRating').show().removeClass('fadeOutUp').addClass('fadeInDown');
	$('body').css({overflow: 'hidden'});
}

function closeGameFormSelect() {
  $('#popup .popup_content').removeClass('fadeInDown').addClass('fadeOutUp');
    $('#popup .popup_content').hide();
		$('#popup').show().animate({opacity: '1'}, 300);
		$('#popup .popup_content.myPopupCloseTicketSelect').show().removeClass('fadeOutUp').addClass('fadeInDown');
		$('body').css({overflow: 'hidden'});
}

function twitchBind() {
    $.get("/stream/twitch/auth", function (url, status) {
        window.location.href = url;
    });
}

function setDonate(link) {
    $.post('/stream/twitch/store', { donate_link: link }, () => {
        this.closeGame();
    })
}

function twitchRemove() {
    $.get("/stream/twitch/delete", () => {
        this.closeGame();
        location.reload();
    });
}

function lobbyGame() {
  $('#popup .popup_content.ready_game').removeClass('fadeInDown').addClass('fadeOutUp');
  setTimeout(function() {
    $('#popup .popup_content').hide();
    $('#popup .popup_content.lobby_game').show().removeClass('fadeOutUp').addClass('fadeInDown');
  }, 300);
}

function tradeGame() {
  $('#popup').show().animate({
    opacity: '1'
  }, 300);
  $('#popup .popup_content.trade_links').show().removeClass('fadeOutUp').addClass('fadeInDown');
  $('body').css({
    overflow: 'hidden'
  });
}

function tradeOption() {
  $('#popup').show().animate({
    opacity: '1'
  }, 300);
  $('#popup .popup_content.option_for_trade').show().removeClass('fadeOutUp').addClass('fadeInDown');
  $('body').css({
    overflow: 'hidden'
  });
}


function myPopupCoinHistory() {
	$('#popup').show().animate({opacity: '1'}, 300);
	$('#popup .popup_content.myPopupCoinHistory').show().removeClass('fadeOutUp').addClass('fadeInDown');
	$('body').css({overflow: 'hidden'});
}
function myPopupCrashHistory() {
	$('#popup').show().animate({opacity: '1'}, 300);
	$('#popup .popup_content.myPopupCrashHistory').show().removeClass('fadeOutUp').addClass('fadeInDown');
	$('body').css({overflow: 'hidden'});
}
function myPopupCNBHistory() {
	$('#popup').show().animate({opacity: '1'}, 300);
	$('#popup .popup_content.myPopupCNBHistory').show().removeClass('fadeOutUp').addClass('fadeInDown');
	$('body').css({overflow: 'hidden'});
}
function myPopupGameInformation() {
	$('#popup').show().animate({opacity: '1'}, 300);
	$('#popup .popup_content.myPopupGameInformation').show().removeClass('fadeOutUp').addClass('fadeInDown');
	$('body').css({overflow: 'hidden'});
}
function myPopupStreamSettings() {
	$('#popup').show().animate({opacity: '1'}, 300);
	$('#popup .popup_content.myPopupStreamSettings').show().removeClass('fadeOutUp').addClass('fadeInDown');
	$('body').css({overflow: 'hidden'});
}
function myPopupBindAccount() {
	$('#popup').show().animate({opacity: '1'}, 300);
	$('#popup .popup_content.myPopupBindAccount').show().removeClass('fadeOutUp').addClass('fadeInDown');
	$('body').css({overflow: 'hidden'});
}

function myPopupCloseTicket() {
    $('#popup').show().animate({opacity: '1'}, 300);
    $('#popup .popup_content.myPopupCloseTicket').show().removeClass('fadeOutUp').addClass('fadeInDown');
    $('body').css({overflow: 'hidden'});
}

function myPopupCloseTicketSelect() {
    $('#popup').show().animate({opacity: '1'}, 300);
    $('#popup .popup_content.myPopupCloseTicketSelect').show().removeClass('fadeOutUp').addClass('fadeInDown');
    $('body').css({overflow: 'hidden'});
}
function myPopupCloseTicketRating() {
    $('#popup').show().animate({opacity: '1'}, 300);
    $('#popup .popup_content.myPopupCloseTicketRating').show().removeClass('fadeOutUp').addClass('fadeInDown');
    $('body').css({overflow: 'hidden'});
}
function myPopupNewTicket() {
    $('#popup').show().animate({opacity: '1'}, 300);
    $('#popup .popup_content.myPopupNewTicket').show().removeClass('fadeOutUp').addClass('fadeInDown');
    $('body').css({overflow: 'hidden'});
}

function betaGame() {
    $('#popup').animate({opacity: '0'}, 300).hide(50);
    $('#popup .popup_content').removeClass('fadeInDown').addClass('fadeOutUp');
    setTimeout(function(){
        $('#popup .popup_content').hide();
    }, 300);
    $('body').css({overflow: 'auto'});
    $('.beta_game').show().animate({bottom: '10px', right: '20px', opacity: '1'}, 500);
}
function closeBeta() {
    $('body').css({overflow: 'auto'});
    $('.beta_game').hide().animate({bottom: '50%', right: '50%', opacity: '0'}, 0);
}

function InitScrolls() {
    $(".scrollPro").mCustomScrollbar({
      setWidth: false,
      setHeight: false,
      setTop: 0,
      setLeft: 0,
      axis: "y",
      scrollbarPosition: "inside",
      scrollInertia: 500,
      autoDraggerLength: true,
      autoHideScrollbar: false,
      autoExpandScrollbar: false,
      alwaysShowScrollbar: 0,
      snapAmount: null,
      snapOffset: 0,
      mouseWheel: {
        enable: true,
        scrollAmount: "auto",
        axis: "y",
        preventDefault: false,
        deltaFactor: "auto",
        normalizeDelta: false,
        invert: false,
        disableOver: ["select", "option", "keygen", "datalist", "textarea"]
      },
      scrollButtons: {
        enable: false,
        scrollType: "stepless",
        scrollAmount: "auto"
      },
      keyboard: {
        enable: true,
        scrollType: "stepless",
        scrollAmount: "auto"
      },
      contentTouchScroll: 25,
      advanced: {
        autoExpandHorizontalScroll: false,
        autoScrollOnFocus: "input,textarea,select,button,datalist,keygen,a[tabindex],area,object,[contenteditable='true']",
        updateOnContentResize: true,
        updateOnImageLoad: true,
        updateOnSelectorChange: false,
        releaseDraggableSelectors: false
      },
      theme: "light",
      callbacks: {
        onInit: false,
        onScrollStart: false,
        onScroll: false,
        onTotalScroll: false,
        onTotalScrollBack: false,
        whileScrolling: false,
        onTotalScrollOffset: 0,
        onTotalScrollBackOffset: 0,
        alwaysTriggerOffsets: true,
        onOverflowY: false,
        onOverflowX: false,
        onOverflowYNone: false,
        onOverflowXNone: false
      },
      live: false,
      liveSelector: null
    });
  }
	//Заполнение шкалы для заданий
	$(document).ready(function(e) {
	    var rand = function(min, max) {
	        return Math.floor(arguments.length > 1 ? (max - min + 1) * Math.random() + min : (min + 1) * Math.random());
	    };
	    $('.load .line').width(0);
	    $('.challenge_block .item').each(function(i, el) {
	        var serv = $(el);
	        var count = $(el).find('.count .max').html();
	        var online = $(el).find('.count .min').html();
	        $(el).find('.line').animate({width:online/count*156}, 10);//значение 1000 является максимальным числом для заполнения, то есть при 1000 полоска будет полносьтю заполнена, но это значение можно менять так как вам удобно, например выставив 5000, полоска будет заполнена полностью только по достижению 5000.
	    });
	});
	//Скрыть\показать задания
	$(document).ready(function(e) {
	    $('body').on('click', '.challenge_block .title', function(){
	        $(this).parent().children('.challenge').slideToggle(200);
	    });
	});

	$(document).ready(function() {
    $('body').on('click', '.opt_go_btn', function(e){
        var top = $('#wrapper.bank_page').offset().top;
        $('body, html').animate({scrollTop: top}, 300);
        e.preventDefault();
    });
});
// Сколл в блоках
(function($) {
  $(window).load(function() {
    InitScrolls();
  });
})(jQuery);

/*===============================================
=            Доработки новых страниц            =
===============================================*/

/* Закрытие баннера (страница с рейтингами) */
$(document).ready(function(e) {
	$('body').on('click', '.rating-banner__close', function(){
		$(this).closest('.rating-banner').fadeOut(300);
	})
});
/* Закрытие баннера (страница с рейтингами) конец*/

/*Minigames animation*/

$(document).ready(function(e) {

$(window).load(function(){
	setTimeout(function () {
	   $(".minigames__coin-fail").css('transform', 'scale(1)');
	}, 3000);
});

$(".minigames__coin-side-item").click(function (evt) {
	evt.preventDefault();
	$(this).closest('.minigames__coin-side').find('.minigames__coin-side-item').removeClass('active');
		$(this).addClass('active');
});


$(".knb-bet__item").click(function (evt) {
	evt.preventDefault();
	if ( $(this).hasClass('active') ) {
		$(this).removeClass('active');
	} else {
		$('.knb-bet__item.active').removeClass('active');
		$(this).addClass('active');
	}
});

$(".result__coin-items .circle").click(function (evt) {
	evt.preventDefault();
	/*if ( $(this).hasClass('result-active') ) {
		$(this).removeClass('result-active');
	} else {
		$('.result__coin-items .circle.result-active').removeClass('result-active');
		$(this).addClass('result-active');
	}*/
});

$(".result__knb-choise-item").click(function (evt) {
	evt.preventDefault();
	$(this).closest('.result__knb-choise').find('.result__knb-choise-item').removeClass('knb-active');
	$(this).addClass('knb-active');
});


$(".minigames__coin-left-bottom-item").click(function (evt) {
	evt.preventDefault();
	if ( $(this).hasClass('active') ) {
		$(this).removeClass('active');
	} else {
		$('.minigames__coin-left-bottom-item.active').parent().removeClass('active');
		$(this).addClass('active');
	}
 });

$(".minigames__coin-side-ava").click(function (evt) {
	evt.preventDefault();
	if ( $(this).hasClass('active') ) {
		$(this).removeClass('active');
	} else {
		$('.minigames__coin-side-ava.active').parent().removeClass('active');
		$(this).addClass('active');
	}
 });

$(".minigames__item.crash").click(function (evt) {
	evt.preventDefault();
	$(this).closest('.minigames__wrap').find(".minigames__coin-wrap-first").fadeIn('300');
	// $(".minigames__coin-wrap-first").fadeIn('300');
});

$(".minigames__coin-wrap-first .skill_close").click(function (evt) {
	evt.preventDefault();
	$(this).closest('.minigames__wrap').find(".minigames__coin-wrap-first").fadeOut('300');
	// $(".minigames__coin-wrap-first").fadeOut('300');
});

$(".minigames__item.coin").click(function (evt) {
	evt.preventDefault();
	$(this).closest('.minigames__wrap').find(".minigames__coin-wrap-second").fadeIn('300');
	// $(".minigames__coin-wrap-second").fadeIn('300');
});

$(".minigames__coin-wrap-second .skill_close").click(function (evt) {
	evt.preventDefault();
	$(this).closest('.minigames__wrap').find(".minigames__coin-wrap-second").fadeOut('300');
	// $(".minigames__coin-wrap-second").fadeOut('300');
});

$(".minigames__item.knb").click(function (evt) {
	evt.preventDefault();
	$(this).closest('.minigames__wrap').find(".minigames__coin-wrap-third").fadeIn('300');
	// $(".minigames__coin-wrap-third").fadeIn('300');
});

$(".minigames__coin-wrap-third .skill_close").click(function (evt) {
	evt.preventDefault();
	$(this).closest('.minigames__wrap').find(".minigames__coin-wrap-third").fadeOut('300');
	// $(".minigames__coin-wrap-third").fadeOut('300');
});


$('.minigames__main-left-top-rt-close-btn').on('click', function(){
	$(this).closest('.minigames__coin-wrap').fadeOut('300');
})

});

/* End Minigames animation*/

/*admin-ticket -tabs*/

$(function() {

	$('.admin-tickets__rt-top').on('click', 'a:not(.active)', function() {
		$(this)
		.addClass('active').siblings().removeClass('active')
		.closest('div.admin-tickets__rt-wrap').find('div.admin-tickets__rt-tab-item').removeClass('active').eq($(this).index()).addClass('active');
	});

});


/* FILTER*/

$(document).ready(function(e) {

	$(".player_ttl_filterBtn").on("click", function () {
		if ($(".player_ttl_filterDropdown").is(':visible')) $(".player_ttl_filterDropdown").removeClass('flipInX').addClass('bounceOut');
		if ($(".player_ttl_filterDropdown").is(':visible')) setTimeout(function(){$(".player_ttl_filterDropdown").hide()}, 500);
		else $(".player_ttl_filterDropdown").show().removeClass('bounceOut').addClass('flipInX');

	});

	$('body').on('click', ".tickets_modal-addUser-Btn", function () {
        if ($(".tickets_modal-addUser-Dropdown").is(':visible')) $(".tickets_modal-addUser-Dropdown").removeClass('flipInX').addClass('bounceOut');
        if ($(".tickets_modal-addUser-Dropdown").is(':visible')) setTimeout(function(){$(".tickets_modal-addUser-Dropdown").hide()}, 500);
        else $(".tickets_modal-addUser-Dropdown").show().removeClass('bounceOut').addClass('flipInX');
    });

	$('body').on('click', function(e) {
		if (!$(e.target).closest('.player_ttl_filter').length){
			$(".player_ttl_filterDropdown").removeClass('flipInX').addClass('bounceOut');
			setTimeout(function(){$(".player_ttl_filterDropdown").hide()}, 500);
		};
		if (!$(e.target).closest('.tickets_modal-addUser').length){
			$(".tickets_modal-addUser-Dropdown").removeClass('flipInX').addClass('bounceOut');
			setTimeout(function(){$(".tickets_modal-addUser-Dropdown").hide()}, 500);
		};
	});

});


/* FILTER END */


$(document).ready(function(e) {

	var minigamesSettingsBtn = $('.minigames__main-left-top-rt-btn'),
		minigamesSettingsDrop = $('.minigames__main-left-top-rt-dropdown');

	$('body').on('click', '.minigames__main-left-top-rt-btn', function() {
		var th = $(this),
			target = th.closest('.minigames__main').find('.minigames__main-left-top-rt-dropdown');

		if (th.hasClass('active')) {
			th.removeClass('active');
		} else {
			th.addClass('active');
		}

		if (target.hasClass('active')) {
			target.removeClass('active');
		} else {
			target.addClass('active');
		}
	});

	$('body').on('click touchstart', function(e){
		if(($(e.target).closest('.minigames__main-left-top-rt-btn').length === 0) && ($(e.target).closest('.minigames__main-left-top-rt-dropdown')).length === 0){
			$('.minigames__main-left-top-rt-btn').removeClass('active');
			$('.minigames__main-left-top-rt-dropdown').removeClass('active');
		}
	})


	var counter = $(".counter").spinner();

	$(".counter").each(function(){
		var count = $(this).attr('step');
		$(this).spinner({
			step: count,
			min: 0
		});
	});


	var animateGame = $('.minigames__item-animate'),
		animateIcon = $('.minigames__item-animate .minigames__item-icon_crash'),
		duration = 2100;


	function animateItem() {
		animateGame.addClass('minigames__item-explosion');
		animateIcon.addClass('minigames__item-icon_crash-white');

		setTimeout(function(){
			animateGame.removeClass('minigames__item-explosion');
			animateIcon.removeClass('minigames__item-icon_crash-white');
		}, duration);
	}

	$('.animate-game').on('click', function(){
		animateItem();
	})

	var inputSearch = $('.js-input-search');
	var inputSearchWrap = inputSearch.closest('.admin-tickets__nav-search');
	var inputSearchBtn = inputSearchWrap.find('.js-input-submit');

	inputSearch.on('focus', function(){
		inputSearchWrap.addClass('active');
	})

	$('body').on('click', function(e){
		if(($(e.target).closest(inputSearchBtn).length === 0) && ($(e.target).closest(inputSearch).length === 0)){
			inputSearchWrap.removeClass('active');
		}
	})

	// function checkMsgPosition() {
	// 	var msg = $('.tickets__one-msg'),
	// 		msgTop = msg.offset().top,
	// 		scrollTop = $(window).scrollTop(),
	// 		winH = $(window).height(),
	// 		wrap = $('.tickets__one-wrap'),
	// 		bodyHeight = $('body').height(),
	// 		position = msgTop - scrollTop - winH,
	// 		wrapH = wrap.height(),
	// 		wrapTop = wrap.offset().top,
	// 		posWrap = wrapTop - scrollTop - wrapH;

	// 	console.log(position, winH, posWrap, wrapH);

	// 	if (position > 0 || -position > winH) {
	// 		msg.addClass('tickets__one-msg_fixed');
	// 	}
	// 	if (!(posWrap > 0 || -posWrap > wrapH)) {
	// 		msg.removeClass('tickets__one-msg_fixed');
	// 	}
	// }

	// checkMsgPosition();

	// $(window).on('scroll', checkMsgPosition);
});


/*=====  End of Доработки новых страниц  ======*/

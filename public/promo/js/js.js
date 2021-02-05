$(document).ready(function(){
	$('.nav-left .activ, .leftSub').hover(function(){
		$('.leftSub').addClass('act');
	}, function(){
		$('.leftSub').removeClass('act');
	});
	$('.nav-right .activ, .rightSub').hover(function(){
		$('.rightSub').addClass('act');
	}, function(){
		$('.rightSub').removeClass('act');
	});
});

$(document).ready(function(){
	$('.with_title').each(function(){
		var title = $(this).attr('title');
		$(this).append('<div class="link_title">'+title+'</div>');
		var width = $(this).find('.link_title').width();
		$(this).find('.link_title').css({left: '50%', marginLeft: - width / 2});
        $(this).attr('title', '');
	});
});

$(document).ready(function(){
	// показ доп строки инфорации в списке активных серверов
	$('.game_list_block .show_sets, .game_list_block .tsets .tsets_link .close_tsets').click(function(){
		$('.game_list_block .tsets').slideToggle(100);
	});
	// увеличение и уменьшение высоты списка активных серверов
    list = 1;
    $('.show_sets2').click(function(){
        if (list == 1) {
            $('.game_list_block .tbody').animate({height: '530px'}, 300);
            $(this).addClass('active');
            list = 2;
        } else if (list == 2) {
            $('.game_list_block .tbody').animate({height: '264px'}, 300);
            list = 1;
            $(this).removeClass('active');
        }
    });
    // причина дизлайка
    $('.dislike_form').hide();
    $('.praised .dislike').click(function(){
        $('.dislike_form').show();
    });
    // ативный вариант пополнения счёта
    $('.option_links li').click(function(){
        $('.option_links li').removeClass('active');
        $(this).addClass('active');
    });
});

$(document).ready(function(){
	// добавление и удаление предметов в сделке
    $('.bank_items .item').each(function(index, act){
        var index = index + 1;
        $(this).addClass('item'+index);
        $(this).addClass('no-active');
        $(this).attr('data-index', 'item'+index);
    });
    $('.bank_items .item .count').each(function(){
        var prize = $(this).html();
        $(this).attr('data-prize', prize);
    });
    // добавление предмета в сделку
     $('.bank_items').on('click', '.item.no-active', function(){
        $(this).removeClass('no-active').addClass('active');
        var ind = $(this).attr('data-index');
        var name = $(this).find('div.text span').html();
        var count = $(this).find('div.count').html();
        $('.bank_deal_items').append('<div class="item '+ind+'" data-index="'+ind+'"><div class="name">'+name+'</div><div class="count"><span>'+count+'</span></div><a class="delete"></a></div>');
        var sum = $('.bank_deal .title span').html() * 1;
        var prize = $(this).find('div.count').html() * 1;
        var result = sum + prize;
        $('.bank_deal .title span').html(result);
    });
     // убрать предмет с сделки
    $('.bank_items').on('click', '.item.active', function(){
        $(this).removeClass('active').addClass('no-active');
        var ind = $(this).attr('data-index');
        var cls = '.' + ind;
        $('.bank_deal_items').find(cls).remove();
        var sum = $('.bank_deal .title span').html() * 1;
        var prize = $(this).find('div.count').html() * 1;
        var result = sum - prize;
        $('.bank_deal .title span').html(result);
    });
    // убрать предмет с сделки
    $('.bank_deal').on('click', 'a.delete', function(){
        $(this).parent().remove();
        var data = $(this).parent().attr('data-index');
        var cls = '.' + data;
        $(cls).removeClass('active').addClass('no-active');
        var sum = $('.bank_deal .title span').html() * 1;
        var prize = $(cls).find('div.count').html() * 1;
        var result = sum - prize;
        $('.bank_deal .title span').html(result);
    });
});

$(document).ready(function(){
	// редактирование информации в профиле
    $('body').on('mouseenter', '#general .prof_top .prof_data', function(){
        $('#general').removeClass('profile_vision');
    });
    $('body').on('mouseleave', '#general .prof_top .prof_data', function(){
        $('#general').addClass('profile_vision');
    });
    $('body').on('click', '.prof_top .prof_data', function(){
            $('.prof_top .prof_data input').addClass('active');
            $('.prof_top .prof_data textarea').addClass('active');
            $('.social_block').addClass('active');
    });
    $('body').on('click', '.profile_vision', function(){
        $('.prof_top .prof_data input').removeClass('active');
        $('.prof_top .prof_data textarea').removeClass('active');
        $('.social_block').removeClass('active');
        $('.soc_block_form').removeClass('active');
    });
    // Добавление соц иконки
    $('.social_block_item').append('<div class="item empty">' +
            '<a class="intro"><img src=""></a>' +
            '<div class="social_block_icons">' +
                '<div class="soc_icon"><img src="/promo/images/profile/icon/ico-1.png"></div>' +
                '<div class="soc_icon"><img src="/promo/images/profile/icon/ico-2.png"></div>' +
                '<div class="soc_icon"><img src="/promo/images/profile/icon/ico-3.png"></div>' +
                '<div class="soc_icon"><img src="/promo/images/profile/icon/ico-4.png"></div>' +
                '<div class="soc_icon"><img src="/promo/images/profile/icon/ico-5.png"></div>' +
                '<div class="soc_icon"><img src="/promo/images/profile/icon/ico-6.png"></div>' +
                '<div class="soc_icon"><img src="/promo/images/profile/icon/ico-7.png"></div>' +
                '<div class="soc_icon"><img src="/promo/images/profile/icon/ico-8.png"></div>' +
                '<div class="soc_icon"><img src="/promo/images/profile/icon/ico-9.png"></div>' +
            '</div>' +
        '</div>'
    );
    // Авто ширина блока иконок
    $('.social_block_icons').each(function(){
        var soc = $(this).find('.soc_icon').length;
        $(this).css({width: 40*soc, left: '50%', marginLeft: -40*soc/2-3});
    });
    // Добавление соц иконки
    $('body').on('click', '.item.empty .soc_icon', function(){
        $('.social_block_item').append('<div class="item empty">' +
                '<a class="intro"><img src=""></a>' +
                '<div class="social_block_icons">' +
                    '<div class="soc_icon"><img src="/promo/images/profile/icon/ico-1.png"></div>' +
                    '<div class="soc_icon"><img src="/promo/images/profile/icon/ico-2.png"></div>' +
                    '<div class="soc_icon"><img src="/promo/images/profile/icon/ico-3.png"></div>' +
                    '<div class="soc_icon"><img src="/promo/images/profile/icon/ico-4.png"></div>' +
                    '<div class="soc_icon"><img src="/promo/images/profile/icon/ico-5.png"></div>' +
                    '<div class="soc_icon"><img src="/promo/images/profile/icon/ico-6.png"></div>' +
                    '<div class="soc_icon"><img src="/promo/images/profile/icon/ico-7.png"></div>' +
                    '<div class="soc_icon"><img src="/promo/images/profile/icon/ico-8.png"></div>' +
                    '<div class="soc_icon"><img src="/promo/images/profile/icon/ico-9.png"></div>' +
                '</div>' +
            '</div>'
        );
        $('.social_block_icons').each(function(){
            var soc = $(this).find('.soc_icon').length;
            $(this).css({width: 40*soc, left: '50%', marginLeft: -40*soc/2-3});
        });

        var img = $(this).find('img').attr('src');
        var par = $(this).parent();
        $(par).parent().children('.intro').attr('title', 'Нажмите что бы изменить ссылку');
        $(par).parent().children('.intro').find('img').attr('src', img);
        $(par).parent().removeClass('empty').addClass('active');
        $(par).parent().append('<div class="soc_block_link">' +
                '<a class="switch_soc_item" title="Изменить"></a>' +
                '<a class="delete_soc_item" title="Удалить"></a>' +
            '</div>'
        );
    });
    // Изменение соц иконки
    $('body').on('click', '.switch_soc_item', function(){
        var par = $(this).parent();
        $(par).parent().addClass('active new_soc');
    });
    $('.social_block_item').on('mouseleave', '.item.active', function(){
        $(this).removeClass('new_soc');
    });

    $('body').on('click', '.item.active.new_soc .soc_icon', function(){
        var img = $(this).find('img').attr('src');
        var par = $(this).parent();
        $(par).parent().children('.intro').find('img').attr('src', img);
    });
    // Удаление соц иконки
    $('body').on('click', '.delete_soc_item', function(){
        var par = $(this).parent();
        $(par).parent().remove();
    });
    // Появление запись ссылки для соц сети
    $('body').on('click', '.social_block_item .item.active .intro', function(e){
        $('.soc_block_form').addClass('active');
        e.preventDefault();
    });
    $('.prof_tab_nav li:first').addClass('active');
    $('.prof_tab_nav li').click(function(e){
        $('.prof_tab_nav li').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
});

$(document).ready(function(){
	// показ скрытых блоков
	$('#death_detail, #tournament_detail, #stream_detail, #rank_stats_block').hide().addClass('animated');
    $('.show_more_info#showMore').append('<span class="moreSpan">СМОТРЕТЬ МЕНЬШЕ</span>');
	$('a#showMore').click(function(e){
		var href = $(this).attr('href');
		e.preventDefault();
		if ($(href).is(':visible')) $(href).removeClass('flipInX').addClass('bounceOut'),
            $(this).removeClass('UP'),
            $(this).css({fontSize: '12px'}),
            $(this).find('span.moreSpan').css({fontSize: '0px'});
		if ($(href).is(':visible')) setTimeout(function(){$(href).hide()}, 500);
		else $(href).show().removeClass('bounceOut').addClass('flipInX'),
            $(this).addClass('UP'),
            $(this).css({fontSize: '0px'}),
            $(this).find('span.moreSpan').css({fontSize: '12px'});
		var height = $(href).height();
		var top = $(href).offset().top - height;
		$('html, body').animate({scrollTop: top},500);
	});
	// показ скрытых блоков при клике на регистрацию команды, а также смена надписи на кнопке показа
    $('#showMoreTour').click(function(e){
        var href = $(this).attr('href');
        e.preventDefault();
        if ($(href).is(':visible')) $(href).removeClass('flipInX').addClass('bounceOut'),
            $('.show_more_info.showMoreStyle').removeClass('UP'),
            $('.show_more_info.showMoreStyle').css({fontSize: '12px'}),
            $('.show_more_info.showMoreStyle').find('span.moreSpan').css({fontSize: '0px'});
        if ($(href).is(':visible')) setTimeout(function(){$(href).hide()}, 500);
        else $(href).show().removeClass('bounceOut').addClass('flipInX'),
            $('.show_more_info.showMoreStyle').addClass('UP'),
            $('.show_more_info.showMoreStyle').css({fontSize: '0px'}),
            $('.show_more_info.showMoreStyle#showMore').find('span.moreSpan').css({fontSize: '12px'});
        var height = $(href).height();
        var top = $(href).offset().top - height;
        $('html, body').animate({scrollTop: top},500);
    });
});

$(document).ready(function(){
	$(window).resize(function(){
		var width = $('.dream_team .item').width();
		$('.dream_team .item').css({height: width});
    });
    $(window).resize();

    $('.land_era .item ul').each(function(){
        var li = $(this).find('li');
        $(li).hover(function() {
            $(li).addClass('disable');
            $(this).removeClass('disable');
        }, function() {
            $(li).removeClass('disable');
        });
    });


});

// Скролл в блоках
(function($){
            $(window).load(function(){

                /* all available option parameters with their default values */
                $(".scrollPro").mCustomScrollbar({
                    setWidth:false,
                    setHeight:false,
                    setTop:0,
                    setLeft:0,
                    axis:"y",
                    scrollbarPosition:"inside",
                    scrollInertia:500,
                    autoDraggerLength:true,
                    autoHideScrollbar:false,
                    autoExpandScrollbar:false,
                    alwaysShowScrollbar:0,
                    snapAmount:null,
                    snapOffset:0,
                    mouseWheel:{
                        enable:true,
                        scrollAmount:"auto",
                        axis:"y",
                        preventDefault:false,
                        deltaFactor:"auto",
                        normalizeDelta:false,
                        invert:false,
                        disableOver:["select","option","keygen","datalist","textarea"]
                    },
                    scrollButtons:{
                        enable:false,
                        scrollType:"stepless",
                        scrollAmount:"auto"
                    },
                    keyboard:{
                        enable:true,
                        scrollType:"stepless",
                        scrollAmount:"auto"
                    },
                    contentTouchScroll:25,
                    advanced:{
                        autoExpandHorizontalScroll:false,
                        autoScrollOnFocus:"input,textarea,select,button,datalist,keygen,a[tabindex],area,object,[contenteditable='true']",
                        updateOnContentResize:true,
                        updateOnImageLoad:true,
                        updateOnSelectorChange:false,
                        releaseDraggableSelectors:false
                    },
                    theme:"light",
                    callbacks:{
                        onInit:false,
                        onScrollStart:false,
                        onScroll:false,
                        onTotalScroll:false,
                        onTotalScrollBack:false,
                        whileScrolling:false,
                        onTotalScrollOffset:0,
                        onTotalScrollBackOffset:0,
                        alwaysTriggerOffsets:true,
                        onOverflowY:false,
                        onOverflowX:false,
                        onOverflowYNone:false,
                        onOverflowXNone:false
                    },
                    live:false,
                    liveSelector:null
                });

            });
})(jQuery);


$(document).ready(function(){
    var w = $('.over-chat').width();
    $('.content-over-chat .left-chat').css({width: w-40-333-35});

    // var x = $('.over-tabs-chat').width();
    // $('.over-tabs-chat .over-tabs-inner-chat').css({width: x-200-70});

    $(window).resize(function(){
        var w = $('.over-chat').width();
        $('.content-over-chat .left-chat').css({width: w-40-333-35});

        // var x = $('.over-tabs-chat').width();
        // $('.over-tabs-chat .over-tabs-inner-chat').css({width: x-200-70});
    });
    $(window).resize();
});

$(document).ready(function(){
    var win = $(window).scrollTop();
    var h = $(window).height();
    var c = $('.over-chat').height();
    $('.over-chat').css({top: h-c+win});
    $('.over-chat').hide();

});
$(window).scroll(function() {
    var win = $(window).scrollTop();
    var h = $(window).height();
    var c = $('.over-chat').height();
    $('.over-chat').css({top: h-c+win});
});

$(document).ready(function(){
    $('body').on('click', '.right-chat .over-chat-title .link a', function(e){
        $('.right-chat .over-chat-title .link a').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
/*
    $('.users-chat .item-chat .title').each(function(){
        var a = $(this).parent().children('.content');
        var t = $(this);
        setTimeout(function(){
            if ($(a).is(':visible')) $(t).removeClass('plus').addClass('minus');
            else $(t).removeClass('minus').addClass('plus');
        }, 220);
    });
*/
    $('body').on('click', '.users-chat .item-chat .title', function(e){
        var a = $(this).parent().children('.content');
        $(a).slideToggle(200);
        var t = $(this);
        setTimeout(function(){
            if ($(a).is(':visible')) $(t).removeClass('plus').addClass('minus');
            else $(t).removeClass('minus').addClass('plus');
        }, 220);
    });

    $('body').on('click', '.show-over-chat', function(){
        $('.over-chat').show().animate({marginTop: '0'}, 300);

    });
    $('body').on('click', '.left-chat .over-chat-title .link a.close', function(){
        $('.over-chat').animate({marginTop: '1000px'}, 300).hide(30);
    });

    $('body').on('click', '.left-chat .over-chat-title .link a.start', function(){
        var ww = $(window).height();
        var cc = $('.content-over-chat').height();
        $('.content-over-chat, .content-over-chat .left-chat, .content-over-chat .right-chat').animate({height: ww}, 200);
        var hh = $('.content-over-chat .left-chat .send-over-chat').height();
        $('.content-over-chat .left-chat .send-over-chat').animate({height: ww-cc+hh}, 200);
        var rr = $('.right-chat .users-chat').height();
        $('.right-chat .users-chat').animate({height: ww-cc+rr}, 200);
        $(this).html('Свернуть').removeClass('start').addClass('end');
    });

    $('body').on('click', '.left-chat .over-chat-title .link a.end', function(){
        $(this).html('Развернуть').removeClass('end').addClass('start');
        $('.content-over-chat, .content-over-chat .left-chat').animate({height: '435px'}, 200);
        $('.content-over-chat .right-chat').animate({height: '400px'}, 200);
        $('.content-over-chat .left-chat .send-over-chat').animate({height: '270px'}, 200);
    });
});

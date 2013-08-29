/* Funzione per i tabs */

function switch_tabs(obj, tabContent) {
    $(tabContent).hide();
    obj.closest('ul').children().children('a').removeClass("active");
    var id = obj.attr("rel");

    $('#' + id).show();
    obj.addClass("active");
}

function switch_class_tabs(obj, tabContent) {
    $(tabContent).hide();
    obj.closest('ul').children().children('a').removeClass("active");
    var id = obj.attr("rel");

    $('.' + id).show();
    obj.addClass("active");
}

/*---------------------------*/

/*   attivazioni varie */

/*---------------------------*/

function showThis(idOfObj) {
    $(idOfObj).fadeIn(250);
    $('html').click(function() {
        $(idOfObj).fadeOut(250);
    });
}

loadContentCache = [];
loadContentPreload = [];
loadContenteReady = true;

function loadContent(url, target, idOfObj, param) {
    if (!param) {
        param = {};
    }
    key = url + target + idOfObj + serialize(param);
    $(idOfObj).fadeIn(250).append('<div id="preloader-icon">&nbsp;</div>');
    if (loadContenteReady) {
        loadContenteReady = false;
        if (!loadContentCache.find(key)) {
            loadContentCache.add(key);
            spinnerButBlack.spin();
            $('#preloader-icon').append(spinnerButBlack.el);
            $.ajax({
                url: url,
                data: param,
                context: document.body,
                success: function(data) {
                    loadContentPreload[key] = data;
                    $(target).html(data);
                    spinnerButBlack.stop();
                    removeObj('#preloader-icon');

                    $('html').click(function() {
                        $(idOfObj).fadeOut(250);
                    });
                    $(target).click(function(event) {
                        event.stopPropagation();
                    });

                    loadContenteReady = true;
                }
            })
        } else {
            $(target).html(loadContentPreload[key]);
            $('html').click(function() {
                $(idOfObj).fadeOut(250);
            });
            $(target).click(function(event) {
                event.stopPropagation();
            });
            loadContenteReady = true;
        }
    }
}

function setPositionBallon(_baloon, _target) {
    baloon = $('#' + _baloon);
    target = $('#' + _target).offset();
    baloon.offset({
        left: target.left,
        top: target.top + 10
    });
}
function scrollTo(o, s) {
    var d = $(o).offset().top;
    $("html:not(:animated),body:not(:animated)").animate({
        scrollTop: d
    }, s, 'swing');
}


is_explorer = navigator.appName == "Microsoft Internet Explorer";

function removeFile(url) {
    $.ajax({
        url: url,
        type: 'DELETE',
        success: function(msg) {
            //alert(msg);
        }
    });
}

function attivaFancybox() {
    $('.fancybox').fancybox({
        hideOnOverlayClick: false,
        transitionIn: 'elastic',
        padding: 3,
        margin: 0
    });
}

$(document).ready(function() {
    attivaFancybox();
    $(".autogrow").autoGrow();
});
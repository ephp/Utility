function crossfade(classe, time, fade, index) {
    if (!time) {
        time = 5000;
    }
    if (!fade) {
        fade = 1000;
    }
    if (!index) {
        index = 1;
    }
    var min = 1; 
    var max = $('.' + classe).length; 
    if (index > max) {
        index = max;
    }
    $('.' + classe).hide();
    $('#' + classe + '-' + index).show();
    setInterval(function() {
        var next = index + 1;
        if(next > max) {
            next = 1;
        }
        $('#' + classe + '-' + index).slideToggle(fade);
        $('#' + classe + '-' + next).slideToggle(fade);
        index = next;
    }, time);
}

function autoupdateDiv(classe) {
    $('.' + classe).blur(function(){
        var r = null;
        var rp = {};
        var u = null;
        var p = {};
        if($(this).attr('route')) {
            r = $(this).attr('route');
        }
        if($(this).attr('route-param')) {
            rp = JSON.parse($(this).attr('route-param'));
        }
        if($(this).attr('url')) {
            u = $(this).attr('url');
        }
        if($(this).attr('param')) {
            p = JSON.parse($(this).attr('param'));
        }
        var v = $(this).html();
        var f = $(this).attr('name');
        p = Object.merge({v: v, f: f}, p);
        if(r) {
            $.post(Routing.generate(r, rp), p, function(data) {
                console.log(data);
            });
        } else if(u) {
            $.post(u, p, function(data) {
                console.log(data);
            });
        } else {
            alert('Specificare il parametro "route" o il parametro "url"')
        }
    });
    
}

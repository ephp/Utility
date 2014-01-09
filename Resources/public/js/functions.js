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
        if (next > max) {
            next = 1;
        }
        $('#' + classe + '-' + index).slideToggle(fade);
        $('#' + classe + '-' + next).slideToggle(fade);
        index = next;
    }, time);
}

function autoupdateDiv(classe) {
    var old = null;
    var btn = false;
    $('.' + classe)
            .focus(function() {
                old = $(this).html();
            })
            .keyup(function() {
                if (old === $(this).html()) {
                    if (btn) {
                        $('#autoupdate-btn').remove();
                        btn = false;
                    }
                } else {
                    if (!btn) {
                        $(this).after('<button type="button" id="autoupdate-btn" class="btn">'+i18n('Save')+'</button>');
                        btn = true;
                    }
                }
            })
            .blur(function() {
                if (btn) {
                    var $this = $(this);
                    var r = null;
                    var rp = {};
                    var u = null;
                    var p = {};
                    if ($this.attr('route')) {
                        r = $this.attr('route');
                    }
                    if ($this.attr('route-param')) {
                        rp = JSON.parse($this.attr('route-param'));
                    }
                    if ($this.attr('url')) {
                        u = $this.attr('url');
                    }
                    if ($this.attr('param')) {
                        p = JSON.parse($this.attr('param'));
                    }
                    var v = $this.html();
                    var f = $this.attr('name');
                    p = Object.merge({v: v, f: f}, p);
                    if (r) {
                        u = Routing.generate(r, rp);
                    }
                    if (u) {
                        $('#autoupdate-btn').text(i18n('Saving'));
                        $.post(u, p, function(data) {
                            $('#autoupdate-btn').text(i18n('Saved'));
                            $('#autoupdate-btn').fadeOut(function() {
                                $('#autoupdate-btn').remove();
                            });
                        });
                    } else {
                        alert('Specificare il parametro "route" o il parametro "url"')
                    }
                }
            });

}

function i18n(frase, dominio) {
    if(window.Translator) {
        if(dominio) {
            return Translator.trans(frase, {}, dominio);
        } else {
            return Translator.trans(frase);
        }
    } else {
        return frase;
    }
}
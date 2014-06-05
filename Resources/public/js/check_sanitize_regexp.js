function sanitize(fields) {
    fields.forEach(function(field) {
        field.change(function() {
            $(this).val($(this).val().remove(/[^a-zA-Z0-9 \-\_\.\,\;\:\'\?\!\"àéèìòù]/g / s));
        });
    });
}

function urlify(text) {
    var urlRegex = /(https?:\/\/[^\s\<]+)/g;
    return text.replace(urlRegex, function(url) {
        return '<a href="' + url + '">' + url + '</a>';
    });
}

function sanitizeDate(fields) {
    fields.forEach(function(field) {
        field.change(function() {
            value = $(this).val().toLowerCase();
            if(value === '') {
                return false;
            }
            d = new Date();
            if (value.endsWith('gg') || value === 'oggi' || value === 'domani') {
                switch (value) {
                    case '0gg':
                    case 'oggi':
                        break;
                    case '1gg':
                    case 'domani':
                        d = calcolaData(d, 1);
                        break;
                    default:
                        nd = parseInt(value.substr(0, value.length - 2));
                        d = calcolaData(d, nd);
                        break;
                }
                g = d.getUTCDate() < 10 ? '0'+d.getUTCDate() : d.getUTCDate();
                m = d.getUTCMonth() < 9 ? '0'+(d.getUTCMonth() + 1) : (d.getUTCMonth() + 1);
                a = d.getUTCFullYear();
                $(this).val(g+'/'+m+'/'+a);
            } else {
                numeri = $(this).val().replace(/\-/g, "/").replace(/\./g, "/").replace(/\//g, " ").words();
                if(numeri.length === 3) {
                    d.setUTCFullYear(parseInt(numeri[2], 10) < 100 ? 2000 + parseInt(numeri[2], 10) : parseInt(numeri[2], 10));
                    d.setUTCMonth(parseInt(numeri[1], 10));
                    d.setUTCDate(parseInt(numeri[0], 10));
                } 
                g = parseInt(d.getUTCDate()) < 10 ? '0'+d.getUTCDate() : d.getUTCDate();
                m = parseInt(d.getUTCMonth()) === 0 ? 12 : (d.getUTCMonth() < 10 ? '0'+(d.getUTCMonth()) : (d.getUTCMonth()));
                a = d.getUTCFullYear() - (parseInt(m) === 12 ? 1 : 0);
                $(this).val(g+'/'+m+'/'+a);
            }
        });
    });
}
function calcolaData(date, giorni) {
  var giorno = 86400000;
  var utc = Date.UTC(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate());
  var new_date = new Date(utc + giorni * giorno);
  return new_date;
}

function sanitizeCurrency(fields) {
    fields.forEach(function(field) {
        field.change(function() {
            value = $(this).val().replace(",", ".").remove(/[^0-9\.]/g);
            n = 0;
            i = 0;
            nc = 0;
            value.chars(function(c) {
                if (c === '.') {
                    n++;
                }
                if (n === 2) {
                    i = nc;
                    n++;
                }
                nc++;
            });
            if (n > 1) {
                value = value.substring(0, i);
                value = Math.abs(parseFloat(value === '' || value === '.' ? 0 : value));
                $(this).val(value.toFixed(2));
            } else {
                value = Math.abs(parseFloat(value === '' || value === '.' ? 0 : value));
                $(this).val(value.toFixed(2));
            }
        });
    });
}

function desanitizeCurrencyFormat(fields, decimali) {
    var regex = new RegExp('[^0-9\\'+decimali+']', 'g');
    fields.forEach(function(field) {
        console.log('desanitizza '+field.attr('id'), field.val(), field.val().replace(regex, '').replace(decimali, "."));
        var value = field.val().replace(regex, '').replace(decimali, ".");
        field.val(value);
    });
}

function sanitizeCurrencyFormat(fields, decimali, migliaia) {
    if(!decimali) {
        decimali = ',';
    }
    if(!migliaia) {
        migliaia = '.';
    }
    fields.forEach(function(field) {
        field.each(function() {
            _sanitizeCurrencyFormat($(this), decimali, migliaia);
        });
        field.change(function() {
            _sanitizeCurrencyFormat($(this), decimali, migliaia);
        });
    });
}

function _sanitizeCurrencyFormat(field, decimali, migliaia) {
    if (!field.val()) {
        return;
    }
    var format = new RegExp('^[0-9]+('+decimali+'|'+migliaia+')[0-9]{1,2}$');
    if(field.val().search(format) === 0) {
        field.val(field.val().replace(migliaia, decimali));
    }
    var regex = new RegExp('[^0-9\\'+decimali+']', 'g');
    value = field.val().replace(migliaia, "").remove(regex);
    n = 0;
    i = 0;
    nc = 0;
    value.chars(function(c) {
        if (c === decimali) {
            n++;
        }
        if (n === 2) {
            i = nc;
            n++;
        }
        nc++;
    });
    if (n > 1) {
        value = value.substring(0, i);
        value = Math.abs(parseFloat(value === '' || value === decimali ? 0 : value.replace(decimali, '.')));
        field.val(value.toFixed(2));
    } else {
        value = Math.abs(parseFloat(value === '' || value === decimali ? 0 : value.replace(decimali, '.')));
        field.val(value.toFixed(2));
    }
    field.val(parseFloat(field.val()).format(2, migliaia, decimali));
}

function sanitizeTelefono(fields) {
    fields.forEach(function(field) {
        field.change(function() {
            $(this).val($(this).val().remove(/[^0-9 \-\.]/g));
        });
    });
}
function sanitizeSkype(fields) {
    fields.forEach(function(field) {
        field.change(function() {
            $(this).val($(this).val().remove(/[^a-zA-Z0-9\-\.]/g));
        });
    });
}
function sanitizeUrl(fields) {
    fields.forEach(function(field) {
        field.change(function() {
            _sanitizeUrl($(this))
        });
    });
}
function _sanitizeUrl(field) {
    if (!field.val().startsWith(/http(s)?:\/\//) && field.val().trim() !== '') {
        field.val('http://' + field.val());
    }
}
function sanitizeHtml(fields) {
    fields.forEach(function(field) {
        field.change(function() {
            $(this).val(optimizeHtml($(this).val(), false));
        });
    });
}
function sanitizeHtmlMin(fields) {
    fields.forEach(function(field) {
        field.change(function() {
            $(this).val(optimizeHtml($(this).val(), true));
        });
    });
}
function optimizeHtml(val, min) {
    text = val;
    if (min) {
        text = text.stripTags('a', 'div', 'span', 'ol', 'ul', 'li', 'dl', 'dt', 'dd');
        text = text.removeTags('script', 'img', 'hr');
    } else {
        text = text.stripTags('a', 'div', 'span');
        text = text.removeTags('script', 'img', 'hr');
    }
    text = text.stripTags('table', 'tbody', 'tr', 'th', 'td', 'thead', 'h1', 'h2', 'h3', 'h4', 'h5', 'hr');
    text = text.remove(/<p>[ ]*<\/p>/g);
    text = text.remove(/<\/strong><strong>/g);
    text = text.remove(/<\/em><em>/g);
    text = text.replace(/\&nbsp\;/g, ' ');
    text = text.replace(/<\/strong>[ ]*<strong>/g, ' ');
    text = text.replace(/<\/em>[ ]*<em>/g, ' ');
    text = text.replace(/<li><p>/g, '<li>');
    text = text.replace(/<\/p><\/li>/g, '</li>');
    text = text.replace(/\\/g, '');

    //alert(text);

    return text;
}
function floatField(fields) {
    fields.forEach(function(field) {
        field.change(function() {
            $(this).val($(this).val().remove(/[^0-9\.\,]/g).replace(',', '.'));
        });
    });
}
function capitalize(fields) {
    fields.forEach(function(field) {
        field.change(function() {
            $(this).val($(this).val().capitalize());
        });
    });
}
function capitalizeAll(fields) {
    fields.forEach(function(field) {
        field.change(function() {
            $(this).val($(this).val().titleize());
        });
    });
}
function uppercase(fields) {
    fields.forEach(function(field) {
        field.change(function() {
            $(this).val($(this).val().toUpperCase());
        });
    });
}
function lowercase(fields) {
    fields.forEach(function(field) {
        field.change(function() {
            $(this).val($(this).val().toLowerCase());
        });
    });
}
function sanitize_regex(fields, regex) {
    fields.forEach(function(field) {
        field.change(function() {
            $(this).val($(this).val().remove(regex));
        });
    });
}
function autoCheckEmail(fields) {
    fields.forEach(function(field) {
        field.change(function() {
            $(this).val($(this).val().trim());
            if ($(this).val() !== '') {
                if (!checkEmail($(this).val())) {
                    fancyAlert('Email non valida');
                    $(this).val('');
                }
            }
        });
    });
}
function checkEmail(email) {
    re = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (email.match(re)) {
        return true;
    }
    return false;
}
function autoCheckSito(fields) {
    fields.forEach(function(field) {
        field.change(function() {
            $(this).val($(this).val().trim());
            if ($(this).val() !== '') {
                if (!checkSito($(this).val())) {
                    fancyAlert('Pagina internet non valida');
                    $(this).val('');
                }
            }
        });
    });
}
function checkSito(url) {
    re = /^http(s)?:\/\/[a-z0-9_\-\.]+(\.)[a-z]{2,4}/;
    if (url.match(re)) {
        return true;
    }
    return false;
}

function autoCheckCF(fields) {
    fields.forEach(function(field) {
        field.change(function() {
            $(this).val($(this).val().trim());
            if ($(this).val() != '') {
                if (!checkCF($(this).val()) && !checkPI($(this).val())) {
                    fancyAlert('Codie Fiscale non valido');
                    $(this).val('');
                }
            }
        });
    });
}
function checkCF(cf) {
    re = /^[a-zA-Z]{6}[0-9a-zA-Z]{2}[a-zA-Z]{1}[0-9a-zA-Z]{2}[a-zA-Z]{1}[0-9a-zA-Z]{3}[a-zA-Z]{1}$/;
    if (cf.match(re)) {
        return true;
    }
    return false;
}

function checkCAP(cap) {
    re = /^[0-9]{5}$/;
    if ((cap + '').match(re)) {
        return true;
    }
    return false;
}

function getMatchRegexp(subject, re) {
    var m = re.exec(subject);
    if (m === null) {
        return false;
    } else {
        var s = "";
        for (i = 0; i < m.length; i++) {
            s = s + m[i] + "\n";
        }
        return s;
    }
}

function setCampiObbligatori(check, callback) {
    ok = true;
    check.forEach(function(campo_form) {
        label = $('label[for="' + campo_form.attr('id') + '"]');
        label.addClass('obbligatorio');
        campo_form.change(function() {
            checkCampiObbligatori(check, callback);
        }).keyup(function() {
            checkCampiObbligatori(check, callback);
        });
        ok = ok && campo_form.val().trim() !== '';
    });
    checkCampiObbligatori(check, callback);
}

function checkCampiObbligatori(check, callback) {
    ok = true;
    check.forEach(function(campo_form) {
        ok = ok && (campo_form.val().trim() !== '');
        //alert(campo_form.attr('id')+' ('+(ok ? 1 : 0)+')');
    });
    eval(callback + '(' + (ok ? 'true' : 'false') + ')');
}

/* CONTROLLO ERRORE PER I FORM */
function erroreForm(campo, messaggio) {
    campo.closest('div').append('<div class="form-alert">' + messaggio + '</div>');
    campo.addClass('alert-red');
    campo.focus(function() {
        $(this).removeClass('alert-red');
    });
    return false;
}
/* PROTOTYPE PER STRINGHE */
String.prototype.swapcase = function() {
    return this.replace(/([a-z]+)|([A-Z]+)/g, function($0, $1, $2) {
        return ($1) ? $0.toUpperCase() : $0.toLowerCase();
    });
};
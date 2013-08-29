function fancyAlert(msg) {
    jQuery.fancybox({
        modal: true,
        padding: 3,
        margin: 0,
        content: "<div class=\"alert\"><h3>" + msg + "</h3><div style=\"text-align:center;margin-top:40px;\"><button class=\"button-orange large\" id=\"fancy-ok\" type=\"button\" onclick=\"jQuery.fancybox.close();\" >OK</button></div></div>"
    });
}

var fancyConfirmResult;
function fancyConfirm(msg, ok_txt, ko_txt, callback) {
    jQuery.fancybox({
        modal: true,
        padding: 3,
        margin: 0,
        content: "<div class=\"alert\"><h3>" + msg + "</h3><div style=\"text-align:right;margin-top:10px;\"><button id=\"fbc_ok\" onClick=\"javascript:fancyConfirmOk()\" class=\"button-orange large\" type=\"button\" value=\"" + ok_txt + "\">" + ok_txt + "</button><button id=\"fbc_ko\" onClick=\"javascript:fancyConfirmKo()\" class=\"button-orange large\" type=\"button\" id=\"fancyConfirm_cancel\" value=\"" + ko_txt + "\">" + ko_txt + "</button></div></div>",
        beforeClose: function() {
            eval(callback + "(" + (fancyConfirmResult ? "true" : "false") + ")");
        }
    });
}
function fancyConfirmOk() {
    fancyConfirmResult = true;
    jQuery.fancybox.close();
}
function fancyConfirmKo() {
    fancyConfirmResult = false;
    jQuery.fancybox.close();
}

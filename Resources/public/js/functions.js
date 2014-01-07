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

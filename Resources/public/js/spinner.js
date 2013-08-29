/* caratteristiche dello spinner js */

/* spinner standard per i campi grandi */

var opts = {
    lines: 62, // The number of lines to draw
    length: 2, // The length of each line
    width: 2, // The line thickness
    radius: 6, // The radius of the inner circle
    color: '#333', // #rgb or #rrggbb
    speed: 2, // Rounds per second
    trail: 20, // Afterglow percentage
    shadow: false, // Whether to render a shadow
    hwaccel: true, // Whether to use hardware acceleration
    opacity: 1 / 32
};

var optsbigdef = {
    lines: 64, // The number of lines to draw
    length: 4, // The length of each line
    width: 3, // The line thickness
    radius: 10, // The radius of the inner circle
    color: '#333', // #rgb or #rrggbb
    speed: 2, // Rounds per second
    trail: 20, // Afterglow percentage
    shadow: false, // Whether to render a shadow
    hwaccel: true, // Whether to use hardware acceleration
    opacity: 1 / 32
};

var optsbig = {
    lines: 64, // The number of lines to draw
    length: 4, // The length of each line
    width: 2, // The line thickness
    radius: 10, // The radius of the inner circle
    color: '#fff', // #rgb or #rrggbb
    speed: 2, // Rounds per second
    trail: 20, // Afterglow percentage
    shadow: false, // Whether to render a shadow
    hwaccel: true, // Whether to use hardware acceleration
    opacity: 1 / 8
};

var optsbigtab = {/* spinner grande per i tabs */
    lines: 64, // The number of lines to draw
    length: 8, // The length of each line
    width: 5, // The line thickness
    radius: 20, // The radius of the inner circle
    color: '#4C80B6', // #rgb or #rrggbb
    speed: 2, // Rounds per second
    trail: 20, // Afterglow percentage
    shadow: false, // Whether to render a shadow
    hwaccel: true, // Whether to use hardware acceleration
    opacity: 1 / 8
};

var optsbigfancy = {/* spinner grande per i tabs */
    lines: 16, // The number of lines to draw
    length: 0, // The length of each line
    width: 5, // The line thickness
    radius: 24, // The radius of the inner circle
    color: '#fff', // #rgb or #rrggbb
    speed: 1, // Rounds per second
    trail: 20, // Afterglow percentage
    shadow: true, // Whether to render a shadow
    hwaccel: true, // Whether to use hardware acceleration
    opacity: 1 / 8
};

var optsbar = {
    lines: 64, // The number of lines to draw
    length: 2, // The length of each line
    width: 2, // The line thickness
    radius: 6, // The radius of the inner circle
    color: '#fff', // #rgb or #rrggbb
    speed: 2, // Rounds per second
    trail: 20, // Afterglow percentage
    shadow: false, // Whether to render a shadow
    hwaccel: true, // Whether to use hardware acceleration
    opacity: 1 / 8
};

/* spinner piccolo per i bottoni scuri */

var optsbut = {
    lines: 64, // The number of lines to draw
    length: 1, // The length of each line
    width: 2, // The line thickness
    radius: 4, // The radius of the inner circle
    color: '#fff', // #rgb or #rrggbb
    speed: 2, // Rounds per second
    trail: 20, // Afterglow percentage
    shadow: false, // Whether to render a shadow
    hwaccel: true, // Whether to use hardware acceleration
    opacity: 1 / 8
};

/* spinner piccolo per i bottoni chiari */

var optsbutblack = {
    lines: 64, // The number of lines to draw
    length: 1, // The length of each line
    width: 2, // The line thickness
    radius: 4, // The radius of the inner circle
    color: '#333', // #rgb or #rrggbb
    speed: 2, // Rounds per second
    trail: 20, // Afterglow percentage
    shadow: false, // Whether to render a shadow
    hwaccel: true, // Whether to use hardware acceleration
    opacity: 1 / 32
};

/* definizione variabili spinners */

var spinnerDef = new Spinner(opts).spin(); // grigio medie dimensioni, da abbinare a "preloader" (uso di default)
var spinnerBigDef = new Spinner(optsbigdef).spin(); // grigio grande, da abbinare a "preloader"
var spinnerBig = new Spinner(optsbig).spin(); // bianco grande, da abbinare a "preloader-util"
var spinnerBigTab = new Spinner(optsbigtab).spin(); // bianco molto grande, da abbinare a "preloader-util" (usato per i grandi contenuti come i cambi di tab)
var spinnerBigFancy = new Spinner(optsbigfancy).spin(); // grigio molto grande, da abbinare Fancybox
var spinnerBar = new Spinner(optsbar).spin(); // da abbinare a "preloader-bar"
var spinnerBut = new Spinner(optsbut).spin(); // bianco piccolo, da abbinare a "preloader-button"
var spinnerButBlack = new Spinner(optsbutblack).spin(); // nero piccolo, da abbinare a "preloader-button"


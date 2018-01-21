// Initialisation jQuery
import $ from 'jquery';
global.$ = global.jQuery = $;

// Chargement Bootstrap
require('bootstrap-sass');
require('bootstrap-switch');

require('./prestages');

import PNotify from 'pnotify';
PNotify.prototype.options.styling = "bootstrap3";
window.PNotify = PNotify;
require('./pnotify');
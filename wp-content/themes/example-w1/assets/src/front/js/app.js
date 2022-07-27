import 'babel-polyfill';

window.$ = jQuery;

// import VueBootstrap from './vue/init';

// import Anchor from './plugins/Anchor';
import FaqAccordion from './plugins/FaqAccordion';
import AutoResizeTextarea from './plugins/AutoResizeTextarea';
import ShowHamburgerMenu from './plugins/ShowHamburgerMenu';
import NavExample from './plugins/NavExample';
import NightDayButton from './plugins/NightDayButton';




/**
 * Init Plugins
 */

document.addEventListener('DOMContentLoaded', () => {
    // schema: new Component().init();
    requestAnimationFrame(() => {
        [
            NightDayButton, FaqAccordion, AutoResizeTextarea, ShowHamburgerMenu, NavExample
        ]
    });
});

var delay;

$('a').click(function(e) {
    e.preventDefault();
    delay = 0;

    if ($(this).attr('href').split('#')[1] === 'whatwedo') {
        delay = 1000;
    }

    setTimeout(function() {
        // do scroll here
    },delay);
});
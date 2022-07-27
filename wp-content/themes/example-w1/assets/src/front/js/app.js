import 'babel-polyfill';

window.$ = jQuery;

// import VueBootstrap from './vue/init';

// import Anchor from './plugins/Anchor';
import FaqAccordion from './plugins/FaqAccordion';
import AutoResizeTextarea from './plugins/AutoResizeTextarea';
import ShowHamburgerMenu from './plugins/ShowHamburgerMenu';
import NavExample from './plugins/NavExample';
import NightDayButton from './plugins/NightDayButton';
import DelayAnchorScroll from './plugins/DelayAnchorScroll';
import ScrollTopButton from './plugins/ScrollTopButton';

/**
 * Init Plugins
 */

document.addEventListener('DOMContentLoaded', () => {
    // schema: new Component().init();
    requestAnimationFrame(() => {
        [
            NightDayButton, FaqAccordion, AutoResizeTextarea, ShowHamburgerMenu, NavExample, DelayAnchorScroll, ScrollTopButton
        ]
    });
});

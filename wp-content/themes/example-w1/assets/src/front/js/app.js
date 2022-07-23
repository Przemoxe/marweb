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


        let body = document.querySelector(":root");

        console.log(body)
        if(body.classList.contains('dark')){
            console.log('dark')
        }

        window.addEventListener("resize", function() {
            if (body.classList.contains("dark")) {
              console.log('dark')
            } else {
              console.log('day')
            }
          });


    });
});

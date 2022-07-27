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

// Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
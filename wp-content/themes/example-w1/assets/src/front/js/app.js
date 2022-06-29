
import FaqAccordion from './plugins/FaqAccordion';
import AutoResizeTextarea from './plugins/AutoResizeTextarea';
import ShowHamburgerMenu from './plugins/ShowHamburgerMenu';
import NavExample from './plugins/NavExample';
import NightDayButton from './plugins/NightDayButton';


document.addEventListener('DOMContentLoaded', () => {
    // schema: new Component().init();
    requestAnimationFrame(() => {
        [
            NavExample(), FaqAccordion(), AutoResizeTextarea(), ShowHamburgerMenu(), NightDayButton(), 
        ]
    
    });
});

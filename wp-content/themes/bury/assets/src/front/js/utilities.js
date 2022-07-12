import ScrollMagic from 'scrollmagic/scrollmagic/minified/ScrollMagic.min';

let debounceTimeout;

export function debounce(func, wait, immediate) {
  let context = this, args = arguments;
  let later = function() {

    debounceTimeout = null;
    if (!immediate) func.apply(context, args);
  };
  let callNow = immediate && !debounceTimeout;
  clearTimeout(debounceTimeout);

  debounceTimeout = setTimeout(later, wait);
  if (callNow) func.apply(context, args);
}

export const scrollController = new ScrollMagic.Controller();

const desktopBreakpoint = 1230;
const tabletBreakpoint = 768;

export class Breakpoint {
  static isMobile = () => window.innerWidth < tabletBreakpoint;
  static isTablet = () => window.innerWidth < desktopBreakpoint && window.innerWidth >= tabletBreakpoint;
  static isDesktop = () => window.innerWidth >= desktopBreakpoint;
}
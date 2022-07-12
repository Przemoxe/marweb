import Cookies from 'js-cookie/src/js.cookie.js';

export default class CookieNotice
{
    init() {
        var cookieElement = document.getElementById('cookie-notice');
        var cookieButton = document.getElementById('cn-accept-cookie');
        var headerElement = document.querySelector('header');
        var mainElement = document.querySelector('main');

        if(mainElement)
            mainElement.style.marginTop = headerElement.offsetHeight + "px";

        if (!cookieElement) return;

        var isAccepted = Cookies.get('cookies-accepted');

        let self = this;

        if (isAccepted === 'true')
            return ;
        else{
            cookieElement.classList.remove('is-clicked');
            cookieElement.classList.add('is-visible');
            self.heightOffset(cookieElement, headerElement, mainElement);
        }

        cookieButton.addEventListener('click', event => {
            self.submit(cookieElement, headerElement, mainElement);
        });
    }

    heightOffset(cookieElement, headerElement, mainElement) {
        if (!cookieElement || !headerElement || !mainElement ) return;

        if (cookieElement) {
            var cookieHeight = cookieElement.clientHeight;
           // var styleHeader = window.getComputedStyle(headerElement);
           // headerElement.style.marginTop = parseFloat(styleHeader.getPropertyValue('margin-top')) + cookieHeight + 'px';
            var styleMain = window.getComputedStyle(mainElement);
            mainElement.style.marginTop = parseFloat(styleMain.getPropertyValue('margin-top')) + 8 + cookieHeight + 'px';
        }
    }

    submit(cookieElement, headerElement, mainElement) {
        cookieElement.classList.remove('is-visible');
        cookieElement.classList.add('is-clicked');
        headerElement.removeAttribute("style");
        mainElement.style.marginTop = headerElement.offsetHeight + "px";
        Cookies.set('cookies-accepted', 'true');
    }
}

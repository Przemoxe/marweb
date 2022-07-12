
export default class StickyMenu
{
    init() {
        var branding = document.querySelector('.site-branding');
        var menu = document.querySelector('.content-menu');
        var button = document.querySelector('.hamburger-icon');
        var header;

        var lastScrollTop = 0;
        window.addEventListener("scroll", function (event) {
            var scrollHide = this.scrollY;
            header = document.querySelector('.header-expanded');

            if(header){
                if(scrollHide < header.offsetTop){
                    menu.classList.remove("expanded");
                    button.classList.remove("expanded");
                    header.classList.remove("header-expanded");
                    header.style.top = 0;
                }
            }
            else{
                if( scrollHide > 180) 
                {
                    branding.classList.add("hidden");
                    menu.classList.remove("expanded");
                    button.classList.remove("expanded");
                }
                else if(scrollHide < 22){
                    branding.classList.remove("hidden");
                }
            }

           // lastScrollTop = scrollHide;
        });
    }
}

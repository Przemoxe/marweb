
export default class Navigation
{
    constructor() {

    }
    init() {
        var menubutton = document.querySelector('.hamburger');
        
        menubutton.onclick = function(event) {
            var menu = document.querySelector('.content-menu');
            var button = document.querySelector('.hamburger-icon');
            var header = document.querySelector('header');

            menu.classList.toggle('expanded');
            button.classList.toggle('expanded');
            
            if(!header.classList.contains('header-expanded')){
                header.classList.add('header-expanded');
                header.style.top = window.scrollY + "px";
            }
            else{
                header.classList.remove('header-expanded');
                header.style.top = 0 + "px";
            }
            
            event.stopPropagation();
        }

        var menuitem = document.querySelectorAll('.site-branding .menu-item-has-children > .more');
        var isHidden;
        var dropItemHeight;
        
        if(window.innerWidth < 600){
            var menu = document.querySelector('.content-menu');
            menu.classList.toggle('expanded');
            var dropItem = document.querySelectorAll('.site-branding .menu-item-has-children');
            dropItem.forEach(el => {
                el.querySelector('.sub-menu').style.display = "none";
                dropItemHeight = el.offsetHeight;
                el.style.height = dropItemHeight + 4 + "px";
                el.querySelector('.sub-menu').style.display = "block";
            });         
            menu.classList.toggle('expanded');

            menuitem.forEach(el => {
                el.classList.add('hidden');
                el.onclick = function(event) {
                    if(el.classList.contains("hidden")) 
                        isHidden = true;
                    else    
                        isHidden = false;
    
                    menuitem.forEach(el => {
                        var submenu = el.nextElementSibling;                   
                        if(submenu) {       
                            el.parentElement.style.height = el.parentElement.offsetHeight - submenu.offsetHeight - 10 + "px";
                            submenu.classList.add("visible");
                        }
                        el.classList.add("hidden");                                 
                    });  
    
                    if(isHidden){
                        el.classList.remove("hidden");
                        var submenu = el.nextElementSibling;
                        if(submenu) {
                            submenu.classList.remove("visible");
                            el.parentElement.style.height = el.parentElement.offsetHeight + submenu.offsetHeight + 10 + "px";
                        }
                    }
                    else{
                        var submenu = el.nextElementSibling;                   
                        if(submenu) {       
                            submenu.classList.remove("visible");                
                            el.parentElement.style.height = el.parentElement.offsetHeight - submenu.offsetHeight - 10 + "px";
                            submenu.classList.add("visible");
                        }
                    }
                }
            });        
            
        }
    }
}

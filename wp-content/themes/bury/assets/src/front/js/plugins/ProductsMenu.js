
export default class ProductsMenu
{
    constructor() {

    }
    init() {
        var subMenuList = document.querySelectorAll('#product-menu .sub-menu__categories');
        var subMenuListCompetences = document.querySelectorAll('.competence-menu .sub-menu__categories');     
        var productsContainer = document.querySelector('.content-menu .products-container');
        var menu = document.querySelector('.content-menu');
        var productMenu = document.querySelector('#product-menu');
        var productMenuCompetences = document.querySelector('.competence-menu');
        var productMenuItem = document.querySelectorAll('.menu-right .menu-item');

        // Pobranie maksymalnych wysokości menu produktowego i kompetencji
        menu.classList.toggle('expanded');
        var maxHeight = 0;
        subMenuList.forEach(el => {
            
            if(el.offsetHeight > maxHeight)
                maxHeight = el.offsetHeight;

            el.classList.toggle('show');
        });

        var maxHeightCompetences = 0;
        subMenuListCompetences.forEach(el => {

            if(el.offsetHeight > maxHeightCompetences)
                maxHeightCompetences = el.offsetHeight;
       
            el.classList.toggle('show');
        });
       
        var productsMenuHeight = document.querySelector('.products-menu').offsetHeight;
        menu.classList.toggle('expanded');

        // Dostosowanie wysokości menu
        if(maxHeight > maxHeightCompetences)
            productsContainer.style.height = maxHeight + productsMenuHeight + "px";
        else
            productsContainer.style.height = maxHeightCompetences + productsMenuHeight + "px";

        // Dostosowanie wysokości podmenu
        this.setSubMenuHeight(subMenuList, maxHeight);
        this.setSubMenuHeight(subMenuListCompetences, maxHeightCompetences);

        this.checkWindowSize(productsContainer, maxHeight, maxHeightCompetences, productsMenuHeight);

        window.addEventListener('resize', event => {
            this.checkWindowSize(productsContainer, maxHeight, maxHeightCompetences, productsMenuHeight);
        });

        // ustawienie pierwszego elementu jako aktywny
        var firstProduct = document.querySelectorAll('.menu-right .menu-item-0')
        firstProduct[0].classList.add('hovered');
        var specialProduct = document.querySelector('.special')
        var productMenu = document.querySelector('#product-menu .menu-item')
        var productMenuCard = document.querySelector('#product-menu .menu-item .card-header')
        var widthWindow = window.innerWidth;
        
        // przejscia pomiedzy elementami
        if(productMenuItem.length > 1){
            productMenuItem.forEach(el => {
                el.onmouseover = function(event) {
                    productMenuItem.forEach(el => {
                        if(el.classList.contains('hovered'))
                            el.classList.remove('hovered');
                            el.children[0].classList.remove('background-red-hovered')
                    });  
    
                    el.classList.add('hovered');
                    if(el.classList.contains('special')){
                        el.children[0].classList.add('background-red-hovered')
                    }
                }
            });   
        }
        // dodanie tła do aktywnego elementu na desktop

        if(productMenu.classList.contains('special') && productMenu.classList.contains('hovered')){
            function reportWindowSize() {
                return window.innerWidth
              }
            window.addEventListener('resize', reportWindowSize);
            if(reportWindowSize() > 599){
                productMenuCard.classList.add('background-red-hovered')
            }
        }
    }


    setSubMenuHeight(submenu, height){
        submenu.forEach(el => {
            el.style.height = height + "px";
        });        
    }

    checkWindowSize(productsContainer, maxHeight, maxHeightCompetences, productsMenuHeight){
        if(window.innerWidth < 600)
            productsContainer.style.height = "auto";
        else{
            if(maxHeight > maxHeightCompetences)
                productsContainer.style.height = maxHeight + productsMenuHeight + "px";
            else
                productsContainer.style.height = maxHeightCompetences + productsMenuHeight + "px";
        }
    }

}


export default class DropDownList
{
    constructor() {
        this.onDropdownClick = this.onDropdownClick.bind(this);
    }
    init() {
        const dropDownContainers = document.querySelectorAll('[drop-down-container]');
       
        dropDownContainers.forEach(el => {
            const selects = el.querySelectorAll('.ae-select');
            selects.forEach(el => {
                el.addEventListener('click', this.onDropdownClick);
            }); 
        });       
    }

    onDropdownClick(event) {
        const dropDownContainer = event.target.closest('[drop-down-container] .ae-select');
        if (!dropDownContainer) return;
        dropDownContainer.classList.toggle('up');
        const options = dropDownContainer.nextElementSibling;
        console.log(options);
        const arrow = dropDownContainer.querySelector('.ae-select-arrow');
        const activeLink = document.querySelector('.content .ae-select-container');
        const activeLinkKariera = document.querySelector('.menu-menu-kariera-container');
        if(arrow)
            arrow.classList.toggle('expanded');
        if(options) 
            options.classList.toggle('ae-hide');
        if(activeLink){
            if(arrow)
            activeLink.classList.toggle('ae-hide');
        }
        if(activeLinkKariera){
            if(arrow)
            activeLinkKariera.classList.toggle('ae-hide');
        }
       
    }
}

export default class Innovation
{
    constructor() {
        this.onOptionClick = this.onOptionClick.bind(this);
        this.onDropdownClick = this.onDropdownClick.bind(this);
        this.setInnovationContentHeight = this.setInnovationContentHeight.bind(this);
    }
    init() {
        const innovations = document.querySelectorAll('.ae-container');
        innovations.forEach(el => {
            const selectContent = el.querySelector('.ae-select-content');
            const selected = el.querySelector('.nav.innovation-flex-column > .innovation-li > a.selected');
            if (selected) {
                selectContent.innerText = selected.innerText.trim();
            }

            const newOptions = el.querySelectorAll('.nav.innovation-flex-column > .innovation-li > a');
            newOptions.forEach(option => {
                option.addEventListener('click', this.onOptionClick);
            });

            const navbar = el.querySelector('.navbar');
            if (navbar) {
                navbar.addEventListener('click', this.onDropdownClick);
            }
        });

        // innovation select block height
        const innovations_content = document.querySelectorAll('.container.innovation');
        innovations_content.forEach(el => {
            this.setInnovationContentHeight(el);
        });       

    }

    onOptionClick(event) {
        const innovation = event.target.closest('.ae-container');
        if (!innovation) return;
        const selectContent = innovation.querySelector('.ae-select-content');
        if (selectContent) {
            selectContent.innerText = event.target.innerText;
            const newOptions = innovation.querySelectorAll('.nav.innovation-flex-column > .innovation-li > a');
            newOptions.forEach(option => {
                option.classList.remove('selected');
            });
            event.target.classList.add('selected');
        }
    }

    onDropdownClick(event) {
        const innovation = event.target.closest('.ae-container');
        if (!innovation) return;
        const options = innovation.querySelector('.nav.innovation-flex-column');
        options.classList.toggle('ae-hide');
        const arrow = innovation.querySelector('.ae-select .arrow');
        if(arrow)
            arrow.classList.toggle('expanded');
    }

    setInnovationContentHeight(innovation_container){      
        const innovation_content = innovation_container.querySelector('.management-description .content');
        const innovation_body = innovation_container.querySelector('.management-members .tab-pane');
        innovation_content.style.minHeight = innovation_body.offsetHeight + 28 - 82 + "px"; // 28 - title padding-top, 82 - navbar height
    }
}
import Slider from "./Slider";

export default class ProductGallery
{
    constructor() {
        this.onItemClick = this.onItemClick.bind(this);
    }
    init() {
        const galleries = document.querySelectorAll('.product-gallery');
        galleries.forEach(el => {
            const items = el.querySelectorAll('.product-gallery__list-item');
            items.forEach(item => {
                item.addEventListener('click', this.onItemClick);
            });
        });

        const link = document.querySelectorAll('.product-gallery [anchor-link]');

        link.forEach(el => {
            el.onclick = function(event) {
                event.preventDefault();               
                var selectedFrame = document.querySelectorAll('.product-gallery [anchor]');
                var rect = selectedFrame[0].getBoundingClientRect();
                const offsetTop = rect.top + window.scrollY - 72; // 79 - header height

                $("html, body").animate({ scrollTop: offsetTop });
            }

        });  
    }
    onItemClick(event) {
        const {itemIndex} = event.target.dataset;
        const gallery = event.target.closest('.product-gallery');

        if (itemIndex && gallery) {
            // Remove current selection
            const current = gallery.querySelector('.product-gallery__list-item.product-gallery__list-item--current');
            if (current) {
                current.classList.remove('product-gallery__list-item--current');
            }
            event.target.classList.add('product-gallery__list-item--current');

            // Hide active elements
            const activeElements = gallery.querySelectorAll(`.product-gallery__item`);
            activeElements.forEach(el => {
                el.classList.remove('product-gallery__item--active');
            });
            // Show current elements
            const currentElements = gallery.querySelectorAll(`.product-gallery__item[data-item-index="${itemIndex}"]`)
            currentElements.forEach(el => {
                el.classList.add('product-gallery__item--active');
            });

            new Slider().init();
        }
    }
}

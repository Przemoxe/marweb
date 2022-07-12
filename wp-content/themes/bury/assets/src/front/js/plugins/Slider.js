
export default class Slider
{
    constructor() {
        this.onSlideChange = this.onSlideChange.bind(this);
        this.arrowsVisible = this.arrowsVisible.bind(this);
        this.arrows = document.querySelector('.main-slide .arrows');
    }
    init() {
        const sliders = document.querySelectorAll('.carousel');
        sliders.forEach(el => {
            const {interval} = el.dataset;
            $(el).carousel({
                interval: parseInt(interval)
            });
            $(el).on('slid.bs.carousel', this.onSlideChange);
        });

        if(this.arrows){
            window.addEventListener("scroll", this.arrowsVisible)
        }
    }

    onSlideChange(event) {
        const {interval, type} = event.relatedTarget.dataset;
        event.target.querySelectorAll('video').forEach(video => {
            video.pause();
        });
        if (type === 'video')
        {
            const video = event.relatedTarget.querySelector('video');
            video.currentTime = 0;
            video.play();
        }
        const carousel = $(event.target);
        let options = carousel.data()['bs.carousel']._config;
        options.interval = parseInt(interval);
        carousel.data({options});
    }

    arrowsVisible(){
        if(window.pageYOffset > 400){
            if(!this.arrows.classList.contains('hide'))
                this.arrows.classList.add('hide');
        }
        else if(window.pageYOffset == 0){
            if(this.arrows.classList.contains('hide'))
                this.arrows.classList.remove('hide');
        }
    }
}

export default class oEmbed {
    init() {
        this.onFeaturedImageClick = this.onFeaturedImageClick.bind(this);

        document.querySelectorAll('.embed-container').forEach(oembed => {
            const featuredImage = oembed.querySelector('.featured-image');
            if (featuredImage) {
                featuredImage.addEventListener('click', this.onFeaturedImageClick);

                var iframe = oembed.querySelector('lazyiframe');
                if(iframe){
                    var currentSrc = iframe.getAttribute('src')
                    currentSrc += "&autoplay=1";
                    iframe.setAttribute('src',currentSrc);
                }

            } else {
                const {type} = oembed.dataset;
                if (type === 'file') {
                    this.replaceLazyVideo(oembed, featuredImage);
                    return;
                }
                if (type === 'oembed') {
                    this.replaceLazyIframe(oembed, featuredImage);
                    return;
                }
            }
        });
    }
    onFeaturedImageClick(event) {
        const oembed = event.target.closest('.embed-container');
        const {type} = oembed.dataset;
        if (oembed) {
            if (type === 'file') {
                //this.replaceLazyVideo(oembed, event.currentTarget);
                this.videoControl(oembed, event.currentTarget);
                return;
            }
            if (type === 'oembed') {
                this.replaceLazyIframe(oembed, event.currentTarget);
                return;
            }
        }
    }
    replaceLazyVideo(oembed, featuredImage) {
        let lazyvideo = oembed.querySelector('lazyvideo');

        const iframe = document.createElement('iframe');

        cloneAttributes(iframe, lazyvideo);

        if (featuredImage) {
            featuredImage.classList.add('d-none');
        }
        iframe.classList.remove('d-none');
        insertAfter(iframe, lazyvideo);

        lazyvideo.remove();
        lazyvideo = null;
    }
    replaceLazyIframe(oembed, featuredImage) {
        let lazyiframe = oembed.querySelector('lazyiframe');

        const iframe = document.createElement('iframe');

        cloneAttributes(iframe, lazyiframe);

        if (featuredImage) {
            featuredImage.classList.add('d-none');
        }
        iframe.classList.remove('d-none');
        insertAfter(iframe, lazyiframe);        

        lazyiframe.remove();
        lazyiframe = null;
    }

    videoControl(oembed, featuredImage) {
        var video = oembed.querySelector('video');
        var playButton = featuredImage.querySelector('.overlay-button');
        var featuredImageContent = featuredImage.querySelector('.featured-image__content');

        if(featuredImageContent){
            featuredImageContent.classList.add('d-none');
        }
        

        if (video.paused) {
            playButton.style.display = "none";
            video.play();
        } else {
            video.pause();
            playButton.style.display = "block";
        }
    }
}
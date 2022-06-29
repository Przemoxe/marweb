import PostListMixin from '../../mixins/post-list';
import SocialMediaShare from '../../components/social-media-share.vue';

export default
{
    mixins: [PostListMixin],
    name: 'PodcastPostList',
    components: {
        'social-media-share': SocialMediaShare
    },
    mounted()
    {
        var viewportWidth = window.innerWidth || document.documentElement.clientWidth;
        if (viewportWidth >= 768) {
            this.equalHeight();
        }
        this.addListeners();
    },
    data: function ()
    {
        return {
            action: 'getPodcasts',
            filters: {
                tag: null
            },
        }
    },
    methods: {
        play: function (podcast, type) {
            this.stopAll();
            this.getAudio(podcast, type).play();
            this.getAudioControls(podcast, type).addClass('is-playing');
        },
        pause: function (podcast, type) {
            this.getAudio(podcast, type).pause();
            this.getAudioControls(podcast, type).removeClass('is-playing');
        },
        stopAll: function () {
            this.getAllAudio().each(function () {
                this.pause();
            });
            $('.podcast-type').removeClass('is-playing');
        },
        getAllAudio: function () {
            return $('[data-podcast]').find('audio');
        },
        getAudio: function (podcast, type) {
            return $('[data-podcast="' + podcast + '"]').find('.' + type + ' audio')[0];
        },
        getAudioControls: function (podcast, type) {
            return $('[data-podcast="' + podcast + '"]').find('.podcast-type.' + type + '');
        },
        addListeners()
        {
            window.addEventListener('resize', this.equalHeight());
        },
        equalHeight: function () {
            var maxHeight = -1;
            var elems = document.getElementsByClassName("single-podcast-box");

            for (var i = 0; i < elems.length; i++) {
                maxHeight = maxHeight > elems[i].offsetHeight ? maxHeight : elems[i].offsetHeight;
            }

            for (var i = 0; i < elems.length; i++) {
                elems[i].style.height = maxHeight + "px";
            }
        }
    }
};

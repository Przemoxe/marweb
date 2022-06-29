let pid = 0;

export default {
    name: 'BlockYoutube',
    dependencies: ['bus'],
    mounted() {
        let self = this;
        this.imageEl = $(this.$refs.image);
        this.modalEl = $(this.$refs.modal);
        this.modalEl.on('hidden.bs.modal', function (e) {
            self.player.stopVideo();
        });
        if (! $('script#youtube-iframe-api').length) {
            ScriptTag.load('youtube-iframe-api', 'https://www.youtube.com/iframe_api', () => {
                setTimeout(() => {
                    self.bus.$emit('youtube-iframe-api-loaded', true);
                }, 350);
            }, self.$el);
        }
        self.bus.$on('youtube-iframe-api-loaded', (loaded) => {
            this.init();
        });
    },
    data: function () {
        pid += 1;
        return {
            player: null,
            elementId: `block-youtube-player-${pid}`,
            modalId: `block-youtube-player-${pid}-modal`,
            config: {
                cover: '',
                video_id: '',
                content: ''
            },
            modalEl: null,
            imageEl: null
        }
    },
    methods: {
        init: function () {
            this.player = new YT.Player(this.elementId, {
                videoId: this.config.video_id,
                events: {
                    'onReady': this.onPlayerReady,
                    'onStateChange': this.onPlayerStateChange
                }
            });
        },
        onPlayerReady: function () {},
        onPlayerStateChange: function () {},
        coverClick: function () {
            this.modalEl.modal('show');
            this.player.playVideo();
        }
    },
};
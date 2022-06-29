import GoogleMap from './../../../plugins/GoogleMap';
import {forEach} from 'lodash';
import Autocomplete from './../../components/autocomplete';
import SimpleBar from 'simplebar';

const matchOperatorsRegex = /[|\\{}()[\]^$+*?.-]/g;

function escapeStringRegexp(text) {
    return text.replace(matchOperatorsRegex, '\\$&');
};

const tabletBreakpoint = 768;
const desktopBreakpoint = 1230;

export default {
    dependencies: ['wp', 'axios'],
    components: {
        'autocomplete': Autocomplete,
    },
    mounted() {
        this.initMap();
        this.addListeners();
    },
    data: function() {
        return {
            map: null,
            noResults: false,
            showPoints: false,
            query: '',
            queryData: {},
            breakpoint: 'desktop',
            sidebarVisible: false,
            points: [],
            pool: 0,
            geoloc: {
                supported: false,
                position: {
                    lat: null,
                    lng: null,
                }
            }
        };
    },
    methods: {
        addListeners() {
            window.addEventListener('resize', this.detectUpdateBreakpoint);
        },
        detectUpdateBreakpoint() {
            this.breakpoint = window.innerWidth >= desktopBreakpoint
                ? 'desktop'
                : 'mobile';
        },
        initMap() {
            this.map = new GoogleMap(this.$el.querySelector('.our-clubs__map'),
                {
                    padding: {
                        top: 100,
                        bottom: 100,
                    },
                    map: {
                        zoom: 6,
                        // The Point in center of poland
                        center: {
                            lat: 51.919437,
                            lng: 19.145136,
                        },
                        zoomControl: true,
                        scaleControl: false,
                        mapTypeControl: false,
                        streetViewControl: false,
                        rotateControl: false,
                        fullscreenControl: false,
                        backgroundColor: '#fffff',
                        gestureHandling: 'cooperative',
                        styles: [
                            {
                                featureType: 'poi',
                                stylers: [{visibility: 'off'}],
                            },
                        ],
                    },
                });

            this.setVisibleSidebar(true);

            this.map.init().then(() => {
                this.initPoints();
                this.initSidebar();
                this.detectUpdateBreakpoint();

                this.initGeolocation();
            });
        },
        initGeolocation() {
            if ("geolocation" in navigator) {
                this.geoloc.supported = true;
            }
        },
        resolveLocation() {
            if (this.geoloc.supported) {
                navigator.geolocation.getCurrentPosition((position) => {
                    this.selectPosition({lat: position.coords.latitude, lng: position.coords.longitude});
                });
            }
        },
        initPoints() {
            let points = this.$el.querySelectorAll('.our-clubs__item');
            this.points = [];

            forEach(points, (point) => {
                let id = parseInt(point.getAttribute('data-id'));

                this.points.push({
                    id: id,
                    node: point,
                    feature: false,
                    visible: false,
                    visibleMore: false,
                    name: point.getAttribute('data-title'),
                    address: point.getAttribute('data-address'),
                    position: {
                        lat: parseFloat(point.getAttribute('data-lat')),
                        lng: parseFloat(point.getAttribute('data-lng')),
                    },
                });

                this.map.addMarker(id, {
                    position: {
                        lat: parseFloat(point.getAttribute('data-lat')),
                        lng: parseFloat(point.getAttribute('data-lng')),
                    },
                });
            });

            this.map.initCluster();
            this.map.on('loaded', () => {
                if (this.query) {
                    if (this.queryData && this.queryData.name) {
                        this.query = this.queryData.name;
                        this.selectPosition(
                            {lat: this.queryData.lat, lng: this.queryData.lng});
                    } else {
                        this.noResults = true;
                    }
                } else {
                    this.map.centerMap();
                }
                this.showPoints = true;
            });

            this.map.on('marker_clicked', item => this.selectPoint(item.id));
            this.map.on('changed', () => this.filterVisiblePoints());
        },
        initSidebar() {
            new ClubsSidebar(this.$el);
        },
        getPoint(id) {
            return this.points.find((item) => {
                return item.id === parseInt(id);
            });
        },
        getPointIndex(id) {
            return this.points.findIndex((item) => {
                return item.id === parseInt(id);
            });
        },
        find(query) {
            if (query.trim().length === 0) {
                this.showAllPoints();
                return;
            }
            this.axios.get(this.wp.custom_ajaxurl, {
                params: {
                    action: 'getCities',
                    query: query,
                    partial: false,
                },
            }).then(response => {
                if (response.data.result.length) {
                    let city = response.data.result[0];

                    this.query = city.name;
                    this.selectPosition(
                        {lat: city.latitude, lng: city.longitude});
                    this.noResults = false;
                } else {
                    this.noResults = true;
                }
            });
        },
        search(query) {
            if (query.length < 2) {
                this.pool = 0;
                return [];
            }
            let filtered = [];
            let re = new RegExp(query, 'gi');

            this.pool++;
            this.axios.get(this.wp.custom_ajaxurl, {
                params: {
                    action: 'getCities',
                    query: query,
                },
            }).then(response => {
                response.data.result.forEach(city => {

                    let nameHTML = city.name;

                    if (city.name.match(re)) {
                        nameHTML = nameHTML.replace(new RegExp(
                            '(' + escapeStringRegexp(city.name.match(re)[0]) +
                            ')', 'g'), '<strong>$1</strong>');
                    }

                    filtered.push({
                        value: {
                            lat: city.latitude,
                            lng: city.longitude,
                        },
                        label: city.name,
                        labelHTML: `<span class="autocomplete__name">${nameHTML}</span>`,
                    });
                });
                this.pool--;
            });
            return filtered;
        },
        selectPoint(id) {
            this.setVisibleSidebar(true);
            this.setPointVisibleMore(id);
            this.setFeaturePoint(id);
            this.map.setActiveMarker(id);
        },
        selectPosition(position) {
            this.map.setZoom(12);
            this.map.setCenter(
                new google.maps.LatLng(position.lat, position.lng));
            this.map.centerMapToVisibleMarkers();
        },
        filterVisiblePoints() {
            let visibleMarkers = this.map.getVisibleMarkerIds();

            forEach(this.points, (point, i) => {
                this.points[i].visible = visibleMarkers.indexOf(
                    this.points[i].id) !== -1;
            });
        },
        showAllPoints() {
            forEach(this.points, (point, i) => {
                this.points[i].visible = true;
            });
            this.map.centerMap();
            this.showPoints = true;
        },
        setFeaturePoint(id) {
            forEach(this.markers, (marker, i) => {
                this.markers[i].feature = false;
            });

            this.points[this.getPointIndex(id)].feature = true;
        },
        setPointVisibleMore(id, visible = true) {
            this.points[this.getPointIndex(id)].visibleMore = visible;
        },
        setVisibleSidebar(visible = true) {
            if (this.sidebarVisible === visible) {
                return;
            }

            this.sidebarVisible = visible;
            let padding = {
                top: 0,
                bottom: 0,
                left: 0,
                right: 0,
            };

            if (window.innerWidth >= desktopBreakpoint) {
                if (this.sidebarVisible) {
                    padding.top = 80;
                    padding.left = 600;
                    padding.right = 100;
                }
            } else {
                padding.top = 150;
                padding.bottom = 150;
            }

            this.map.setPadding(padding);
        }
        ,
        toggleSidebar() {
            this.setVisibleSidebar(!this.sidebarVisible);
            this.map.centerMapToVisibleMarkers();
        },
        toggleVisibleMore(id) {
            this.setPointVisibleMore(id, !this.getPoint(id).visibleMore);
        },
        isVisible(id) {
            let point = this.getPoint(parseInt(id));
            return this.showPoints && point !== undefined && this.noResults ===
            false ? point.visible : false;
        },
        isFeatured(id) {
            let point = this.getPoint(parseInt(id));
            return point !== undefined ? point.feature : false;
        },
        isVisibleMore(id) {
            let point = this.getPoint(parseInt(id));
            return point !== undefined ? point.visibleMore : false;
        },
    },
    watch: {
        breakpoint(breakpoint) {
            this.map.setOptions({
                zoomControlOptions: {
                    position: breakpoint === 'mobile'
                        ? google.maps.ControlPosition.RIGHT_CENTER
                        : google.maps.ControlPosition.RIGHT_BOTTOM,
                },
            });
        },
    },
};

class ClubsSidebar {

    constructor(el) {
        this.el = el;
        this.elList = el.querySelector('.our-clubs__sidebar');
        this.simpleBar = null;
        this.listPoisition = 'bottom';
        this.activeBreakpoint = null; // desktop | mobile

        this.options = {
            offset: {
                phone: 140,
                tablet: 180,
            },
            hiddenHeight: 180,
            desktopBreakpoint: desktopBreakpoint,
        };

        this.addListeners();
        this.initBreakpoint();
    }

    addListeners() {
        window.addEventListener('resize', () => {
            let breakpoint = this.detectBreakpoint();
            if (breakpoint === 'mobile' && this.listPoisition === 'bottom') {
                this.pinToBottom();
            }

            if (breakpoint !== this.activeBreakpoint) {
                this.initBreakpoint();
            }
        });
    }

    initBreakpoint() {
        if (this.detectBreakpoint() === 'desktop') {
            this.destroyMobile();
            this.initDesktop();
        } else if (this.detectBreakpoint() === 'mobile') {
            this.destroyDesktop();
            this.initMobile();
        }
    }

    initDesktop() {
        if (this.activeBreakpoint === 'desktop') {
            return;
        }

        this.simpleBar = new SimpleBar(
            this.elList.querySelector('.our-clubs__list-scrollbar'), {
                autoHide: false,
            });
        this.activeBreakpoint = 'desktop';
    }

    destroyDesktop() {
        if (this.activeBreakpoint !== 'desktop') {
            return;
        }

        this.simpleBar.unMount();
    }

    initMobile() {
        if (this.activeBreakpoint === 'mobile') {
            return;
        }

        this.elList.style.top = this.getMapHeight() -
            this.options.hiddenHeight + 'px';
        this.elList.style.height = 'auto';
        this.elList.style.bottom = 0;

        this.elList.addEventListener('touchstart', this.onTouchStart);
        this.elList.addEventListener('touchmove', this.onTouchMove);
        this.elList.addEventListener('touchend', this.onTouchEnd);
        this.activeBreakpoint = 'mobile';
    }

    destroyMobile() {
        if (this.activeBreakpoint !== 'mobile') {
            return;
        }

        this.elList.removeAttribute('style');

        this.elList.removeEventListener('touchstart', this.onTouchStart);
        this.elList.removeEventListener('touchmove', this.onTouchMove);
        this.elList.removeEventListener('touchend', this.onTouchEnd);
    }

    detectBreakpoint() {
        return window.innerWidth >= this.options.desktopBreakpoint
            ? 'desktop'
            : 'mobile';
    }

    getMapHeight() {
        return this.el.getBoundingClientRect().height;
    }

    getSidebarTopPosition() {
        return parseFloat(this.elList.style.top);
    }

    onTouchStart = (event) => {
        let touches = event.changedTouches;

        this.delta = 0;
        this.shift = 0;
        this.touchMove = 0;

        this.touchMove = touches[0].clientY;
    };
    onTouchMove = (event) => {
        event.preventDefault();

        let touches = event.changedTouches;

        this.delta = this.touchMove - touches[0].clientY;
        this.shift += this.delta;

        this.elList.style.transition = 'none';

        if (this.getSidebarTopPosition() > this.getOffsetTop() ||
            this.delta < 0 && this.elList.scrollTop === 0) {
            this.elList.style.overflow = 'visible';
            this.elList.style.top = parseFloat(this.elList.style.top) -
                this.delta + 'px';
        } else {
            this.listPoisition = 'top';
            this.elList.style.overflow = 'hidden';
            this.elList.scrollTop = this.elList.scrollTop + this.delta;
        }

        this.touchMove = touches[0].clientY;
    };
    getOffsetTop = () => window.innerWidth >= tabletBreakpoint ? this.options.offset.tablet : this.options.offset.phone;
    onTouchEnd = (event) => {
        this.elList.style.transition = '300ms all ease';

        if (this.getSidebarTopPosition() > this.getOffsetTop()) {
            if (this.delta > 2 ||
                this.delta > 0 && this.getSidebarTopPosition() <
                this.getMapHeight() / 2) {
                this.pinToTop();
            } else {
                this.pinToBottom();
            }
        }
    };
    pinToTop() {
        this.listPoisition = 'top';
        this.elList.style.top = this.getOffsetTop() + 'px';
    }

    pinToBottom() {
        this.listPoisition = 'bottom';
        this.elList.style.top = this.getMapHeight() - this.options.hiddenHeight + 'px';
    }
}

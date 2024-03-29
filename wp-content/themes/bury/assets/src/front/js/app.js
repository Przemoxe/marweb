import 'babel-polyfill';

window.$ = jQuery;

/**
 * Init Plugins
 */

import VueBootstrap from './vue/boot';
import Navigation from './plugins/Navigation';
import CookieNotice from './plugins/CookieNotice';
import StickyMenu from './plugins/StickyMenu';
import EqualHeight from './plugins/EqualHeight';
import Slider from './plugins/Slider';
import ProductsMenu from './plugins/ProductsMenu';
import ProductGallery from './plugins/ProductGallery';
import DropDownList from './plugins/DropDownList';
import Innovation from './plugins/Innovation';
import oEmbed from './plugins/oEmbed';
import Scrollbar from './plugins/Scrollbar';
import ManagementList from './plugins/ManagementList';
import iframeContainer from './plugins/iframeContainer';
import VideoPlayer from './plugins/VideoPlayer';
import Form from './plugins/Form';
import ImageMapResizer from './plugins/ImageMapResizer';

VueBootstrap.boot();

document.addEventListener('DOMContentLoaded', () => {
    // schema: new Component().init();
    requestAnimationFrame(() => {
        [
            Navigation, CookieNotice, StickyMenu, Slider, EqualHeight, ProductsMenu, ProductGallery, DropDownList, Innovation, oEmbed, Scrollbar, ManagementList,
            iframeContainer, VideoPlayer, Form, ImageMapResizer
        ].forEach((Component) => {
            new Component().init();
        });
    
    });
});
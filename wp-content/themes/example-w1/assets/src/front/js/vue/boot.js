window.Vue = require('vue');
// require('vue-resource');
import ProductSearch from './apps/product-search.js';
import vueSelect from 'vue-select';

export default
{
    /**
    * Zarejestrowanie aplikacji
    */
    registerApps()
    {
        this.mountApp(ProductSearch, '.product-search-block');
    },
    /**
    * Zarejestrowanie domyslnych komponentów
    */
    registerComponents()
    {
        Vue.component('v-select', vueSelect);


    },
    /**
     * Zarejestrowanie dyrektyw
     */
    registerDirectives()
    {
    },
    /**
     * Zarejestrowanie filtrów
     */
    registerFilters() 
    {
    },
    /**
    * Zamontowanie aplikacji vue
    */
    mountApp(app, selector)
    {
        if ($(selector).length)
        {
            var nodes = document.querySelectorAll(selector);

            for (var i = 0; i < nodes.length; ++i)
            {
                new Vue(app).$mount(nodes[i]);
            }
        }
    },
    /**
    * Init
    */
    boot()
    {
        this.registerDirectives();
        this.registerFilters();
        this.registerComponents();
        this.registerApps();
    }
}

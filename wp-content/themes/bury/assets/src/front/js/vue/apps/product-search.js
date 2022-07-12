import Axios from 'axios';
import Functions from '../../functions.js';

export default
{
    name: 'ProductSearch',
    mounted()
    {
        this.searchUrl = Functions.getRestUrl('search-product');

        this.searchQuery(0, 0);
    },
    data: function ()
    {
        return {
            searchUrl: '',
            loading: true,
            filters: {
                product: null,
                categories: {}
            },
            categoryLevels: {},
            products: []
        }
    },
    methods:
    {
        searchQuery: function (parentId, level) {
            let self = this;
            self.loading = true;

            Axios.get(self.searchUrl, {
                params: {
                    level: parentId,
                    category_id: this.getLastSelectedCategory()
                },
            })
            .then(function (response) {
                // Add next category level
                const {categories, products} = response.data;
                self.products = products;
                if (categories && categories.length) {
                    self.categoryLevels[parentId] = {
                        level: level,
                        items: categories
                    };
                }
                self.loading = false;
            });
        },
        onChange(category, parentId, level) {
            const value = category.term_id;
            const levelsCount = Object.keys(this.categoryLevels).length;
            if (level < levelsCount - 1) {
                this.products = [];
                this.filters.categories = {};
                this.filters.product = null;
                for (const pid in this.categoryLevels) {
                    if (Object.hasOwnProperty.call(this.categoryLevels, pid)) {
                        const categoryList = this.categoryLevels[pid];
                        if (categoryList.level > level) {
                            console.log(`Removing ${categoryList.level} (${pid})`);
                            delete this.categoryLevels[pid];
                        }
                    }
                }
            }
            this.filters.categories = {
                parentId: value
            };
            this.searchQuery(value, level+1);
        },
        getLastSelectedCategory() {
            const keys = Object.keys(this.filters.categories);
            if (keys.length === 0) {
                return null;
            }
            return this.filters.categories[keys[keys.length-1]];
        },
        isCategoryEmpty() {
            const categoriesCount = Object.keys(this.filters.categories).length;
            const productCount = this.products.length;
            return categoriesCount && !productCount;
        },
    }
}

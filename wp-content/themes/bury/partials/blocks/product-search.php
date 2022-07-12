<div class="product-search-block" <?= ($is_preview ? '' : 'v-cloak')?>>
    <div :class="[{'product-search-block__wrapper--loading': loading}, 'product-search-block__wrapper']">
        <div class="product-search-block__field" v-for="(categoryList, parentId, index) in categoryLevels" v-if="categoryLevels">
            <div class="row">
                <div class="col-md-auto col-sm-12 product-search-block__col-label">
                    <label :for="`category-lvl-${parentId}`">
                        <?= __('Kategoria', TEXT_DOMAIN) ?>
                    </label>
                </div>
                <div class="col-md-auto col-sm-12 product-search-block__col-input">
                    <v-select :options="categoryList.items" :searchable="false" :clearable="false" id="term_id" label="name" placeholder="Wybierz kategorię" v-model="filters.categories[parentId]" @input="onChange($event, parentId, categoryList.level)"></v-select>
                </div>
            </div>
        </div>
        <div class="product-search-block__field" v-if="products.length">
            <div class="row">
                <div class="col-md-auto col-sm-12 product-search-block__col-label">
                    <label for="product">
                        <?= __('Produkt', TEXT_DOMAIN) ?>
                    </label>
                </div>
                <div class="col-md-auto col-sm-12 product-search-block__col-input">
                    <v-select :options="products" :searchable="false" :clearable="false" id="ID" label="post_title" :disabled="loading" placeholder="Wybierz produkt" v-model="filters.product"></v-select>
                    <div class="product-search-block__submit-wrapper" v-if="filters.product">
                        <a :href="filters.product.url" class="product-search-block__submit"><?= __('Zobacz', TEXT_DOMAIN) ?></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div v-if="isCategoryEmpty()">
                        <p><?= __('Brak produktów w danej kategorii', TEXT_DOMAIN) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
export default 
{
    dependencies: ['wp', 'axios', 'bus'],
    data: function ()
    {
        return {
            action: null,
            page: 1,
            perpage: 9,
            maxpages: 1,
            loading: false,
            posts: [],
            filters: {},
            watchOnFilters: false,
            showInitialPosts: true
        }
    },
    methods: {
        init: function () {
            this.watchOnFilters = true;
        },
        nextPage: function ()
        {
            let self = this;

            if (self.action == null) return;

            self.fetch(self.page, self.filters, self.action);
        },
        fetch: function (page, filters, action) {
            let self = this;
            

            self.loading = true;
            self.axios.get(self.wp.ajaxurl, {
                params: {
                    action: action,
                    page: page+1,
                    filters: filters,
                    lang_code: wp.lang_code
                }
            })
            .then(function(response) {
                if (page == 0)
                {
                    self.posts = response.data.posts;
                }
                else
                {
                    self.page++;
                    self.posts = self.posts.concat(response.data.posts);
                }
                self.loading = false;
                self.maxpages = response.data.max_num_pages;
            });
        },
        onSearch: function () {
            this.showInitialPosts = false;
            this.fetch(0, this.filters, this.action);
        }
    },
}
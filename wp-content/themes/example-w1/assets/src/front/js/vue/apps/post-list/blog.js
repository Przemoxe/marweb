import PostListMixin from '../../mixins/post-list';

export default 
{
    mixins: [PostListMixin],
    name: 'BlogPostList',
    mounted()
    {

    },
    data: function ()
    {
        return {
            action: 'getBlogs',
            filters: {
                categories: [],
                tag: null
            }
        }
    },
};

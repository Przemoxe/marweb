import PostListMixin from '../../mixins/post-list';

export default 
{
    mixins: [PostListMixin],
    name: 'PostList',
    mounted()
    {

    },
    data: function ()
    {
        return {
            action: 'getPosts',
        }
    },
};

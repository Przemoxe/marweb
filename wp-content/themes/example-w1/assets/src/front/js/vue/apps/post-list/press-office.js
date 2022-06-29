import PostListMixin from '../../mixins/post-list';

export default 
{
    mixins: [PostListMixin],
    name: 'PressOfficePostList',
    mounted()
    {

    },
    data: function ()
    {
        return {
            action: 'getPressOffices',
            filters: {
                tag: null
            }
        }
    },
};

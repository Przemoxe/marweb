<?php
namespace App\Core;

use App\Core\Interfaces\IPostType;

/**
*
*/
abstract class BasePostType implements IPostType
{
    private $readonly = false;
    private $canCreate = true;
    private $canSave = true;
    private $canDelete = true;
    private $excerptLimit = 410;
    private $postListColumns = [];
    /**
     * __construct
     */
    function __construct()
    {
        add_action( 'init', [$this, 'initPostType']);
        add_action( 'admin_init', [$this, 'initAdmin']);
        add_action( 'admin_footer', [$this, 'adminFooter']);
        add_action( 'admin_head', [$this, 'columnStyles'] );

        add_filter("manage_edit-{$this->postTypeName}_columns", [$this, 'manageEditColumns'] );
        add_action("manage_{$this->postTypeName}_posts_custom_column", [$this, 'managePostsCustomColumn'], 10, 2);
    }

    public function columnStyles()
    {
        if (get_current_screen()->id === 'edit-' . $this->postTypeName)
        {
            if (empty($this->postListColumns)) return;

            echo '<style>';
            foreach ($this->postListColumns as $key => $value) 
            {
                $width = array_get($value, 'args.width');
                if (!empty($width))
                {
                    echo '.wp-list-table .manage-column.column-image {width: '.$width.'px;}';
                }
                echo '.wp-list-table tbody .column-image img {border-radius: 15px;}';
            }
            echo '</style>';
        }
    }

    public function manageEditColumns($columns)
    {
        $new_columns = [];
        foreach ($columns as $key => $column)
        {
            $new_columns[$key] = $column;
            $columns = array_filter($this->postListColumns, function ($column) use ($key) {
                $after = array_get($column, 'args.after', 'cb');
                return $after === $key;
            });
            foreach ($columns as $c)
            {
                $new_columns[$c['name']] = $c['title'];
            }
        }
        return $new_columns;
    }
    
    public function managePostsCustomColumn($key, $post_id)
    {
        $post = get_post($post_id);
        if (array_key_exists($key, $this->postListColumns))
        {
            $column = $this->postListColumns[$key];
            echo $column['callback']($post_id, $post);
        }
    }

    public function addColumn($name, $title, $callback, $args = [])
    {
        $this->postListColumns[$name] = [
            'name'      => $name,
            'title'     => $title,
            'callback'  => $callback,
            'args'      => $args
        ];
    }


    protected function disableArchiveQuery()
    {
        add_filter('posts_request', [$this, 'postsRequest'], 10, 2);
    }

    protected function disableQuickEdit()
    {
        $self = $this;
        add_filter( 'post_row_actions', function ($actions = array()) use ($self) {
            if ( ! is_post_type_archive( $self->postTypeName ) ) {
                return $actions;
            }
        
            // Remove the Quick Edit link
            if ( isset( $actions['inline hide-if-no-js'] ) ) {
                unset( $actions['inline hide-if-no-js'] );
            }
        });
    }

    protected function canCreate($val = true)
    {
        $this->canCreate = $val;
    }

    protected function canSave($val = true)
    {
        $this->canSave = $val;
    }

    protected function canDelete($val = true)
    {
        $this->canDelete = $val;
    }

    protected function limitExcerpt($limit = null)
    {
        $this->excerptLimit = $limit;
    }

    protected function makeReadOnly(array $fields = [])
    {
        global $pagenow;
        if ($pagenow != 'post.php' && $pagenow != 'edit.php') return;
        if ($pagenow == 'post.php' && $this->postTypeName != get_post_type(input_get('post'))) return;
        if ($pagenow == 'edit.php' && $this->postTypeName != input_get('post_type')) return;
        $this->readonly = $fields;

        if (in_array('content', $fields) || empty($fields))
        {
            add_filter( 'tiny_mce_before_init', function( $args ) {
                if ($this->postTypeName != get_post_type(input_get('post'))) return $args;
                if ( 1 == 1 )
                    $args['readonly'] = 1;
            
                return $args;
            });
        }
    }

    public function initAdmin() 
    {

    }

    public function adminFooter()
    {
        global $pagenow;
        if ($pagenow != 'post.php' && $pagenow != 'edit.php') return;
        if ($pagenow == 'post.php' && $this->postTypeName != get_post_type(input_get('post'))) return;
        if ($pagenow == 'edit.php' && $this->postTypeName != input_get('post_type')) return;

        if (false != $this->readonly)
        {
            partial('dashboard/readonly-script', [
                'fields' => $this->readonly,
                'canSave' => $this->canSave,
                'canDelete' => $this->canDelete
            ]);
        }

        if ($this->excerptLimit != 0)
        {
            partial('dashboard/excerpt-limit-script', [
                'limit' => $this->excerptLimit
            ]);
        }
    }

    public function postsRequest($request, $query)
    {
        if( $query->is_main_query() && ! $query->is_admin && is_post_type_archive($this->postTypeName) )
            return false;
        else
            return $request;
    }
}
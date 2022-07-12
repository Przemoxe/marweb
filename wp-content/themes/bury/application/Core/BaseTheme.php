<?php
namespace App\Core;

use App\Core\Interfaces\ITheme;
use App\Core\Interfaces\IOptions;

/**
* Bazowe funkcjonalnosci szablonu
*/
abstract class BaseTheme implements ITheme
{
    public $dependeciesObjects = [];
    public $componentObjects = [];
    public $repositoryFactories = [];

    /**
    * __construct
    */
    function __construct()
    {
        add_action( 'after_setup_theme', [$this, 'afterSetupThemeAction'] ); //this method must be implemented on child class
        add_action( 'wp_enqueue_scripts', [$this, 'registerAssetsAction'] ); //this method must be implemented on child class
        add_action( 'template_redirect', [$this, 'templateRedirectAction']);
        remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
        add_filter( 'block_categories_all', [$this, 'registerBlockCategory'], 10, 2 );
        add_filter( 'display_post_states', [$this, 'postStates'], 10, 2 );
        add_filter('body_class',[$this, 'bodyClass']);
        add_filter( 'get_the_archive_title', [$this, 'getTheArchiveTitle']);
    }

    public function register()
    {
        if (function_exists('acf_add_options_page'))
        {
            $this->registerComponents();
            $this->registerDependencies();
            $this->registerRepositories();
        }
    }

    public function registerBlockCategory($categories)
    {
        return array_merge(
            $categories,
            array(
                array(
                    'slug' => TEXT_DOMAIN,
                    'title' => __( 'Bury', TEXT_DOMAIN ),
                    'icon'  => 'dashicons-admin-appearance',
                ),
            )
        );
    }

    /**
    * Zainicjowanie zdefiniowanych zaleznosci wstrzykiwanych do szablonu
    */
    function registerDependencies()
    {
        if(empty($this->dependencies)) return false;

        foreach ($this->dependencies as $dependencyKey => $dependencyParam)
        {
            $dependency = null;
            if (is_array($dependencyParam))
            {
                $dependency = $this->{last($dependencyParam)}();
            }
            else
            {
                $dependency = new $dependencyParam();
            }
            $this->dependeciesObjects[$dependencyKey] = $dependency;
        }
    }

    /**
    * Zainicjowanie zdefiniowanych komponentow
    */
    public function registerComponents()
    {
        if(empty($this->components)) return false;

        foreach ($this->components as $component)
        {
            $componentObject = new $component();
            $this->componentObjects[] = $componentObject;
        }

        $this->bindAction('init', 'initAction');
        $this->bindAction('admin_init', 'adminInitAction');
        $this->bindAction('admin_menu', 'adminMenuAction');
        $this->bindAction('current_screen', 'currentScreenAction');
        $this->bindAction('save_post', 'savePostAction', 10, 3);
        $this->bindAction('edit_term', 'saveTermAction', 10, 3);
        $this->bindAction('after_setup_theme', 'afterSetupTheme');
        $this->bindAction('shutdown', 'shutdown', 10);
    }

    /**
    * Zainicjowanie zdefiniowanych komponentow
    */
    public function registerRepositories()
    {
        if (empty($this->repositories)) return false;

        $api = $this->api();

        if (empty($api)) return false;

        foreach ($this->repositories as $repositoryName => $repositoryClass)
        {
            $this->repositoryFactories[$repositoryName] = function () use ($repositoryClass, $api) {
                return new $repositoryClass($api);
            };
        }
    }

    public function repository($name)
    {
        $repositoryFactory = array_get($this->repositoryFactories, $name, false); 
        if (false == $repositoryFactory) return null;
        return $repositoryFactory();
    }

    public function import($name)
    {
        $importClass = array_get($this->imports, $name, false);
        if (false == $importClass) return null;
        return new $importClass();
    }

    public function hasDependency($method)
    {
        return array_has($this->dependencies, $method);
    }

    public function getModelByPostType($postTypeName)
    {
        $key = 'post_type_model_' . $postTypeName;
        $model = wp_cache_get( $key );
        if ( false === $model ) 
        {
            foreach($this->dependeciesObjects as $dependency)
            {
                if (!\is_a($dependency, BaseModel::class) || !\is_a($dependency, IOptions::class) || $dependency->getPostTypeName() != $postTypeName)
                {
                    continue;
                }
                wp_cache_set( $key, $dependency );
                $model = $dependency;
                break;
            }
        }
        return $model;
    }

    private function bindAction($name, $methodName, $priority = 10, $acceptedArgs = 1 )
    {
        $self = $this;
        add_action($name, function () use ($self, $methodName) {

            foreach ($self->componentObjects as $componentObject)
            {
                if (! method_exists($componentObject, $methodName)) continue;
                call_user_func_array([$componentObject, $methodName], func_get_args());
            }

        }, $priority, $acceptedArgs);
    }

    public function postStates($states, $post)
    {
        if ('page' == $post->post_type)
        {
            $template = \get_page_template_slug( $post->ID );
            if (!empty($template) && function_exists('get_page_templates'))
            {
                $templates  = array_flip(\get_page_templates($post));
                $templateName = array_get($templates, $template);
                if (!empty($templateName))
                {
                    $states[] = '<i>' . __('Template') . ' ' . $templateName . '</i>';
                }
            }
        }
        return $states;
    }

    public function bodyClass($classList)
    {
        if (is_tax())
        {
            $term = get_queried_object();
            if (!empty($term))
            {
                if (empty($term->parent))
                {
                    $classList[] = 'term-without-parent';
                }
            }
        }
        return $classList;
    }
    
    public function getTheArchiveTitle($title)
    {
        if ( is_category() )
        {
            $title = single_cat_title( '', false );
        }
        elseif ( is_tag() )
        {    
            $title = single_tag_title( '', false );
        }
        elseif ( is_author() )
        {
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;
        }
        elseif ( is_tax() )
        {
            $title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
        }
        elseif (is_post_type_archive())
        {
            $title = post_type_archive_title( '', false );
        }
        return $title;
    }

    /**
    * call to theme dependency
    *
    * @param  String $method
    * @param  array  $params
    * @return Object
    */
    function __call($method, $params = [])
    {
        if(!array_has($this->dependencies, $method))
        {
            throw new \Exception( $method . ' - Called dependency not exists in theme!');
        }

        return $this->dependeciesObjects[$method];
    }
}

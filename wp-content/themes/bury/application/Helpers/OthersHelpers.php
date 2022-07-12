<?php

if (! function_exists('require_to_variable'))
{
    /**
    * Include template parto to variable
    *
    * @param  String $path
    * @return String
    */
    function require_to_variable($path, $params = [])
    {
        ob_start();
        extract($params);
        require($path);
        return ob_get_clean();
    }
}

if (! function_exists('get_terms_for_post_type'))
{
    /**
    * Pobranie taxonomii dla konkretnego typu postu - funkcja sprawdza poprawnie parametr hide_empty
    */
    function get_terms_for_post_type($taxonomies, $postTypeName)
    {
        $args['post_types'] = $postTypeName;
        $args = wp_parse_args($args);

        if( !empty($args['post_types']) )
        {
            $args['post_types'] = (array) $args['post_types'];

            add_filter( 'terms_clauses',function ( $pieces, $tax, $args){
                global $wpdb;

                //Don't use db count
                $pieces['fields'] .=", COUNT(*) " ;

                //Join extra tables to restrict by post type.
                $pieces['join'] .=" INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id
                INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id ";

                //Restrict by post type and Group by term_id for COUNTing.
                $post_types_str = implode(',', $args['post_types']);
                $pieces['where'].= $wpdb->prepare(" AND p.post_type IN(%s) GROUP BY t.term_id", $post_types_str);

                remove_filter( current_filter(), __FUNCTION__ );
                return $pieces;
            }, 10, 3);

        }

        return get_terms($taxonomies, $args);
    }
}

if (! function_exists('array_to_input'))
{

    function array_to_input($array, $prefix='')
    {
        $inputsHtml = '';

        if( (bool)count(array_filter(array_keys($array), 'is_string')) )
        {
            foreach($array as $key => $value)
            {
                if( empty($prefix) )
                {
                    $name = $key;
                }
                else
                {
                    $name = $prefix.'['.$key.']';
                }
                if( is_array($value) )
                {
                    array_to_input($value, $name);
                }
                else
                {
                    $inputsHtml .= '<input type="hidden" value="'.$value.'" name="'.$name.'">';
                }
            }
        }
        else
        {
            foreach($array as $item)
            {
                if( is_array($item) )
                {
                    array_to_input($item, $prefix.'[]');
                }
                else
                {
                    $inputsHtml .= '<input type="hidden" value="'.$prefix.'[]" name="'.$item.'">';
                }
            }
        }

        return $inputsHtml;
    }
}

if (! function_exists('get_base_url'))
{

    function get_base_url()
    {
        $currentPath = $_SERVER['PHP_SELF'];
        $hostName = $_SERVER['HTTP_HOST'];
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';

        return $protocol.'://'.$hostName;
    }
}

if (! function_exists('terms_list_to_options'))
{
    function terms_list_to_options($terms, $reverseKeyValue = false)
    {
        $options = [];

        if (!empty($terms))
        {
            foreach ($terms as $term)
            {
                if ($term instanceof WP_Term)
                {
                    if ($reverseKeyValue)
                    {
                        $options[$term->name] = $term->slug;
                    }
                    else
                    {
                        $options[$term->slug] = $term->name;
                    }
                }
            }
        }

        return $options;
    }
}

if (! function_exists('wp_query_list_to_options'))
{
    function wp_query_list_to_options($wpQuery, $reverseKeyValue = false)
    {
        $options = [];

        if ($wpQuery->have_posts())
        {
            foreach ($wpQuery->posts as $post)
            {
                if ($reverseKeyValue)
                {
                    $options[$post->post_title] = $post->post_name;
                }
                else
                {
                    $options[$post->post_name] = $post->post_title;
                }
            }
        }

        return $options;
    }
}

if (! function_exists('is_wplogin'))
{
    function is_wplogin()
    {
        $ABSPATH_MY = str_replace(array('\\','/'), DIRECTORY_SEPARATOR, ABSPATH);
        return ((in_array($ABSPATH_MY.'wp-login.php', get_included_files()) || in_array($ABSPATH_MY.'wp-register.php', get_included_files()) ) || (isset($_GLOBALS['pagenow']) && $GLOBALS['pagenow'] === 'wp-login.php') || $_SERVER['PHP_SELF']== '/wp-login.php');
    }
}

if (! function_exists('partial'))
{
    /**
    * Function to print partial
    */
    function partial($name, $params = [], $echo = true)
    {
        if (false === partial_exists($name))
        {
            throw new \Exception('Partial not found "partials/' . $name . '.php"');
        }
        foreach ($params as $key => $param)
        {
            set_query_var( $key, $param );
        }

        if ($echo)
        {
            get_template_part( 'partials/' . $name );
        }
        else
        {
            ob_start();
            get_template_part( 'partials/' . $name );
            $var = ob_get_contents();
            ob_end_clean();
            return $var;
        }
    }
}

if (! function_exists('partial_exists'))
{
    /**
    * Function to check if partial exists
    */
    function partial_exists($name)
    {
        return '' != locate_template( 'partials/' . $name . '.php' );
    }
}


if (! function_exists('get_taxonomy_archive_link'))
{
    /**
    * Function to print taxonomy archive link
    */
    function get_taxonomy_archive_link( $taxonomy ) {
        $tax = get_taxonomy( $taxonomy ) ;
        $term = wp_get_object_terms(get_the_ID(), $taxonomy);

        if ($term):
            return get_bloginfo( 'url' ) . '/' . $tax->rewrite['slug'] . '/' . $term[0]->slug;
        else:
            return get_bloginfo( 'url' ) . '/' . $tax->rewrite['slug'] . '/';
        endif;
    }
}

if (! function_exists('fetch_field'))
{
    function fetch_field($post_id, $key = '')
    {
        return maybe_unserialize(get_post_meta($post_id, $key, true));
    }
}

if (! function_exists('gs_vc_response_posts_by_post_type'))
{
    /**
     * Ajax Response for posts by post type
     *
     * @param $query
     * @return array
     */
    function gs_vc_response_posts_by_post_type($post_type, $query)
    {
        $result = array();

        $posts = get_posts(array(
        'post_type' => $post_type,
        's' => esc_sql($query)
    ));

        foreach ($posts as $post) {
            $result[] = array(
            'label' => $post->post_title,
            'value' => $post->ID
        );
        }

        return $result;
    }
}

if (! function_exists('the_lazy_image'))
{
    function the_lazy_image($attachment_id, $size = 'thumbnail', $icon = false, $attr = '', $type = 'normal')
    {
        $html = '';
        $image = wp_get_attachment_image_src($attachment_id, $size, $icon);
        if ( $image ) {
            list($src, $width, $height) = $image;
            $hwstring = image_hwstring($width, $height);
            $size_class = $size;
            if ( is_array( $size_class ) ) {
                $size_class = join( 'x', $size_class );
            }
            $attachment = get_post($attachment_id);
            $default_attr = array(
                'data-src'	=> $src,
                'class'	=> "attachment-$size_class size-$size_class lozad lozad-$type",
                'alt'	=> trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) ),
            );

            $attr = wp_parse_args( $attr, $default_attr );

            if ( empty( $attr['srcset'] ) ) {
                $image_meta = wp_get_attachment_metadata( $attachment_id );

                if ( is_array( $image_meta ) ) {
                    $size_array = array( absint( $width ), absint( $height ) );
                    $srcset = wp_calculate_image_srcset( $size_array, $src, $image_meta, $attachment_id );
                    $sizes = wp_calculate_image_sizes( $size_array, $src, $image_meta, $attachment_id );

                    if ( $srcset && ( $sizes || ! empty( $attr['sizes'] ) ) ) {
                        $attr['srcset'] = $srcset;

                        if ( empty( $attr['sizes'] ) ) {
                            $attr['sizes'] = $sizes;
                        }
                    }
                }
            }

            $attr = apply_filters( 'wp_get_attachment_image_attributes', $attr, $attachment, $size );
            $attr = array_map( 'esc_attr', $attr );
            $html = rtrim("<img $hwstring");
            foreach ( $attr as $name => $value ) {
                $html .= " $name=" . '"' . $value . '"';
            }
            $html .= ' />';
        }

        return $html;
    }
}

if ( ! function_exists('listFiles'))
{
    function listFiles($path, $pattern = null)
    {
        $directoryIterator = new RecursiveDirectoryIterator($path);
        $iteratorIterator = new RecursiveIteratorIterator($directoryIterator);
        $fileIterator = new RegexIterator($iteratorIterator, $pattern);
        $files = [];
        foreach($fileIterator as $file)
        {
            $files[] = $file;
        }
        return $files;
    }
}

if ( ! function_exists('dumpToFile'))
{
    function dumpToFile($var, $force = false, $name = '', $limit = 10)
    {
        if (!isset($_COOKIE['debug_mode']) && !$force) return;
        if (!empty($name))
        {
            $name .= '_';
        }

        $backtrace = debug_backtrace();
        $tag = null;
        if (is_object($var) && ($var instanceof Closure))
        {
            $var = $var();
            if ($var === false) return;
        }
        $var = [
            'data' => $var
        ];

        if (count($backtrace) >=2)
        {
            $binfo = array_get($backtrace, '2');
            $var['class'] = array_get($binfo, 'class');
            $var['line'] = array_get($binfo, 'line');
        }
        elseif(count($backtrace) == 1)
        {
            $binfo = array_get($backtrace, '1');
            $var['class'] = array_get($binfo, 'class');
            $var['line'] = array_get($binfo, 'line');
        }

        $dumpdir = wp_upload_dir()['basedir'];
        if (!file_exists($dumpdir))
            mkdir($dumpdir);

        $filepath = $dumpdir . '/dump_'.$name.date('Y_m_d').'.log';
        ob_start();
        print_r($var);
        $data = ob_get_contents();
        ob_end_clean();

        list($debug) = debug_backtrace(false);
        $msg = "__File: " . $debug['file'] . ' __Line: ' . $debug['line'] . "\n" . $data . "\n";

        file_put_contents($filepath, $msg, FILE_APPEND);

        return true;
    }
}

if (! function_exists('bundle'))
{
    function bundle($file = '')
    {
        $path_info = pathinfo($file);
        $is_production = defined('_ENV') && _ENV == 'production';

        $prefix = $is_production ? 'bundle' : 'build';

        if (!empty(array_get($path_info, 'filename')))
        {
            $prefix .= '-';
        }
        $file = $prefix . $file;

        return $file;
    }
}

if (! function_exists('get_page_field'))
{
    function get_page_field($selector, $post_id = false, $format_value = true)
    {
        $value = get_field($selector, $post_id, $format_value);
        $status = true;
        if (is_object($value)) return $value;
        $status = get_post_status($value);
        return $status == 'publish' ? $value : null;
    }
}

if (! function_exists('group_by_tax'))
{
    function group_by_tax($postTypeName, $tax)
    {
        $categories = get_terms([
            'taxonomy' => $tax,
            'hide_empty' => false,
        ]);
        $result = [];

        foreach ($categories as $category)
        {
            $cat = (object)[
                'term' => $category,
                'posts' => []
            ];
            $query = [
                'post_type' => $postTypeName,
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'orderby' => 'post_date',
                'order' => 'ASC',
                'tax_query' => [
                    [
                        'taxonomy' => $tax,
                        'field' => 'term_id',
                        'terms' => [$category->term_id],
                        'operator' => 'IN',
                    ]
                ]
            ];

            $posts = new WP_Query($query);
            $cat->posts = $posts->posts;
            $result[] = $cat;
        }
        return $result;
    }
}

if (! function_exists('print_svg'))
{
    function print_svg($file_id)
    {
        if (empty($file_id) || !is_numeric($file_id)) return;
    
        $image = wp_cache_get( 'file-svg-' . $file_id );
        if ( false === $image ) {
            $image_path = get_attached_file($file_id);
            if ( false === $image_path ) return;
            if (! str_ends_with($image_path, '.svg'))
            {
                echo wp_get_attachment_image($file_id);
                return;
            }
            if (!file_exists($image_path)) return;
            $image = file_get_contents($image_path);

            $doc = new DOMDocument();
            $doc->loadXML($image);

            $image = $doc->saveHTML();

        }
        echo $image;
    }
}

if (! function_exists('print_svg_by_path'))
{
    function print_svg_by_path($path)
    {
        if (empty($path) || !file_exists($path)) return;
        $image = wp_cache_get( 'file-svg-' . md5($path) );
        if ( false === $image ) {
            $image = file_get_contents($path);

            $doc = new DOMDocument();
            $doc->loadXML($image);

            $image = $doc->saveHTML();

        }
        echo $image;
    }
}

if (! function_exists('build_link'))
{
    function build_link($link, array $atts = null)
    {
        if (empty($link)) return;
        if (is_string($link))
        {
            $link = vc_build_link($link);
        }
        elseif (is_object($link))
        {
            $link = (array)$link;
        }

        $url = array_get($link, 'url');
        $target = null;
        $rel = null;
        $class = null;
        $title = null;
        $icon = null;

        if ( array_has($link, 'target') && strlen( $link['target'] ) ) {
            $target = ' target="' . esc_attr( $link['target'] ) . '"';
        }
        if ( array_has($link, 'rel') && strlen( $link['rel'] ) ) {
            $rel = ' rel="' . esc_attr( $link['rel'] ) . '"';
        }

        $title = array_get($atts, 'title', array_get($link, 'title'));
        $class = array_get($atts, 'class');

        if (array_has($atts, 'icon') && !empty(array_get($atts, 'icon')))
        {
            $class .= ' with-icon';
            $icon = '<i class="icon ' . array_get($atts, 'icon') . '"></i>';
        }

        if (strlen( $class ) ) {
            $class = ' class="' . esc_attr( $class ) . '"';
        }


        return "<a {$class} href=\"{$url}\" {$target} {$rel}>{$title}{$icon}</a>";
    }
}

if (! function_exists('get_route_link'))
{
    function get_route_link($lat, $lng)
    {
        if (empty($lat) || empty($lng))
        {
            return '';
        }

        return 'https://www.google.com/maps/dir/?api=1&destination='.$lat.','.$lng;
    }
}

if (! function_exists('get_map_url'))
{
    function get_map_url($lat, $lng)
    {
        if (empty($lat) || empty($lng))
        {
            return '';
        }

        return 'https://maps.google.com/maps?daddr='.$lat.','.$lng;
    }
}

if (! function_exists('get_defined'))
{
    function get_defined($name, $default = null)
    {
        if (!defined($name)) return $default;
        return constant($name);
    }
}

if (! function_exists('get_post_type_from_taxonomy'))
{
    function get_post_type_from_taxonomy($tax_name)
    {
        global $wp_taxonomies;
        $taxonomy = array_get($wp_taxonomies, $tax_name);
        if (empty($taxonomy)) return null;
        return array_get_first($taxonomy->object_type);
    }
}

if (! function_exists('is_image_url'))
{
    function is_image_url($url) 
    {
        $ext = pathinfo(basename($url), PATHINFO_EXTENSION);
        return in_array($ext, ['gif', 'jpeg', 'jpg', 'png']);
    }
}

if (! function_exists('is_video_url'))
{
    function is_video_url($url) 
    {
        $ext = pathinfo(basename($url), PATHINFO_EXTENSION);
        return in_array($ext, ['avi', 'flv', 'mov', 'mp4', 'mpv', 'wmv']);
    }
}

if (! function_exists('get_query_post_type'))
{
    function get_query_post_type(\WP_Query $query)
    {
        $post_types = (array) array_get($query->query, 'post_type', []);
        return head($post_types);
    }
}

/**
 * @param array $attributes
 * @return string
 */
function attr(array $attributes)
{
    $html = '';

    foreach ($attributes as $key => $value)
    {
        if (is_numeric($key))
        {
            $key = $value;
        }
        if ($value === null || $value === false)
        {
            continue;
        }

        $html .= ' '.$key.'="'.htmlentities($value, ENT_QUOTES, 'UTF-8', false).'"';
    }

    return $html;
}

if (! function_exists('page_link'))
{
    function page_link($args)
    {
        $args = (array) $args;
        $defaults = array(
            'url' => null,
            'title' => null,
            'target' => '_self',
        );

        return wp_parse_args( $args, $defaults );
    }
}

if (! function_exists('the_page_link'))
{
    function the_page_link($args, array $atts = array())
    {
        $args = (array) $args;
        $link = page_link($args);
        if (are_empty([$link['url'], $link['title']])) return;

        $atts = attr($atts);
        ?>

        <a href="<?= $link['url'] ?>" target="<?= $link['target'] ?>" <?= $atts ?>><?= $link['title'] ?></a>

        <?php
    }
}

if (! function_exists('print_svg'))
{
    function print_svg($file_id)
    {
        if (empty($file_id) || !is_numeric($file_id)) return;
    
        $image = wp_cache_get( 'file-svg-' . $file_id );
        if ( false === $image ) {
            $image_path = get_attached_file($file_id);
            if ( false === $image_path ) return;
            if (! str_ends_with($image_path, '.svg'))
            {
                echo wp_get_attachment_image($file_id);
                return;
            }
            if (!file_exists($image_path)) return;
            $image = file_get_contents($image_path);

            $doc = new DOMDocument();
            $doc->loadXML($image);

            $image = $doc->saveHTML();

        }
        echo $image;
    }
}
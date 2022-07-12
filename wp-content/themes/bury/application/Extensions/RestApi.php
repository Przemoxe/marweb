<?php
namespace App\Extensions;

use WP_REST_Response;

class RestApi
{
    /**
     * __construct
     */
    function initAction()
    {
        add_action('rest_api_init', [$this, 'registerRoutes']);
    }

    public function registerRoutes()
    {
        $reflection = new \ReflectionClass(self::class);

        foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method)
        {
            $name = $method->getName();
            $isGet = strpos($name, 'get') === 0;
            $isPost = strpos($name, 'post') === 0;
            if ($isGet || $isPost)
            {
                $slug = self::getMethodSlug($name);
                register_rest_route(TEXT_DOMAIN . '/v1', $slug, array(
                    'methods'  => $isPost ? 'POST' : 'GET',
                    'callback' => [$this, $name],
                    'permission_callback' => '__return_true'
                ));
            }
        }
    }

    public function getSearchProduct(\WP_REST_Request $request)
    {
        $level = $request->get_param('level') ?? 0;
        $categoryId = $request->get_param('category_id');
        $categories = theme()->productModel()->getAllCategoriesWithArchivedProducts($level);
        $products = [];
        if (!empty($categoryId))
        {
            $products = theme()->productModel()->getAllPublished(['category' => $categoryId, 'is_archive' => true])->posts;
            array_each($products, function ($product) 
            {
                $product->url = get_permalink($product->ID);
                return $product;
            });
        }

        return new WP_REST_Response(compact('categories', 'products'));
    }

    private static function getMethodSlug($method)
    {
        $slug = str_replace(['get', 'post'], '', $method);
        preg_match_all('/((?:^|[A-Z])[a-z]+)/', $slug, $matches);
        if (!empty($matches))
        {
            $matches = $matches[0];
            $slug = implode('-', $matches);
        }
        $slug = strtolower($slug);

        return $slug;
    }
}

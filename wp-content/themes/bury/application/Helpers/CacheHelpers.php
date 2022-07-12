<?php

if (! function_exists('cache_pool'))
{
    /**
    * Creates Pool for cache
    */
    function cache_pool()
    {
        // $options = array('servers' => array(array('server' => REDIS_HOST, 'port' => REDIS_PORT, 'ttl' => 0.1)));
        // $driver = new Stash\Driver\Redis($options);
        // $options = array('path' => __DIR__ . '/../../../uploads/stash');
        // $driver = new Stash\Driver\FileSystem($options);

        // return new Stash\Pool($driver);
        return new Doctrine\Common\Cache\FilesystemCache(__DIR__ . '/../../../uploads/docache');
    }
}

if (! function_exists('cache_keygen'))
{
    /**
    * Generate key for cache
    */
    function cache_keygen(Array $data, $sha1=true)
    {
        $key = serialize($data);
        if (!$sha1) return $key;
        $key = sha1($key);
        return $key;
    }
}

if (! function_exists('cache_set'))
{
    /**
    * Return json reponse
    *
    * @param  String $key
    * @param  String|Array|Object $data
    */
    function cache_set($key, $data, $expiresAfter)
    {
        try
        {
            $pool = cache_pool();

            // $item = $pool->getItem($key);

            // $item->lock();

            // $item->set($data);

            // $item->expiresAfter($expiresAfter);

            // $pool->save($item);

            $pool->save($key, $data);
            return $data;
        }
        catch(\Exception $e)
        {
            return $data;
        }
    }
}

if (! function_exists('cache_get'))
{
    /**
    * Return json reponse
    *
    * @param  String $key
    * @param  String|Array|Object $data
    */
    function cache_get($key, $get_item = false)
    {
        try
        {
            $pool = cache_pool();

            // $item = $pool->getItem($key);

            // if ($get_item)
            // {
            //     return  $item;
            // }
            // return $item->get();
            return $pool->fetch($key);
        }
        catch(\Exception $e)
        {
            return null;
        }
    }
}

if (! function_exists('cache_clear'))
{
    /**
    * Clears cache
    *
    * @param  String $key
    */
    function cache_clear($key = null)
    {
        try
        {
            $pool = cache_pool();
            if (!empty($key))
            {
                $pool->delete($key);
                return;
            }
                
            $pool->deleteAll();
            // $pool->clear();
        }
        catch(\Exception $e)
        {
            return $data;
        }
    }
}

if (! function_exists('cache_exists'))
{
    /**
    * Check if item exists in cache
    *
    * @param  String $key
    */
    function cache_exists($key)
    {
        try
        {
            $pool = cache_pool();
            return $pool->contains($key);
            // return $pool->hasItem($key);
        }
        catch(\Exception $e)
        {
            return false;
        }
    }
}

if (! function_exists('cache_is_miss'))
{
    /**
    * Check if item exists in cache
    *
    * @param  Mixed $key
    */
    function cache_is_miss($key)
    {
        return !cache_exists($key);
        if (empty($object)) return true;
        try
        {
            return $object->isMiss();
        }
        catch(\Exception $e)
        {
            return false;
        }
        return false;
    }
}

if (! function_exists('is_cache'))
{
    /**
     * Is cache configured
     */
    function is_cache()
    {
        return defined('STASH_CACHE') && STASH_CACHE;
    }
}
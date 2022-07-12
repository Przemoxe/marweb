<?php

if (! function_exists('array_last_key'))
{
    /**
    * Get last vkey from array
    *
    * @param  array  $array
    * @return array
    */
    function array_last_key(array $array, $indexedMode = false)
    {
        if (!$indexedMode)
        {
            end($array);
            return key($array);
        }
        else
        {
            return count($array);
        }
    }
}

if (! function_exists('array_position_by_key'))
{
    /**
    * Get element position by key
    *
    * @param  array  $array
    * @return array
    */
    function array_position_by_key(array $array, $key)
    {
        return array_search($key, array_keys($array));
    }
}

if (! function_exists('object_to_array'))
{
    /**
    * Cast object to array
    *
    * @param  array  $array
    * @return array
    */
    function object_to_array($object)
    {
        return json_decode(json_encode($object), true);
    }
}

if (! function_exists('array_to_object'))
{
    /**
    * Cast array to object 
    *
    * @param  array  $array
    * @return array
    */
    function array_to_object($array) {
        if (!is_array($array)) return $array;
        $obj = new stdClass;
        foreach($array as $k => $v) 
        {
            if(strlen($k)) 
            {
                if(is_array($v)) {
                    if (is_assoc($v))
                    {
                        $obj->{$k} = array_to_object($v);
                    }
                    else
                    {
                        foreach($v as &$sv)
                        {
                            $sv = array_to_object($sv);
                        }
                        $obj->{$k} = $v;
                    }
                } 
                else 
                {
                    $obj->{$k} = $v;
                }
            }
        }

        return $obj;
    } 
}

if (! function_exists('is_assoc'))
{
    function is_assoc(array $arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}

if (! function_exists('array_each'))
{
    /**
    * Map WP_Query object
    *
    * @param  WP_Query $wpQueryObject
    * @param  callable $callback
    */
    function array_each(array &$array, callable $callback)
    {
        foreach ($array as $key => $item)
        {
            call_user_func_array($callback, [$item, $key]);
        }
    }
}

if (! function_exists('array_get_first'))
{
    /**
    * Get array element by index 0
    *
    * @param array $array
    */
    function array_get_first($array)
    {
        if (isset($array))
        {
            return array_get($array, 0);
        }
        else
        {
            return false;
        }
    }
}

if (! function_exists('array_get_last'))
{
    /**
    * Get array element by index 0
    *
    * @param array $array
    */
    function array_get_last($array)
    {
        if (isset($array))
        {
            return end($array);
        }
        else
        {
            return false;
        }
    }
}

if (! function_exists('array_build_tree'))
{
    /**
    * Build tree from array with parent column
    *
    * @param  Array $array
    */
    function array_build_tree(array $elements, $idColumnName, $parentColumnName, $parentId = 0, $obj = false)
    {
        $branch = [];
        
        foreach ($elements as $element)
        {
            if ($element[$parentColumnName] == $parentId)
            {
                $children = array_build_tree($elements, $idColumnName, $parentColumnName, $element[$idColumnName], $obj);
                
                if ($children)
                {
                    $element['childrens'] = $children;
                }
                else
                {
                    $element['childrens'] = [];
                }
                
                $branch[] = $obj ? (object)$element : $element;
            }
        }
        
        return $branch;
    }
}

if (! function_exists('array_pluck'))
{
    /**
    * Super awesome important function
    */
    function array_pluck($array, $value, $key = null)
    {
        $results = [];
        
        $value = is_string($value) ? explode('.', $value) : $value;
        $key = is_null($key) || is_array($key) ? $key : explode('.', $key);
        
        foreach ($array as $item) {
            $itemValue = data_get($item, $value);
            if (is_null($key)) {
                $results[] = $itemValue;
            } else {
                $itemKey = data_get($item, $key);
                if (is_object($itemKey) && method_exists($itemKey, '__toString')) {
                    $itemKey = (string) $itemKey;
                }
                $results[$itemKey] = $itemValue;
            }
        }
        return $results;
    }
}

if (! function_exists('are_empty'))
{
    /**
    * Get array element by index 0
    *
    * @param  Array $array
    */
    function are_empty($array)
    {
        if (empty($array)) return true;
        foreach($array as $row)
        {
            if (empty($row)) return true;
        }
        return false;
    }
}

if (! function_exists('array_get_item'))
{
    /**
    * Get array element by index 0
    *
    * @param  Array $array
    */
    function array_get_item($array, $key, $index, $subkey, $default = null)
    {
        $k = implode('.', [$key, $index, $subkey]);
        return array_get($array, trim($k, '.'), $default);
    }
}

if (! function_exists('array_unique_by'))
{
    /**
    * Get array element by index 0
    *
    * @param  Array $array
    */
    function array_unique_by($array, $key)
    {
        $results = [];
        foreach($array as $row)
        {
            if (is_object($row))
            {
                $value = $row->$key ?? null;
            }
            else
            {
                $value = array_get($row, $key);
            }
            
            if (empty($value))
            {
                $results[] = $row;
                continue;
            }
            if (!array_key_exists($key, $results))
            {
                $results[$value] = $row;
            }
        }
        return array_values($results);
    }
}
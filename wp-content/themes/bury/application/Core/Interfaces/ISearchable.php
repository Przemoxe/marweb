<?php
namespace App\Core\Interfaces;

/**
 * Post type interface
 */
interface ISearchable
{
    function search($search_query, $paged = 1);
}

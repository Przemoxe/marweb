<?php


if (! function_exists('response_json'))
{
    /**
     * Return json reponse
     *
     * @param  String|Array|Object $data
     */
     function response_json($data)
     {
         header('Content-Type: application/json');
         echo json_encode($data, JSON_HEX_APOS);
         die;
     }
}
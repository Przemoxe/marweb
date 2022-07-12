<?php

if( ! function_exists('cdump'))
{


    /**
    * Pretty var_dump variables
    *
    * @param all typpes $arr
    * @param array $args
    * @return string
    */
    function cdump($arr, $args = null) {

        $fargs = func_get_args();
        if (count($fargs) > 2) {
            $args = $fargs;
            array_shift($args);
        }

        $die = false;
        $return = false;
        $comment = false;
        $include = false;
        $json = false;
        $nopre = false;
        $php = false;
        $dump = false;
        if (is_bool($args))
        $return = $args;
        if (is_string($args)) {
            $args = explode(",", $args);
            if (count($args) == 1) {
                $args = explode(" ", $args[0]);
            }
        }
        if (is_array($args)) {
            foreach ($args as $arg) {
                $arg = trim($arg);
                if ($arg == "die")
                $die = true;
                if ($arg == "return")
                $return = true;
                if ($arg == "comment")
                $comment = true;
                if ($arg == "include")
                $include = true;
                if ($arg == "json")
                $json = true;
                if ($arg == "nopre")
                $nopre = true;
                if ($arg == "php")
                $php = true;
                if ($arg == "dump")
                $dump = true;
            }
        }
        if ($arr === true)
        $arr = "True";
        else if ($arr === false)
        $arr = "False";
        if ($arr === null) {
            $arr = "Null";
        }
        if ($include) {
            ob_start();
            include $arr;
            $arr = ob_get_clean();
        }
        if ($dump) {
            var_dump($arr);
        }

        if ($json) {
            $arr = json_encode($arr);
        }
        $printFn = 'print_r';
        if ($php) {
            $printFn = 'var_export';
        }
        $str = "";
        if ($comment)
        $str .= "<!--neat_html ";
        if (!$json && !$nopre) {
            $str .= "<code><pre style=\""
            . "color:black; "
            . "border: 1px solid black; "
            . "white-space: pre-wrap;"
            . "background-color: #EFEFEF;"
            . "padding: 10px;\">\n";
        }
        $str .= $printFn($arr, true);
        if (!$json && !$nopre) {
            $str .= "</pre></code>\n";
        }
        if ($comment)
        $str .= "-->";
        if ($return == true)
        return $str;
        echo $str;
        if ($die)
        die();
    }

}

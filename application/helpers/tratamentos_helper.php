<?php
/**
 * Created by PhpStorm.
 * User: leobelini
 * Date: 05/10/16
 * Time: 20:56
 */

function mascara($mascara, $string)
{
    $string = str_replace(" ", "", $string);
    for ($i = 0; $i < strlen($string); $i++) {
        $mascara[strpos($mascara, "#")] = $string[$i];
    }
    return $mascara;
}
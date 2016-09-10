<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: leobelini
 * Date: 09/09/16
 * Time: 21:56
 */

function debugbar(){

    if (ENVIRONMENT !== 'production') {
        $ci = &get_instance();

        $ci->output->enable_profiler();
    }
}
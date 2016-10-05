<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: leobelini
 * Date: 09/09/16
 * Time: 21:56
 */

function baseUrl(){
    if (substr(uri_string(),0,3) != "api") {
        echo "<script>
            var base_url = '" . base_url() . "'
            var site_url = '" . site_url() . "' 
          </script>";
    }
}
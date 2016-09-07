<?php

/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 07/09/2016
 * Time: 01:24
 */
class Categories extends CI_Model
{

    /**
     * Users constructor.
     */
    public function __construct(){
        parent::__construct();
    }


    public function getAll(){
        return $this->db->get('categories');
    }


}
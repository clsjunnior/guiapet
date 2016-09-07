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


    public function retorna_Categorias(){
        $data = array();
        $query = $this->db->get('categories');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        $query->free_result();
        return $data;
    }


}
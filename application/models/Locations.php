<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Locations extends CI_Model {

    /**
     * Users constructor.
     */
    public function __construct(){
		parent::__construct();
	}


    /**
     * @param int $id
     * @return CI_DB_result
     */
    public function getById($id){

        /** Retorna o resultado da tabela locations onde o ID = $id */
	    return $this->db->get_where('locations', array('id' => $id));
    }

}
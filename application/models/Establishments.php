<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Establishments extends CI_Model {

    /**
     * Establishments constructor.
     */
    public function __construct(){
		parent::__construct();
	}

    public function getById($id){

        return $this->db->get_where('establishments', array('id' => $id));
    }

    public function newEstablishment($establishment)
    {
        /** Preenche o campo created_at com a data e hora atual no formato do banco de dados*/
        $establishment['created_at'] = gmdate('Y-m-d H:i:s', time());

        /** Insere na tabela locations a localização passado com seus respectivos campos */
        $this->db->insert('establishments', $establishment);

        return $this->db->insert_id();
    }

}
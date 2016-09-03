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

    /**
     * Adiciona nova localização
     *
     * @param string $location
     * @return bool
     */
    public function newLocation($location)
    {
        /** Preenche o campo created_at com a data e hora atual no formato do banco de dados*/
        $location['created_at'] = gmdate('Y-m-d H:i:s', time());

        /** Insere na tabela locations a localização passado com seus respectivos campos */
        return $this->db->insert('locations', $location);
    }


    /**
     * Atualiza as informações da localização
     *
     * @param $location
     * @param $id
     * @return bool
     */
    public function updateLocation($location, $id)
    {
        /** Preenche o campo updated_at com a data e hora atual no formato do banco de dados*/
        $location['updated_at'] = gmdate('Y-m-d H:i:s', time());

        /** Atualiza a localização onde o ID foi passado no parametro */
        $this->db->where('id', $id);
        return $this->db->update('locations', $location);
    }


    /**
     * Retorna o ID do ultimo registro inserido no banco
     *
     * @return int
     */
    public function getIdLastInsert()
    {
        return $this->db->insert_id();
    }

}
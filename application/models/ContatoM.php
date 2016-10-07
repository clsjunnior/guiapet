<?php

/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 07/09/2016
 * Time: 01:24
 */
class ContatoM extends CI_Model
{

    private $table = 'TB_Contato';


    /**
     * Categoria constructor
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Retorna todas as categorias
     *
     * @return CI_DB_result
     */
    public function getAllBy($condicao = array())
    {
        return $this->db->get_where($this->table, $condicao);
    }

}
<?php

/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 07/09/2016
 * Time: 01:24
 */
class Categoria extends CI_Model
{

    private $table = 'TB_Categoria';


    /**
     * Categoria constructor.
     */
    public function __construct(){
        parent::__construct();
    }


    /**
     * Retorna todas as categorias
     *
     * @return CI_DB_result
     */
    public function getAll(){
        /** Retorna todas as categorias (no formato de classe) */
        return $this->db->get($this->table);
    }

}
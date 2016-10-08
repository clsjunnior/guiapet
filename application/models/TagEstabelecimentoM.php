<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 05/10/2016
 * Time: 21:43
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class TagEstabelecimentoM extends CI_Model
{

    private $table = 'TB_tagestabelecimento';
    private $tag = 'TB_tag';
    private $viewTagEs = 'vw_tags';


    /**
     * Estabelecimento constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Seleciona tag por ID
     *
     * @param $id int
     * @return CI_DB_result
     */
    public function getById($id)
    {
        //$this->db->select("nome");
        //$this->db->from()
        //return $this->db->get_where($this->tag, array('NomeTag'))
        return $this->db->get_where($this->viewTagEs, array('EstabelecimentoCod' => $id));
        //return $this->db->get_where($this->tag, array('teste' => $tagEs));
    }


    /**
     * Seleciona tag pela View do banco
     *
     * @param array $where
     * @return CI_DB_result
     */
    public function getAllBy($where = array())
    {
        //return $this->db->get_where($this->table, $where);
        return $this->db->get_where($this->viewTagEs, $where);
    }


}
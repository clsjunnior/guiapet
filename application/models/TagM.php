<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 05/10/2016
 * Time: 21:43
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class TagM extends CI_Model
{

    private $table = 'tb_tag';
    private $tableEs = 'tb_tagestabelecimento';


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

        return $this->db->get_where($this->table, array('CodTag' => $id));
    }

    /**
     * Seleciona tag pela View do banco
     *
     * @param array $where
     * @return CI_DB_result
     */
    public function getAllBy()
    {
//        return $this->db->get_where($this->table, $where);
        $this->db->reset_query();
        $this->db->select("tg.Nome, tg.CodTag")
            ->from($this->table . " as tg")
            ->join('tb_tagestabelecimento as tge', 'tg.CodTag = tge.TagCod')
            ->group_by('tg.Nome');
        return $this->db->get();
    }

    public function getAllCount()
    {
        $this->db->reset_query();
        $this->db->select("tg.Nome, count(tge.CodTagEstabelecimento) as qtd")
            ->from($this->table . " as tg")
            ->join('tb_tagestabelecimento as tge', 'tg.CodTag = tge.TagCod', 'left')
            ->group_by('tg.Nome');
        return $this->db->get();
    }


}
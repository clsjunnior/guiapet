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

    private $table = 'tb_tagestabelecimento';
    private $tableTag = 'tb_tag';
    //private $viewEstabelecimentos = 'VW_Estabelecimentos2';

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
        return $this->db->get_where($this->table, array('CodTagEstabelecimento' => $id));
    }

    /**
     * Seleciona tag pela View do banco
     *
     * @param array $where
     * @return CI_DB_result
     */
    public function getAllBy($where = array())
    {
        return $this->db->get_where($this->table, $where);
    }

    public function gtNmTagByEstabelecimento($estabelecimentoID){
        return $this->db->select("Nome")
            ->from($this->tableTag. " as t")
            ->join($this->table." as te", "t.CodTag = te.TagCod", "inner")
            ->where("te.EstabelecimentoCod", $estabelecimentoID)
            ->get();
    }

    /**
     * Seleciona tag pela View do banco
     *
     * @param array $where
     * @return CI_DB_result
     */
    public function getEsByTags($tagsId = [])
    {
        return $this->db->from('vw_estabelecimentoTags')
            ->where_in('tgesTagCod', $tagsId)
            ->group_by('EsCodEstabelecimento')
            ->get();
    }
}
<?php

/**
 * Created by PhpStorm.
 * User: Celso Jnnior
 * Date: 13/10/2016
 * Time: 22:21
 */
class AvaliacaoM extends CI_Model
{
    private $table = 'TB_Avaliacao';
    private $viewAvaliacao = 'vw_estabelecimentosavaliacao';

    /**
     * avaliacao constructor
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function getByIdEs($id)
    {

        $this->db->reset_query();
        $this->db->select("e.Nome, round(avg(a.Nota)) as media")
            ->from("TB_Avaliacao as a")
            ->join("TB_Estabelecimento as e", "a.EstabelecimentoCod = e.CodEstabelecimento", "inner")
            ->where("e.CodEstabelecimento", $id);

        return $this->db->get();
    }


    public function getAllBy($where = array())
    {
        return $this->db->get_where($this->viewAvaliacao, $where);
    }


}
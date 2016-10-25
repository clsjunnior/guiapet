<?php

/**
 * Created by PhpStorm.
 * User: Celso Jnnior
 * Date: 13/10/2016
 * Time: 22:21
 */
class AvaliacaoM extends CI_Model
{
    private $table = 'tb_avaliacao';
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
        $this->db->select("e.Nome, round(avg(nota)) as media")
            ->from("tb_avaliacao as a")
            ->join("tb_estabelecimento as e", "a.EstabelecimentoCod = e.CodEstabelecimento", "inner")
            ->where("e.CodEstabelecimento", $id);

        return $this->db->get();
//            ->group_by("e.CodEstabelecimento");
//        return $this->db->get_where($this->table, array('CodEstabelecimento' => $id));

    }

//    public function getByAvaliacao($nota){
//        $this->db->reset_query();
//        $this->db->select("e.CodEstabelecimento, round(avg(a.Nota)) as media")
//            ->from("tb_avaliacao a")
//            ->join("tb_estabelecimento as e", "a.EstabelecimentoCod = e.CodEstabelecimento", "inner")
//            ->group_by("e.CodEstabelecimento")
//            ->having("media", $nota);
//
//        return $this->db->get();
//
//    }

    public function getAllBy($where = array())
    {
        return $this->db->get_where($this->viewAvaliacao, $where);
    }


}
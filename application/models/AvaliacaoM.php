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
        $this->db->select("e.Nome, round(avg(a.Nota)) as media")
            ->from("tb_avaliacaoas a")
            ->join("tb_estabelecimento as e", "a.EstabelecimentoCod = e.CodEstabelecimento", "inner")
            ->where("e.CodEstabelecimento", $id);

        return $this->db->get();
    }


    public function getAllBy($where = array())
    {
        return $this->db->get_where($this->viewAvaliacao, $where);
    }

    public function avaliar($userID, $estabID, $nota)
    {
        $av = $this->db->get_where($this->table, ['EstabelecimentoCod' => $estabID, 'UsuarioCod' => $userID])->num_rows();

        if ($av == 0) {
            $avaliacao = [
                'EstabelecimentoCod' => $estabID,
                'UsuarioCod' => $userID,
                'Nota' => $nota
            ];
            return $this->db->insert($this->table, $avaliacao);
        } else {
            $avaliacao = [
                'EstabelecimentoCod' => $estabID,
                'UsuarioCod' => $userID,
                'Nota' => $nota
            ];
            $this->db->where(['EstabelecimentoCod' => $estabID, 'UsuarioCod' => $userID]);
            return $this->db->update($this->table, $avaliacao);
        }
    }


}
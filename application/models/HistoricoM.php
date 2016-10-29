<?php


class HistoricoM extends CI_Model
{
    private $table = 'tb_historico';

    /**
     * avaliacao constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function cadastrar($historico = [])
    {

        $this->db->insert($this->table, $historico);
    }

}
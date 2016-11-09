<?php


class GaleriaM extends CI_Model
{
    private $table = 'tb_galeria';

    public function __construct()
    {
        parent::__construct();
    }

    public function cadastrar($galeria = [])
    {

        $this->db->insert($this->table, $galeria);
    }

    public function get($where = [])
    {
        return $this->db->get_where($this->table, $where);
    }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PermissaoM extends CI_Model
{

    private $table = 'tb_permissao';


    public function __construct()
    {
        parent::__construct();
    }

    public function getWhere($where = [])
    {
        return $this->db->get_where($this->table, $where);
    }

}
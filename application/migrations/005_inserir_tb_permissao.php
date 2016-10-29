<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Inserir_Tb_Permissao extends CI_Migration
{

    private $ci;

    function __construct()
    {
        parent::__construct();
        $this->ci = &get_instance();

    }

    public function up()
    {
        $this->ci->db->query(
            "INSERT INTO tb_permissao (CodPermissao, Nome, Descricao) VALUES (NULL, 'Usuario', NULL), (NULL, 'Proprietário', NULL), (NULL, 'Administrador', NULL);"
        );
    }

    public function down()
    {
        $this->ci->db->query("DELETE FROM tb_permissao WHERE CodPermissao = 1; DELETE FROM tb_permissao WHERE CodPermissao = 2; DELETE FROM tb_permissao WHERE CodPermissao = 3;");
    }
}
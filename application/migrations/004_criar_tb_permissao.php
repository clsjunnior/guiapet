<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Criar_Tb_Permissao extends CI_Migration
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
            "
            CREATE TABLE IF NOT EXISTS tb_permissao (
                CodPermissao INT         NOT NULL AUTO_INCREMENT,
                Nome         VARCHAR(60) NOT NULL,
                Descricao    TEXT        NULL,
                PRIMARY KEY (CodPermissao),
                UNIQUE INDEX CodPermissao_UNIQUE (CodPermissao ASC)
            )ENGINE = InnoDB;
            "
        );
    }

    public function down()
    {
        $this->ci->db->query("DROP TABLE tb_permissao;");
    }
}
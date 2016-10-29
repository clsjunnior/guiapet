<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Criar_Tb_Contato extends CI_Migration
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
            CREATE TABLE IF NOT EXISTS tb_contato (
                CodContato         INT          NOT NULL AUTO_INCREMENT,
                TelefonePrincipal  VARCHAR(15)  NULL,
                TelefoneSecundario VARCHAR(15)  NULL,
                Facebook           VARCHAR(255) NULL,
                Twitter            VARCHAR(255) NULL,
                Site               VARCHAR(255) NULL,
                Email              VARCHAR(255) NULL,
                PRIMARY KEY (CodContato)
            )ENGINE = InnoDB;
            "
        );
    }

    public function down()
    {
        $this->ci->db->query("DROP TABLE tb_contato;");
    }
}
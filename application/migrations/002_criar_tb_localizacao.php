<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Criar_Tb_Localizacao extends CI_Migration
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
            CREATE TABLE tb_localizacao (
                CodLocalizacao INT          NOT NULL AUTO_INCREMENT,
                Estado         VARCHAR(2)   NULL,
                Cidade         VARCHAR(125) NULL,
                Cep            VARCHAR(11)  NULL,
                Rua            VARCHAR(255) NULL,
                Numero         VARCHAR(11)  NULL,
                Bairro         VARCHAR(255) NULL,
                Complemento    VARCHAR(255) NULL,
                Latitude       VARCHAR(255) NULL,
                Longitude      VARCHAR(255) NULL,
                PRIMARY KEY (CodLocalizacao),
                UNIQUE INDEX CodLocalizacao_UNIQUE (CodLocalizacao ASC)
            )ENGINE = InnoDB;
            "
        );
    }

    public function down()
    {
        $this->ci->db->query("DROP TABLE tb_localizacao;");
    }
}
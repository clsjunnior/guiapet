<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Criar_Tb_Galeria extends CI_Migration
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
            CREATE TABLE IF NOT EXISTS tb_galeria (
                CodGaleria         INT          NOT NULL AUTO_INCREMENT,
                Nome               VARCHAR(120) NULL,
                Descricao          VARCHAR(255) NULL,
                Arquivo            TEXT         NOT NULL,
                EstabelecimentoCod INT          NOT NULL,
                PRIMARY KEY (CodGaleria),
                UNIQUE INDEX CodGaleria_UNIQUE (CodGaleria ASC),
                INDEX fk_tb_galeria_tb_estabelecimento1_idx (EstabelecimentoCod ASC),
                CONSTRAINT fk_tb_galeria_tb_estabelecimento1
                FOREIGN KEY (EstabelecimentoCod)
                REFERENCES tb_estabelecimento (CodEstabelecimento)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION
            )ENGINE = InnoDB;
            "
        );
    }

    public function down()
    {
        $this->ci->db->query("
          ALTER TABLE tb_galeria DROP FOREIGN KEY fk_tb_galeria_tb_estabelecimento1;
          DROP TABLE tb_galeria;
         ");
    }
}
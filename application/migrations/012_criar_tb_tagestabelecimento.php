<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Criar_Tb_Tagestabelecimento extends CI_Migration
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
            CREATE TABLE IF NOT EXISTS tb_tagestabelecimento (
                CodTagEstabelecimento INT NOT NULL AUTO_INCREMENT,
                TagCod                INT NOT NULL,
                EstabelecimentoCod    INT NOT NULL,
                PRIMARY KEY (CodTagEstabelecimento),
                UNIQUE INDEX CodfTagEstabelecimento_UNIQUE (CodTagEstabelecimento ASC),
                INDEX fk_tb_tagestabelecimento_tb_tag1_idx (TagCod ASC),
                INDEX fk_tb_tagestabelecimento_tb_estabelecimento1_idx (EstabelecimentoCod ASC),
                CONSTRAINT fk_tb_tagestabelecimento_tb_tag1
                FOREIGN KEY (TagCod)
                REFERENCES tb_tag (CodTag)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                CONSTRAINT fk_tb_tagestabelecimento_tb_estabelecimento1
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
          ALTER TABLE tb_tagestabelecimento DROP FOREIGN KEY fk_tb_tagestabelecimento_tb_tag1;
          ALTER TABLE tb_tagestabelecimento DROP FOREIGN KEY fk_tb_tagestabelecimento_tb_estabelecimento1;
          DROP TABLE tb_tagestabelecimento;
        ");
    }
}
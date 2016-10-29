<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Criar_Tb_Avaliacao extends CI_Migration
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
            CREATE TABLE IF NOT EXISTS tb_avaliacao (
                CodAvaliacao       INT    NOT NULL AUTO_INCREMENT,
                Nota               INT(1) NOT NULL,
                EstabelecimentoCod INT    NOT NULL,
                UsuarioCod         INT    NOT NULL,
                PRIMARY KEY (CodAvaliacao),
                UNIQUE INDEX CodAvaliacao_UNIQUE (CodAvaliacao ASC),
                INDEX fk_tb_avaliacao_tb_estabelecimento1_idx (EstabelecimentoCod ASC),
                INDEX fk_tb_avaliacao_tb_usuario1_idx (UsuarioCod ASC),
                CONSTRAINT fk_tb_avaliacao_tb_estabelecimento1
                FOREIGN KEY (EstabelecimentoCod)
                REFERENCES tb_estabelecimento (CodEstabelecimento)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                CONSTRAINT fk_tb_avaliacao_tb_usuario1
                FOREIGN KEY (UsuarioCod)
                REFERENCES tb_usuario (CodUsuario)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION
            )ENGINE = InnoDB;
            "
        );
    }

    public function down()
    {
        $this->ci->db->query("
          ALTER TABLE tb_avaliacao DROP FOREIGN KEY fk_tb_avaliacao_tb_estabelecimento1;
          ALTER TABLE tb_avaliacao DROP FOREIGN KEY fk_tb_avaliacao_tb_usuario1;
          DROP TABLE tb_avaliacao;
        ");
    }
}
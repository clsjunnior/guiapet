<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Criar_Tb_Historico extends CI_Migration
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
            CREATE TABLE IF NOT EXISTS tb_historico (
                CodHistorico       INT  NOT NULL AUTO_INCREMENT,
                TagsCod            TEXT NULL,
                UsuarioCod         INT  NULL,
                EstabelecimentoCod INT  NOT NULL,
                CategoriaCod       INT  NOT NULL,
                PRIMARY KEY (CodHistorico),
                UNIQUE INDEX CodHistorico_UNIQUE (CodHistorico ASC),
                INDEX fk_tb_historico_tb_usuario_idx (UsuarioCod ASC),
                INDEX fk_tb_historico_tb_estabelecimento1_idx (EstabelecimentoCod ASC),
                INDEX fk_tb_historico_tb_categoria1_idx (CategoriaCod ASC),
                CONSTRAINT fk_tb_historico_tb_usuario
                FOREIGN KEY (UsuarioCod)
                REFERENCES tb_usuario (CodUsuario)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                CONSTRAINT fk_tb_historico_tb_estabelecimento1
                FOREIGN KEY (EstabelecimentoCod)
                REFERENCES tb_estabelecimento (CodEstabelecimento)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                CONSTRAINT fk_tb_historico_tb_categoria1
                FOREIGN KEY (CategoriaCod)
                REFERENCES tb_categoria (CodCategoria)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION
            )ENGINE = InnoDB;
            "
        );
    }

    public function down()
    {
        $this->ci->db->query("
          ALTER TABLE tb_historico DROP FOREIGN KEY fk_tb_historico_tb_usuario;
          ALTER TABLE tb_historico DROP FOREIGN KEY fk_tb_historico_tb_estabelecimento1;
          ALTER TABLE tb_historico DROP FOREIGN KEY fk_tb_historico_tb_categoria1;
          DROP TABLE tb_historico;
        ");
    }
}
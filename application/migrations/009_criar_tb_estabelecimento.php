<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Criar_Tb_Estabelecimento extends CI_Migration
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
            CREATE TABLE IF NOT EXISTS tb_estabelecimento (
                CodEstabelecimento INT          NOT NULL AUTO_INCREMENT,
                Nome               VARCHAR(120) NOT NULL,
                Descricao          TEXT         NOT NULL,
                Foto               TEXT         NOT NULL,
                CNPJ               VARCHAR(14)  NOT NULL,
                LocalizacaoCod     INT          NOT NULL,
                ContatoCod         INT          NULL,
                UsuarioCod         INT          NOT NULL,
                CategoriaCod       INT          NOT NULL,
                PRIMARY KEY (CodEstabelecimento),
                UNIQUE INDEX CodEstabelecimento_UNIQUE (CodEstabelecimento ASC),
                INDEX fk_tb_estabelecimento_tb_localizacao1_idx (LocalizacaoCod ASC),
                INDEX fk_tb_estabelecimento_tb_contato1_idx (ContatoCod ASC),
                INDEX fk_tb_estabelecimento_tb_usuario1_idx (UsuarioCod ASC),
                INDEX fk_tb_estabelecimento_tb_categoria1_idx (CategoriaCod ASC),
                CONSTRAINT fk_tb_estabelecimento_tb_localizacao1
                FOREIGN KEY (LocalizacaoCod)
                REFERENCES tb_localizacao (CodLocalizacao)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                CONSTRAINT fk_tb_estabelecimento_tb_contato1
                FOREIGN KEY (ContatoCod)
                REFERENCES tb_contato (CodContato)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                CONSTRAINT fk_tb_estabelecimento_tb_usuario1
                FOREIGN KEY (UsuarioCod)
                REFERENCES tb_usuario (CodUsuario)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                CONSTRAINT fk_tb_estabelecimento_tb_categoria1
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
          ALTER TABLE tb_estabelecimento DROP FOREIGN KEY fk_tb_estabelecimento_tb_localizacao1;
          ALTER TABLE tb_estabelecimento DROP FOREIGN KEY fk_tb_estabelecimento_tb_contato1;
          ALTER TABLE tb_estabelecimento DROP FOREIGN KEY fk_tb_estabelecimento_tb_usuario1;
          ALTER TABLE tb_estabelecimento DROP FOREIGN KEY fk_tb_estabelecimento_tb_categoria1;
          DROP TABLE tb_estabelecimento;
        ");
    }
}
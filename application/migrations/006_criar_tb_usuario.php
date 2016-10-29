<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Criar_Tb_Usuario extends CI_Migration
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
            CREATE TABLE IF NOT EXISTS tb_usuario (
                CodUsuario     INT             NOT NULL AUTO_INCREMENT,
                Nome           VARCHAR(120)    NOT NULL,
                Login          VARCHAR(50)     NOT NULL,
                Senha          VARCHAR(150)    NOT NULL,
                Email          VARCHAR(255)    NOT NULL,
                Sexo           ENUM ('M', 'F') NOT NULL,
                LocalizacaoCod INT             NULL,
                ContatoCod     INT             NULL,
                PermissaoCod   INT             NOT NULL,
                PRIMARY KEY (CodUsuario),
                UNIQUE INDEX CodUsuario_UNIQUE (CodUsuario ASC),
                INDEX fk_tb_usuario_tb_localizacao1_idx (LocalizacaoCod ASC),
                INDEX fk_tb_usuario_tb_contato1_idx (ContatoCod ASC),
                INDEX fk_tb_usuario_tb_permissao1_idx (PermissaoCod ASC),
                CONSTRAINT fk_tb_usuario_tb_localizacao1
                FOREIGN KEY (LocalizacaoCod)
                REFERENCES tb_localizacao (CodLocalizacao)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                CONSTRAINT fk_tb_usuario_tb_contato1
                FOREIGN KEY (ContatoCod)
                REFERENCES tb_contato (CodContato)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                CONSTRAINT fk_tb_usuario_tb_permissao1
                FOREIGN KEY (PermissaoCod)
                REFERENCES tb_permissao (CodPermissao)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION
            )ENGINE = InnoDB;
            "
        );
    }

    public function down()
    {
        $this->ci->db->query("
          ALTER TABLE tb_usuario DROP FOREIGN KEY fk_tb_usuario_tb_localizacao1;
          ALTER TABLE tb_usuario DROP FOREIGN KEY fk_tb_usuario_tb_contato1;
          ALTER TABLE tb_usuario DROP FOREIGN KEY fk_tb_usuario_tb_permissao1;
          DROP TABLE tb_usuario;
        ");
    }
}
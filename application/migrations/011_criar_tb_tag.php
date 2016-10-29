<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Criar_Tb_Tag extends CI_Migration
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
            CREATE TABLE IF NOT EXISTS tb_tag (
                CodTag INT         NOT NULL AUTO_INCREMENT,
                Nome   VARCHAR(30) NOT NULL,
                PRIMARY KEY (CodTag),
                UNIQUE INDEX CodTag_UNIQUE (CodTag ASC)
            )ENGINE = InnoDB;
            "
        );
    }

    public function down()
    {
        $this->ci->db->query("DROP TABLE tb_tag;");
    }
}
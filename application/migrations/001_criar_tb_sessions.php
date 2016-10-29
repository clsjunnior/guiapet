<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Criar_Tb_Sessions extends CI_Migration
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
            CREATE TABLE IF NOT EXISTS tb_sessions (
              id         VARCHAR(40) NOT NULL,
              ip_address VARCHAR(45) NOT NULL,
              timestamp  INT(10)     NOT NULL,
              data       BLOB        NOT NULL
            )ENGINE = InnoDB;
            "
        );
    }

    public function down()
    {
        $this->ci->db->query("DROP TABLE tb_sessions;");
    }
}
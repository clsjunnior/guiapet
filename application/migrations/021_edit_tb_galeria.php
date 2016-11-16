<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Edit_Tb_Galeria extends CI_Migration
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
            ALTER TABLE tb_galeria DROP Nome;
            ALTER TABLE tb_galeria DROP Descricao;
            "
        );
    }

    public function down()
    {
        $this->ci->db->query("
          ALTER TABLE tb_galeria ADD Nome VARCHAR(120) NULL;
          ALTER TABLE tb_galeria ADD Descricao VARCHAR(255) NULL;
         ");
    }
}
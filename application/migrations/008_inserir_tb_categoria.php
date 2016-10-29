<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Inserir_Tb_Categoria extends CI_Migration
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
            "INSERT INTO tb_categoria (CodCategoria, Nome) VALUES (NULL, 'Clinica Veterinária'), (NULL, 'Pet Shop'), (NULL, 'Hoteis para Pet'), (NULL, 'Adestradores'), (NULL, 'Taxi Pet');"
        );
    }

    public function down()
    {
        $this->ci->db->query("DELETE FROM tb_categoria WHERE CodCategoria = 1; DELETE FROM tb_categoria WHERE CodCategoria = 2; DELETE FROM tb_categoria WHERE CodCategoria = 3;DELETE FROM tb_categoria WHERE CodCategoria = 4;DELETE FROM tb_categoria WHERE CodCategoria = 5;");
    }
}
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Criar_Vw_Tages extends CI_Migration
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
            CREATE OR REPLACE VIEW vw_tagEs AS
            SELECT
                tgEs.CodTagEstabelecimento AS codTagEs,
                tag.CodTag                 AS codTag,
                tag.Nome                   AS tagNome
            FROM
                tb_tagestabelecimento AS tgEs
                INNER JOIN
                tb_tag AS tag ON tgEs.TagCod = tag.CodTag;
            "
        );
    }

    public function down()
    {
        $this->ci->db->query("DROP VIEW vw_tagEs RESTRICT;");
    }
}
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Criar_Vw_Estabelecimentos extends CI_Migration
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
            CREATE OR REPLACE VIEW vw_estabelecimentos AS
            SELECT
                es.CodEstabelecimento AS EsCodEstabelecimento,
                es.Nome               AS EsNome,
                es.Descricao          AS EsDescricao,
                es.Foto               AS EsFoto,
                es.CNPJ               AS EsCNPJ,
                es.ContatoCod         AS EsContatoCod,
                ca.CodCategoria       AS CaCodCategoria,
                ca.Nome               AS CaNome,
                lo.CodLocalizacao     AS CoCodLocalizacao,
                lo.Estado             AS LoEstado,
                lo.Cidade             AS LoCidade,
                lo.Cep                AS LoCep,
                lo.Rua                AS LoRua,
                lo.Numero             AS LoNumero,
                lo.Bairro             AS LoBairro,
                lo.Complemento        AS LoComplemento,
                lo.Latitude           AS LoLatitude,
                lo.Longitude          AS LoLongitude,
                us.CodUsuario         AS UsCodUsuario,
                us.Nome               AS UsNome,
                us.Login              AS UsLogin,
                us.Senha              AS UsSenha,
                us.Email              AS UsEmail,
                us.Sexo               AS UsSexo,
                co.TelefonePrincipal  AS CoTelefonePrincipal,
                co.TelefoneSecundario AS CoTelefoneSecundario,
                co.Facebook           AS CoFacebook,
                co.Twitter            AS CoTwitter,
                co.Site               AS CoSite,
                co.Email              AS CoEmail
            FROM
                tb_estabelecimento AS es
                INNER JOIN
                tb_categoria AS ca ON es.CategoriaCod = ca.CodCategoria
                INNER JOIN
                tb_localizacao AS lo ON es.LocalizacaoCod = lo.CodLocalizacao
                INNER JOIN
                tb_usuario AS us ON es.UsuarioCod = us.CodUsuario
                INNER JOIN
                tb_contato AS co ON es.ContatoCod = co.CodContato;
            "
        );
    }

    public function down()
    {
        $this->ci->db->query("DROP VIEW vw_estabelecimentos RESTRICT;");
    }
}
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_View_Avaliacao extends CI_Migration
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
            CREATE OR REPLACE VIEW VW_Estabelecimentosavaliacao AS
            SELECT
                es.CodEstabelecimento  AS EsCodEstabelecimento,
                es.Nome                AS EsNome,
                es.Descricao           AS EsDescricao,
                es.Foto                AS EsFoto,
                es.CNPJ                AS EsCNPJ,
                ca.CodCategoria        AS CaCodCategoria,
                ca.Nome                AS CaNome,
                lo.CodLocalizacao      AS CoCodLocalizacao,
                lo.Estado              AS LoEstado,
                lo.Cidade              AS LoCidade,
                lo.Cep                 AS LoCep,
                lo.Rua                 AS LoRua,
                lo.Numero              AS LoNumero,
                lo.Bairro              AS LoBairro,
                lo.Complemento         AS LoComplemento,
                lo.Latitude            AS LoLatitude,
                lo.Longitude           AS LoLongitude,
                us.CodUsuario          AS UsCodUsuario,
                us.Nome                AS UsNome,
                us.Login               AS UsLogin,
                us.Senha               AS UsSenha,
                us.Email               AS UsEmail,
                us.Sexo                AS UsSexo,
                co.TelefonePrincipal   AS CoTelefonePrincipal,
                co.TelefoneSecundario  AS CoTelefoneSecundario,
                co.Facebook            AS CoFacebook,
                co.Twitter             AS CoTwitter,
                co.Site                AS CoSite,
                co.Email               AS CoEmail,
                ROUND(AVG(av.Nota), 0) AS media
            FROM
                (((((tb_estabelecimento es
                    JOIN tb_categoria ca ON ((es.CategoriaCod = ca.CodCategoria)))
                    JOIN tb_localizacao lo ON ((es.LocalizacaoCod = lo.CodLocalizacao)))
                    JOIN tb_usuario us ON ((es.UsuarioCod = us.CodUsuario)))
                    LEFT JOIN tb_avaliacao av ON ((es.CodEstabelecimento = av.EstabelecimentoCod)))
                    LEFT JOIN tb_contato co ON ((es.ContatoCod = co.CodContato)))
            GROUP BY es.CodEstabelecimento;
            "
        );
    }

    public function down()
    {
        $this->ci->db->query(
            "
            CREATE OR REPLACE VIEW VW_Estabelecimentosavaliacao AS
            SELECT
                es.CodEstabelecimento  AS EsCodEstabelecimento,
                es.Nome                AS EsNome,
                es.Descricao           AS EsDescricao,
                es.Foto                AS EsFoto,
                es.CNPJ                AS EsCNPJ,
                ca.CodCategoria        AS CaCodCategoria,
                ca.Nome                AS CaNome,
                lo.CodLocalizacao      AS CoCodLocalizacao,
                lo.Estado              AS LoEstado,
                lo.Cidade              AS LoCidade,
                lo.Cep                 AS LoCep,
                lo.Rua                 AS LoRua,
                lo.Numero              AS LoNumero,
                lo.Bairro              AS LoBairro,
                lo.Complemento         AS LoComplemento,
                lo.Latitude            AS LoLatitude,
                lo.Longitude           AS LoLongitude,
                us.CodUsuario          AS UsCodUsuario,
                us.Nome                AS UsNome,
                us.Login               AS UsLogin,
                us.Senha               AS UsSenha,
                us.Email               AS UsEmail,
                us.Sexo                AS UsSexo,
                co.TelefonePrincipal   AS CoTelefonePrincipal,
                co.TelefoneSecundario  AS CoTelefoneSecundario,
                co.Facebook            AS CoFacebook,
                co.Twitter             AS CoTwitter,
                co.Site                AS CoSite,
                co.Email               AS CoEmail,
                ROUND(AVG(av.Nota), 0) AS media
            FROM
                (((((tb_estabelecimento es
                    JOIN tb_categoria ca ON ((es.CategoriaCod = ca.CodCategoria)))
                    JOIN tb_localizacao lo ON ((es.LocalizacaoCod = lo.CodLocalizacao)))
                    JOIN tb_usuario us ON ((es.UsuarioCod = us.CodUsuario)))
                    LEFT JOIN tb_avaliacao av ON ((es.CodEstabelecimento = av.EstabelecimentoCod)))
                    JOIN tb_contato co ON ((es.ContatoCod = co.CodContato)))
            GROUP BY es.CodEstabelecimento;
            "
        );
    }
}
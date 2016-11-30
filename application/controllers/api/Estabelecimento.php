<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Estabelecimento extends CI_Controller
{
    /**
     * Perfil constructor.
     */
    public function __construct()
    {
        parent::__construct();


        /** Carregamento de models */
        $this->load->model('EstabelecimentoM', 'estabelecimento');
        $this->load->model('LocalizacaoM', 'localizacao');
    }


    public function buscaTotal()
    {
        $this->output->set_content_type('application/json');
        $where = null;

        $valores = $this->estabelecimento->getAllBy($where)->result_array();

        foreach ($valores as $valor){

            $saida[] = [
                "idEs" => $valor['EsCodEstabelecimento'],
                "categoria" => $valor['CaNome'],
                "nome" => $valor['EsNome'],
                "descricao" => $valor['EsDescricao'],
                "foto" => $valor['EsFoto'],
                "lat" => $valor['LoLatitude'],
                "long" => $valor['LoLongitude'],
                "telefonePricipal" => $valor['CoTelefonePrincipal'],
                "facebook" => $valor['CoFacebook'],
                "site" => $valor['CoSite'],
                "email" => $valor['CoEmail']
            ];
        }

        if (!isset($saida)) {
            $saida[] = ["vazio" => "Nenhum resultado encontrado!"];
        }

        echo json_encode($saida);
    }

    public function buscaEsOrdenada()
    {
        $this->output->set_content_type('application/json');
        $where = null;

        $valores = $this->estabelecimento->getAllBy($where)->result_array();

        foreach ($valores as $valor) {

            $saida[$valor['CaNome']][] = [
                "idEs" => $valor['EsCodEstabelecimento'],
                "categoria" => $valor['CaNome'],
                "nome" => $valor['EsNome'],
                "descricao" => $valor['EsDescricao'],
                "foto" => $valor['EsFoto'],
                "lat" => $valor['LoLatitude'],
                "long" => $valor['LoLongitude'],
                "telefonePricipal" => $valor['CoTelefonePrincipal'],
                "facebook" => $valor['CoFacebook'],
                "site" => $valor['CoSite'],
                "email" => $valor['CoEmail']
            ];
        }

        if (!isset($saida)) {
            $saida[] = ["vazio" => "Nenhum resultado encontrado!"];
        }

        echo json_encode($saida);
    }

    public function buscaEstabelecimentoId()
    {
        $this->output->set_content_type('application/json');
        $where = [
            "EsCodEstabelecimento" => $this->uri->segment(4),
        ];

        $valores = $this->estabelecimento->getAllBy($where)->result_array();

        foreach ($valores as $valor) {

            $saida[] = [
                "idEs" => $valor['EsCodEstabelecimento'],
                "categoria" => $valor['CaNome'],
                "nome" => $valor['EsNome'],
                "descricao" => $valor['EsDescricao'],
                "foto" => $valor['EsFoto'],
                "lat" => $valor['LoLatitude'],
                "long" => $valor['LoLongitude'],
                "telefonePricipal" => $valor['CoTelefonePrincipal'],
                "facebook" => $valor['CoFacebook'],
                "site" => $valor['CoSite'],
                "email" => $valor['CoEmail']
            ];
        }

        if (!isset($saida)){
            $saida[] = ["vazio" => "Nenhum resultado encontrado!"];
        }

        echo json_encode($saida);
    }

    public function buscaEstabelecimentoCategoria()
    {
        $this->output->set_content_type('application/json');
        $where = [
            "CaCodCategoria" => $this->uri->segment(4),
        ];

        $valores = $this->estabelecimento->getAllBy($where)->result_array();

        foreach ($valores as $valor) {

            $saida[] = [
                "idEs" => $valor['EsCodEstabelecimento'],
                "categoria" => $valor['CaNome'],
                "nome" => $valor['EsNome'],
                "descricao" => $valor['EsDescricao'],
                "foto" => $valor['EsFoto'],
                "lat" => $valor['LoLatitude'],
                "long" => $valor['LoLongitude'],
                "telefonePricipal" => $valor['CoTelefonePrincipal'],
                "facebook" => $valor['CoFacebook'],
                "site" => $valor['CoSite'],
                "email" => $valor['CoEmail']
            ];
        }

        if (!isset($saida)) {
            $saida[] = ["vazio" => "Nenhum resultado encontrado!"];
        }

        echo json_encode($saida);

    }

    public function recomendacao()
    {
        $this->output->set_content_type('application/json');

        $user = $this->uri->segment(4);

        $config = [
            'idUser' => $user,           // ID do usuario para realizar recomendação pelo seu historico
            'historicoCatQtde' => 0, // Quantidade de registros que vai se basear para categoria
            'historicoTagQtde' => 8, // Quantidade de registros que vai se basear para tags
            'totalResult' => 8,      // Total de resultados
            'listTags' => [],        // Lista de ID de TAGS
            'listCategorias' => [],  // Lista de ID de Categorias
        ];

        echo json_encode($this->estabelecimento->gerarRecomendacao($config));

    }

    public function recomendacaoTags()
    {
        $this->output->set_content_type('application/json');

        $tags = explode('-', $this->uri->segment(4));

        $config = [
            'idUser' => '',           // ID do usuario para realizar recomendação pelo seu historico
            'historicoCatQtde' => 0, // Quantidade de registros que vai se basear para categoria
            'historicoTagQtde' => 8, // Quantidade de registros que vai se basear para tags
            'totalResult' => 8,      // Total de resultados
            'listTags' => $tags,        // Lista de ID de TAGS
            'listCategorias' => [],  // Lista de ID de Categorias
        ];

        echo json_encode($this->estabelecimento->gerarRecomendacao($config));

    }

    public function EsRaio()
    {
        $this->output->set_content_type('application/json');

        $getLat = $this->uri->segment(4);
        $getLong = $this->uri->segment(5);

        $result = $this->localizacao->getEsRaio($getLat, $getLong)->result_array();

        foreach ($result as $valor) {

            $saida[] = [
                "idEs" => $valor['EsCodEstabelecimento'],
                "categoria" => $valor['CaNome'],
                "nome" => $valor['EsNome'],
                "descricao" => $valor['EsDescricao'],
                "foto" => $valor['EsFoto'],
                "lat" => $valor['LoLatitude'],
                "long" => $valor['LoLongitude'],
                "telefonePricipal" => $valor['CoTelefonePrincipal'],
                "facebook" => $valor['CoFacebook'],
                "site" => $valor['CoSite'],
                "email" => $valor['CoEmail']
            ];
        }

        if (!isset($saida)) {
            $saida[] = ["vazio" => "Nenhum resultado encontrado!"];
        }

        echo json_encode($saida);
    }

}
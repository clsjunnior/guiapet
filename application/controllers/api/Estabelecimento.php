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
        $this->estabelecimento->gerarRecomendacao();
    }

}
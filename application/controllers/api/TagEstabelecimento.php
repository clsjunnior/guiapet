<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class TagEstabelecimento extends CI_Controller
{
    /**
     * Perfil constructor.
     */
    public function __construct()
    {
        parent::__construct();


        /** Carregamento de models */
        $this->load->model('TagEstabelecimentoM', 'tagEs');
        $this->load->model('TagM', 'tag');
       
    }

    // busca de todas as tags, inicial
    public function buscaTag()
    {
        $this->output->set_content_type('application/json');
        $where = null;

        $valores = $this->tagEs->getAllBy($where)->result_array();

        foreach ($valores as $valor) {

            $saida[] = [
                "codTagEs" => $valor['CodTagEstabelecimento'],
                "codEs" => $valor['EstabelecimentoCod'],
                "codTag" => $valor['TagCod']
            ];
        }

        if (!isset($saida)) {
            $saida[] = ["vazio" => "Nenhum resultado encontrado!"];
        }

        echo json_encode($saida);
    }

    public function buscaTagEs()
    {
        $this->output->set_content_type('application/json');

//        $where = [
//            "tgCod" => $this->uri->segment(4)
//        ];

        $valores = $this->tagEs->gtNmTagByEstabelecimento($this->uri->segment(4))->result_array();

        foreach ($valores as $valor) {

            $saida[] = [
                "tagNome" => $valor['Nome']
            ];
        }

        if (!isset($saida)) {
            $saida[] = ["vazio" => "Nenhum resultado encontrado!"];
        }

        echo json_encode($saida);


    }

    public function buscaEsTg()
    {
        $this->output->set_content_type('application/json');

        //$tags = explode(',',$this->input->post('ids'));
        $tags = explode('-', $this->uri->segment(4));

        $retorno = $this->tagEs->getEsByTags($tags)->result_array();

        foreach ($retorno as $valor) {

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
                "email" => $valor['CoEmail'],
                "tagNome" => $valor['tgNome']
            ];
        }

        if (!isset($saida)) {
            $saida[] = ["vazio" => "Nenhum resultado encontrado!"];
        }

        echo json_encode($saida);

        //var_dump($retorno->result_array());

    }


}
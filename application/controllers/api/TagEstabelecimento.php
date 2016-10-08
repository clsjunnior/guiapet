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
    }

    public function buscaTag()
    {
        $this->output->set_content_type('application/json');
        $where = null;
//        $where = [
//            "EsNome" => $this->uri->segment(4),
//            "UsNome" => $this->uri->segment(5),
//        ];

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

        $this->output->set_content_type('application/json');/*$id = [
           "codEs" => $this->uri->segment(4),
        ];*/;
        $id = $this->uri->segment(4);
        $valores = $this->tagEs->getById($id)->result_array();

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


}
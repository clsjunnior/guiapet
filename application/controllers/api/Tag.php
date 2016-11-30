<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Tag extends CI_Controller
{
    /**
     * Perfil constructor.
     */
    public function __construct()
    {
        parent::__construct();


        /** Carregamento de models */
        $this->load->model('TagM', 'tag');
    }

    public function buscaTag($param = null)
    {
        $this->output->set_content_type('application/json');
        $where = null;
//        $where = [
//            "EsNome" => $this->uri->segment(4),
//            "UsNome" => $this->uri->segment(5),
//        ];

        $valores = $this->tag->getAllBy()->result_array();


        foreach ($valores as $valor) {
            if ($param == null) {
                $saida[] = [
                    "codTag" => $valor['CodTag'],
                    "tag" => $valor['Nome']
                ];
            } else {
                $saida[] = $valor['Nome'];
            }
        }

        if (!isset($saida)) {
            $saida[] = ["vazio" => "Nenhum resultado encontrado!"];
        }

        echo json_encode($saida);
    }


}
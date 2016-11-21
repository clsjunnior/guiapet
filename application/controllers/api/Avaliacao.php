<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Avaliacao extends CI_Controller
{
    /**
     * Perfil constructor.
     */
    public function __construct()
    {
        parent::__construct();


        /** Carregamento de models */
        $this->load->model('AvaliacaoM', 'avaliacao');
    }

    public function buscaAvaliacaoEs()
    {
        $this->output->set_content_type('application/json');

        $valores = $this->avaliacao->getByIdEs($this->uri->segment(4))->result_array();

        foreach ($valores as $valor) {

            $saida[] = [
                "media" => $valor['media']
            ];
        }

        if (!isset($saida)) {
            $saida[] = ["vazio" => "Nenhum resultado encontrado!"];
        }

        echo json_encode($saida);
    }

    public function buscaEsAvaliacao()
    {
        $this->output->set_content_type('application/json');

        //$valores = $this->avaliacao->getByAvaliacao($this->uri->segment(4))->result_array();
        $where = [
            "media" => $this->uri->segment(4),
        ];

        $valores = $this->avaliacao->getAllBy($where)->result_array();

        //var_dump($valores)

        foreach ($valores as $valor) {

            $saida[] = [
                "media" => $valor['media'],
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

    public function avaliar()
    {
        $estabelecimentoID = $this->uri->segment(4);
        $nota = $this->uri->segment(5);

        $resp = $this->avaliacao->avaliar(getSesUser(['CodUsuario']), $estabelecimentoID, $nota);

        if ($resp == true) {
            echo "ok";
        } else {
            echo "Erro ao realizar a avaliação!";
        }



    }


}
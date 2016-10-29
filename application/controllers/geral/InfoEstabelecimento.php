<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class InfoEstabelecimento extends CI_Controller
{

    /**
     * Inicial constructor.
     */
    public function __construct()
    {
        parent::__construct();

        /** Carregamento de bibliotecas */

        /** Carregamento de models */
        $this->load->model('EstabelecimentoM', 'estabelecimento');
        $this->load->model('CategoriaM', 'categoria');
        $this->load->model('HistoricoM', 'historico');
        $this->load->model('TagEstabelecimentoM', 'tagestabelecimento');
    }


    /**
     *  Página index da administração
     */
    public function index($id)
    {

        $dados['estabelecimento'] = $this->estabelecimento->getAllBy(['EsCodEstabelecimento' => $id])->result()[0];
        $dados['tags'] = $this->tagestabelecimento->getAllBy(['EstabelecimentoCod' => $id])->result_array();

        if (getSesUser(['CodUsuario'])) {
            $historico['UsuarioCod'] = getSesUser(['CodUsuario']);
        }

        $historico['TagsCod'] = null;
        if ($dados['tags']) {
            foreach ($dados['tags'] as $tag) {
                $historico['TagsCod'] .= $tag['TagCod'] . ',';
            }
        }

        $historico['EstabelecimentoCod'] = $id;
        $historico['CategoriaCod'] = $dados['estabelecimento']->CaCodCategoria;

        $this->historico->cadastrar($historico);

        $dados['title'] = 'Visualizar Estabelecimento';
        $this->load->view('geral/estabelecimentos', $dados);

    }
}

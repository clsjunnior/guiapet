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
    }


    /**
     *  Página index da administração
     */
    public function index($id)
    {

        $dados['estabelecimento'] = $this->estabelecimento->getAllBy(['EsCodEstabelecimento' => $id])->result()[0];
        
        $dados['title'] = 'Visualizar Estabelecimento';
        $this->load->view('geral/estabelecimentos', $dados);

    }
}

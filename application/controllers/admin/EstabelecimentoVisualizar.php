<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstabelecimentoVisualizar extends CI_Controller
{
    /**
     * Estabelecimento constructor.
     */
    public function __construct()
    {
        parent::__construct();

        /** Caso não esteja logado redireciona para a pagina de login */
        if (!$this->session->has_userdata('login')) {
            redirect(site_url('login'));
        }

        /** Carregamento de bibliotecas */
        $this->load->library('form_validation');

        /** Carregamentos de models */
        $this->load->model('EstabelecimentoM', 'estabelecimento');
//        $this->load->model('LocalizacaoM', 'localizacao');
//        $this->load->model('CategoriaM', 'categoria');

    }


    /**
     *  Página inicial de estabelecimentos
     */
    public function index($id)
    {

//        $this->load->view('admin/estabelecimentos', $dados);
        $dados['estabelecimento'] = $this->estabelecimento->getAllBy(['EsCodEstabelecimento' => $id])->result()[0];
        $dados['title'] = 'Visualizar Estabelecimento';
        $this->load->view('admin/visualizar_estabelecimento', $dados);
//        $dados['title'] = 'Visualizar: ' . $dados['estabelecimento']['EsNome'];
//        $this->console->info("Select estabelecimentos:");
//        $this->console->info($dados['estabelecimento']);
//        $this->load->view('admin/visualizar_estabelecimento', $dados);
    }


}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estabelecimento extends CI_Controller
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

        /** Carregamentos de helpers */
        $this->load->helper('user');

        /** Carregamento de models */
        $this->load->model('Establishments', 'establishment');
        $this->load->model('Categories', 'category');
    }


    /**
     *  Página inicial de estabelecimentos
     */
    public function index()
    {
        /** Dados para view */
        $dados['title'] = "Estabelecimentos";

        $this->load->view('admin/estabelecimentos', $dados);
    }


    public function editar($id = null){
        if ($id == null) {
            $dados['title'] = "Novo estabelecimento";
        }else{
            $dados['title'] = "Editar estabelecimento";
        }
        $dados['categories'] = $this->category->getAll()->result();
        $dados['establishment'] = null;

        $this->load->view('admin/novo_estabelecimento', $dados);
    }

}
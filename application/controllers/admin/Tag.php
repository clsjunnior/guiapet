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

        /** Caso não esteja logado redireciona para a pagina de login */
        if (!$this->session->has_userdata('login')) {
            redirect(site_url('login'));
        }

        /** Carregamento de bibliotecas */
//        $this->load->library('form_validation');
//        $this->load->library('encrypt');

        /** Carregamento de models */
        $this->load->model('TagM', 'tag');
//        $this->load->model('LocalizacaoM', 'localizacao');
    }


    /**
     *  Página inicial do perfil
     */
    public function index()
    {
        /** Dados para view */
        $dados['title'] = "Lista de tags";
        $dados['tags'] = $this->tag->getAllCount()->result_array();
        $this->load->view('admin/tags', $dados);
    }

}
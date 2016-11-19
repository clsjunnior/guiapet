<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller
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

        /** Carregamento de models */
        $this->load->model('CategoriaM', 'categoria');
    }


    /**
     *  Página inicial do perfil
     */
    public function index()
    {
        /** Dados para view */
        $dados['title'] = "Lista de tags";
        $dados['tags'] = $this->categoria->getAllCount()->result_array();
        $this->load->view('admin/categorias', $dados);
    }

}
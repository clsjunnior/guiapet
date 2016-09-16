<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Página inicial do Dashboard
 */
class Inicial extends CI_Controller {



    /**
     * Inicial constructor.
     */
    public function __construct()
    {
        parent::__construct();

        /** Carregamento de bibliotecas */

        /** Carregamento de models */
        $this->load->model('Categoria','categoria');
    }



    /**
     *  Página index da administração
     */
    public function index()
    {
        $dados['title'] = "Bem Vindo ao Guia do Pet";

        /** Retorna todas as categorias em formato array */
        $dados['cat'] = $this->categoria->getAll()->result_array();

        $this->load->view('geral/inicial', $dados);



    }
}

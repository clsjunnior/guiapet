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
        $this->load->model('Categories','category');


    }



    /**
     *  Página index da administração
     */
	public function index()
	{
        $dados['title'] = "Bem Vindo ao Guia do Pet";

        /** Retorna todas as categorias em formato array */
        $dados['cat'] = $this->category->getAll()->result_array();

        $this->load->view('geral/inicial', $dados);



	}
}

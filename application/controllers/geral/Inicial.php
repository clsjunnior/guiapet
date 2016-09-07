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



        $data['cat'] = $this->category->getAll()->result_array();

        // se eu colocar outra view ele passando o data ele buga e aparace duas index
        $this->load->view('geral/inicial', $dados);



	}
}

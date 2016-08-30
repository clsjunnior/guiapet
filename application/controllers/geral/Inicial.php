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
    }

    /**
     *  Página index da administração
     */
	public function index()
	{
        $dados['title'] = "Bem Vindo ao Guia do Pet";

        $this->load->view('geral/inicial', $dados);
	}
}

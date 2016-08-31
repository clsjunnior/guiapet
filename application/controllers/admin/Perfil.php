<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Perfil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        /** Carregamento de bibliotecas */
        $this->load->library('form_validation');
        $this->load->library('encrypt');

        /** Carregamento de models */
        $this->load->model('Users', 'user');
    }

	public function index(){
        $dados['title'] = "Inicial";
        $dados['user'] = $this->session->userdata('user');

		$this->load->view('admin/perfil', $dados);
	}

}
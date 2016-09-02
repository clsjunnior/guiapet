<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inicial extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!$this->session->has_userdata('login')){
            redirect(site_url('login'));
        }
    }


    public function index(){
	    $dados['title'] = "Inicial";
        $dados['user'] = $this->session->userdata('user');

	    $this->load->view('admin/inicio',$dados);
	}

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inicial extends CI_Controller {

	public function index(){
	    $dados['title'] = "Inicial";
	    $this->load->view('admin/inicio',$dados);
	}

}
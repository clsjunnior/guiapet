<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->has_userdata('login')) {
            redirect(site_url('login'));
        }

        $this->load->model('UsuarioM', 'usuario');
    }


    public function index()
    {
        $dados['title'] = "Usuarios";
        $dados['usuarios'] = $this->usuario->listUsersPgAdm()->result_array();

        $this->load->view('admin/usuarios', $dados);
    }

}
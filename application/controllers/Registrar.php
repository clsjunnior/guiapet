<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Registrar extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        $this->load->model('Users', 'user');
    }

	public function index(){

        $this->form_validation->set_rules('nome', 'Nome', 'required|trim|max_length[120]');
        $this->form_validation->set_rules('sexo', 'Sexo', 'required|trim|in_list[M,F]');
        $this->form_validation->set_rules('email', 'E-mail', 'required|trim|differs[emailc]|is_unique[users.email]|max_length[255]',
            [
                'differs' => 'A confirmação do e-mail está incorreto',
                'is_unique' => 'O e-mail informado já está sendo utilizado.'
            ]);
        $this->form_validation->set_rules('login', 'Login', 'required|trim|is_unique[users.login]|max_length[30]',
            [
                'is_unique' => 'Login informado já está sendo utilizado.'
            ]);
        $this->form_validation->set_rules('senha', 'Senha', 'required|trim');

        if ($this->form_validation->run() != true) {
            $this->load->view('registrar');
        }else{
            $user = [
                'name' => $this->input->post('nome'),
                'sex' => $this->input->post('sexo'),
                'login' => $this->input->post('login'),
                'password' => $this->input->post('senha'),
                'email' => $this->input->post('email')
            ];

            $this->user->newUser($user);
        }
	}


}